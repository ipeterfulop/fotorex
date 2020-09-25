<?php


namespace App\Scrapers;


use DOMDocument;
use DOMXPath;

class LexmarkScraper
{
    public static function scrapeProductPage($url)
    {
        die('még nincs kész');
        $content = mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8");
        $dom = new DOMDocument;
        @$dom->loadHTML($content);
        $xpath = new DOMXpath($dom);
        $result = [
            'name' => '',
            'descriptionParagraphs' => [],
            'specifications' => [],
            'images' => [],
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
        return $result;
    }

}