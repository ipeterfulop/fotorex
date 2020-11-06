<?php


namespace App\Scrapers;


use DOMDocument;
use DOMXPath;

class SharpScraper
{
    public static function scrapeProductsPage($url, $ignore = [])
    {
        $products = json_decode(mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8"))->products;
        $result = [];

        foreach ($products as $product) {
            if (isset($product->product_id)) {
                if (array_search($product->product_id, $ignore) === false) {
                    $result[$product->product_id] = 'https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-office-print.htm?product='.$product->product_id;
                }
            }
        }

        return $result;
    }

    public static function scrapeProductPage($url)
    {
        $content = mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8");
        $dom = new DOMDocument;
        @($dom->loadHTML($content));
        $xpath = new DOMXpath($dom);
        $result = [
            'name' => '',
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
            if ($element->textContent == 'Áttekintés' ) {
                $paragraphs = $xpath->query('.//p', $element->parentNode);
                foreach($paragraphs as $paragraph) {
                    $paragraphText = str_ireplace(["\r", "\n", "<p>"], '', $dom->saveHTML($paragraph));
                    $paragraphText = str_ireplace("</p>", "<br>", $paragraphText);
                    foreach (explode("<br>", $paragraphText) as $pt) {
                        if (trim($pt) != '') {
                            $result['descriptionParagraphs'][] = trim($pt);
                        }
                    }
                }
            }
            if ($element->textContent == 'Műszaki jellemzők' ) {
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
            $rawContent = str_ireplace(['</div>','<dt>','</dt>', '</dd>', '<dl>'], '', $rawContent);
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
}
