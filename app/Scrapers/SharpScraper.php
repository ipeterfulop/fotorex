<?php


namespace App\Scrapers;


use App\Attribute;
use App\Dataproviders\ProductAttributeDataprovider;
use App\Helpers\Productcategory;
use App\Helpers\Productfamily;
use DOMDocument;
use DOMXPath;

class SharpScraper
{
    public static function scrapeProductsPage($url, $ignore = [])
    {
        $products = json_decode(mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8"))->products;
        $result = [
            'products' => [],
            'highlights' => []];

        foreach ($products as $product) {
           //print print_r($product, true);
            if (isset($product->product_id)) {
                if (array_search($product->product_id, $ignore) === false) {
                    $result['products'][$product->product_id] = 'https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-office-print.htm?product=' . $product->product_id;
                    $result['highlights'][$product->product_id] = $product->highlights;
                }
            }
        }

        return $result;
    }

    /**
     * @param $url
     * @return array
     */
    public static function scrapeProductPage($url)
    {
        $content = mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8");
        $dom = new DOMDocument;
        @($dom->loadHTML($content));
        $xpath = new DOMXpath($dom);
        $result = [
            'name'                  => '',
            'descriptionParagraphs' => [],
            'specifications' => [],
            'images' => [],
            'keyFeatures' => [],

        ];
        $elements = $xpath->query('//main//h1');
        if (count($elements) > 0) {
            $result['name'] = $elements[0]->textContent;
        }
        $elements = $xpath->query('//main//h2');
        foreach ($elements as $element) {
            if ($element->textContent == 'Áttekintés') {
                $paragraphs = $xpath->query('.//p', $element->parentNode);
                foreach ($paragraphs as $paragraph) {
                    $paragraphText = str_ireplace(["\r", "\n", "<p>"], '', $dom->saveHTML($paragraph));
                    $paragraphText = str_ireplace("</p>", "<br>", $paragraphText);
                    foreach (explode("<br>", $paragraphText) as $pt) {
                        if (trim($pt) != '') {
                            $result['descriptionParagraphs'][] = trim($pt);
                        }
                    }
                }
            }
            if ($element->textContent == 'Műszaki jellemzők') {
                $listItems = $xpath->query('.//li', $element->parentNode);
                foreach ($listItems as $listItem) {
                    $titleElement = $xpath->query('.//h2', $listItem)[0];
                    $title = $titleElement->textContent;
                    $contentElement = $xpath->query('.//div[contains(@class, "accordion-content")]', $listItem)[0];
                    $result['specifications'][$title] = $dom->saveHTML($contentElement);
                }
            }
        }
        $images = $xpath->query('//ul[contains(@class, "bxslider")]//img');
        foreach ($images as $image) {
            $result['images'][] = $image->getAttribute('src');
        }
        foreach ($images as $image) {
            $result['images'][] = $image->getAttribute('src');
        }
        foreach ($result['specifications'] as $name => $content) {
            $rawContent = str_ireplace("\n", "", $content);
            $rawContent = preg_replace('/<div.*?>/miu', '', $rawContent);
            $rawContent = preg_replace('/<span.*?check.*?<\/span>/miu', 'Igen', $rawContent);
            $rawContent = str_ireplace(['</div>', '<dt>', '</dt>', '</dd>', '<dl>'], '', $rawContent);
            $rows = explode('</dl>', $rawContent);
            $all['specificationRows'][$name] = [];
            foreach ($rows as $row) {
                $rowPieces = explode('<dd>', $row);
                if (count($rowPieces) == 2) {
                    $result['specificationRows'][$name][trim($rowPieces[0])] = trim($rowPieces[1]);
                }
            }
        }
        $keyfeaturesList = $xpath->query('//ul[contains(@class, "list-keyfeatures")]');
        if (count($keyfeaturesList) > 0) {
            $list = $keyfeaturesList[0];
            $items = $xpath->query('.//li', $list);
            foreach ($items as $item) {
                $result['keyFeatures'][] = $item->textContent;
            }
        }

        return $result;
    }

    public static function parseScrapedData($data)
    {
        $result = [
            'description' => '<p>'.implode('</p><p>', $data['descriptionParagraphs']).'</p>',
            'attributes' => [],
        ];

        $attributes = Attribute::forPrinters()
            ->where('position_at_product_comparison', '!=', null)
            ->orderBy('position_at_product_comparison', 'asc')
            ->with(['attribute_value_set'])
            ->get();
        dump($attributes->pluck('name', 'variable_name'));
        $tspAttributes = Attribute::where('variable_name', 'like', 'tsp_%')->get();
        $tspAttributesData = $tspAttributes->pluck('name', 'variable_name');
        dump($tspAttributesData);
        $lookups = [
            '/másolási sebesség.*?színes.*?a4/miu' => 'printing_speed_a4_color',
            '/másolási sebesség.*?színes.*?a3/miu' => 'printing_speed_a3_color',
            '/másolási sebesség.*?ff\s.*?a4/miu' => 'printing_speed_a4_bw',
            '/másolási sebesség.*?ff\s.*?a3/miu' => 'printing_speed_a3_bw',
            '/papír kapacit.*?standard/miu' => 'paper_feed_capacity',
            '/hálózati nyom/miu' => 'networked',
            '/duplex/miu' => 'duplex',
            '/felbontás\(dpi\)/miu' => 'printing_resolution',
            '/memória.*?gb/miu' => 'memory',
            '/interfész alap\//miu' => 'connectors',
            '/merevlemez/miu' => 'builtin_hard_drive',
            '/szortírozás/miu' => 'sorting',
            '/pdl/miu' => 'descriptive_language',
        ];
        //dump($data);
        //dd($attributes->pluck('name', 'variable_name'));
        //nincs meg: technology, color_management,
        $customData = [
            'finisher_functions' => isset($data['specificationRows']['Finishing']),
            'automatic_document_feeder' => isset($data['specificationRows']['Lapadagoló']),
        ];

        foreach ($data['specificationRows'] as $group => $rows) {
            foreach ($rows as $desc => $data) {
                foreach ($lookups as $regex => $variableName) {
                    if (preg_match($regex, $desc) === 1) {
                        $result['attributes'][$variableName] = $data;
                    }
                }
            }
            foreach ($tspAttributesData as $variableName => $name) {
                if (\Str::slug(str_ireplace(' ', '', $name)) == \Str::slug(str_ireplace(' ', '', $group))) {
                    $html = [];
                    foreach ($rows as $desc => $data) {
                        $html[] = '<dt>'.$desc.'</dt><dl>'.$data.'</dl>';
                    }
                    $result['attributes'][$variableName] = htmlspecialchars('<dl>'.implode("\n", $html).'</dl>');
                }
            }

        }
        return $result;
    }

    protected static function translateScrapedValue($value, $attributeValueSet)
    {
        //these have to be hardcoded here, sadly
        if ($attributeValueSet->id == 1) {
            //yes: 1001/no: 1002
            return $value == null ? 1001 : 1002;
        }
        if ($attributeValueSet->id == 3) {
            //option available,
        }
    }
}
