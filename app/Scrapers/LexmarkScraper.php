<?php


namespace App\Scrapers;


use DOMDocument;
use DOMXPath;

class LexmarkScraper
{
    public static function scrapeProductsPage($url, $ignore = [])
    {
        $content = mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8");
        $dom = new DOMDocument;
        @$dom->loadHTML($content);
        $xpath = new DOMXpath($dom);
        $result = [];
        $anchors = $xpath->query('//div[contains(@class, "product-text-link")]/a');
        foreach ($anchors as $a) {
            $add = true;
            foreach ($ignore as $i) {
                if (stripos($a->getAttribute('href'), $i) !== false) {
                    $add = false;
                }
            }
            if ($add) {
                $link = $a->getAttribute('href');
                if (substr($link, 0, 4) != 'http') {
                    $link = 'https://lexmark.com'.$link;
                }
                $result[] = $link;
            }
        }

        return $result;
    }

    public static function scrapeProductPage($url)
    {
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
        $elements = $xpath->query('//div[contains(@class, "product-detail-name section")]/h1');
        if (count($elements) > 0) {
            $result['name'] = trim($elements[0]->textContent);
        }
        $headers = $xpath->query('//div[@id="overview"]//div[contains(@class, "row")]//h4');
        $elements = $xpath->query('//div[@id="overview"]//div[contains(@class, "row")]//p');
        foreach ($headers as $index => $row) {
            if (isset($elements[$index])) {
                $result['descriptionParagraphs'][trim($row->textContent)] = trim($elements[$index]->textContent);
            }
        }
        $headers = $xpath->query('//div[contains(@class, "product-detail")]//div[contains(@class, "row")]//h3');
        $elements = $xpath->query('//div[contains(@class, "product-detail")]//div[contains(@class, "row")]//table');
        foreach ($headers as $index => $row) {
            if (isset($elements[$index])) {
                $result['specifications'][trim($row->textContent)] = $dom->saveHTML($elements[$index]);
            }
        }

        $images = $xpath->query('//div[contains(@class, "product-detail-carousel")]//img[contains(@class, "center-block")]');
        foreach ($images as $image) {
            $link = $image->getAttribute('src');
            $link = substr($link, 0, 4) == 'http' ? $link : 'https:'.$link;
            $result['images'][] = $link;
        }

        return $result;
    }

}