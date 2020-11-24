<?php


namespace App\Scrapers;


use Carbon\Carbon;
use DOMDocument;
use DOMXPath;

class NewsScraper
{
    public static function scrapeNews($pages = 3, $urlBase = 'http://www.fotorex.hu/hirek/blog')
    {
        $result = [];
        for ($page = 1; $page <= $pages; $page++) {
            $url = $page == 1
                ? $urlBase
                : $urlBase.'/oldal-'.$page;
            $content = file_get_contents($url);
            $dom = new DOMDocument;
            @$dom->loadHTML($content);
            $xpath = new DOMXpath($dom);
            $trs = $xpath->query('//table[contains(@class, "blog")]/tr');
            foreach ($trs as $tr) {
                $tables = $xpath->query('.//table[contains(@class, "contentpaneopen")]', $tr);
                if (count($tables) % 2 == 0) {
                    foreach ($tables as $index => $table) {
                        if ($index % 2 == 0) {
                            //article head
                            $article = [
                                'title' => '',
                                'published_at' => '',
                                'summary' => '',
                                'content' => '',
                                'slug' => '',
                                'index_image' => null,
                            ];
                            $headings = $xpath->query('.//td[contains(@class, "contentheading")]/a', $table);
                            if (count($headings) > 0) {
                                $article['title'] = trim(str_ireplace(["\t", "\r", "\n"], '', $headings[0]->textContent));
                                $article['slug'] = substr($headings[0]->getAttribute('href'), 1);
                                $body = self::scrapeArticleBody('http://fotorex.hu/'.$article['slug']);
                                $article['published_at'] = $body['date'];
                                $article['content'] = $body['text'];
                            }
                        } else {
                            //article summary
                            $strs = $xpath->query('./tr', $table);
                            if ((count($strs) == 3) || (count($strs) == 1)) {
                                $index = count($strs) == 1 ? 0 : 1;
                                $article['summary'] = self::cleanUpHtml($dom->saveHTML($strs[$index]));
                                $imgs = $xpath->query('.//img', $strs[$index]);
                                if (count($imgs) > 0) {
                                    $article['index_image'] = 'http://fotorex.hu'.$imgs[0]->getAttribute('src');
                                }
                                $article['summary'] = self::cleanUpHtml(preg_replace('/<img.*?>/miu', '', $article['summary']));

                                if ($article['content'] == '') {
                                    $article['content'] = $article['summary'];
                                    $pieces = explode('</p>', $article['summary']);
                                    $article['summary'] = count($pieces) > 1 ? $pieces[0].'</p>' : $pieces[0];
                                }
                                $result[] = $article;
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }

    public static function scrapeArticleBody($url)
    {
        $content = mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', "UTF-8");
        $dom = new DOMDocument;
        @$dom->loadHTML($content);
        $xpath = new DOMXpath($dom);
        $trs = $xpath->query('//table[contains(@class, "contentpaneopen")][not(contains(@class, "heading"))]/tr');
        $result = [
            'date' => now(),
            'text' => '',
        ];
        foreach ($trs as $index => $tr) {
            if ((count($trs) > 1) && ($index == 0)) {
                try {
                    $result['date'] = self::parseDate($tr->textContent);
                } catch (\Exception $e) {
                    $result['date'] = Carbon::createFromFormat('Y-m-d', '1970-01-01');
                }
            }
            if ((count($trs) == 1) || ($index > 1)) {
                $td = $xpath->query('./td', $tr);
                $nodes = $xpath->query('./*', $td[0]);
                foreach ($nodes as $node) {
                    $result['text'] = $result['text'].$dom->saveHTML($node);
                }
            }
            $result['text'] = self::cleanUpHtml($result['text']);
        }

        return $result;
    }

    public static function cleanUpHtml($html)
    {
        $html = preg_replace('/<\/{0,1}table.*?>/miu', '', $html);
        $html = preg_replace('/<\/{0,1}tbody.*?>/miu', '', $html);
        $html = preg_replace('/<\/{0,1}div.*?>/miu', '', $html);
        $html = preg_replace('/<\/{0,1}td.*?>/miu', '', $html);
        $html = preg_replace('/<\/{0,1}tr.*?>/miu', '', $html);
        $html = preg_replace('/style=".*?">/miu', '>', $html);
        $html = preg_replace('/<script[^>]*?">.*?<\/script>/mius', '', $html);
        $html = str_ireplace('&nbsp;', ' ', $html);
        $html = preg_replace('/<p[^>]*?>\s{0,1}<\/p>/mius', '', $html);
        $html = str_ireplace(["\n", "\r"], '', $html);
        $html = preg_replace('/\<strong\s{0,1}\>\s{0,3}\<\/strong\>/miu', '', $html);
        $html = preg_replace('/\<span\s{0,1}\>\s{0,3}\<\/span\>/miu', '', $html);
        $html = preg_replace('/\<p\s{0,1}\>\s{0,3}\<\/p\>/miu', '', $html);
        $html = preg_replace('/\<strong\s{0,1}\>\s{0,3}\<\/strong\>/miu', '', $html);
        $html = preg_replace('/\<span\s{0,1}\>\s{0,3}\<\/span\>/miu', '', $html);
        $html = preg_replace('/\<p\s{0,1}\>\s{0,3}\<\/p\>/miu', '', $html);
        //dump($html);
        //dd(preg_match('/\<strong\s{0,1}\>\s{0,3}\<\/strong\>/miu', $html));
        return $html;
    }

    public static function parseDate($date)
    {
        $months = [
            'január' => '01',
            'február' => '02',
            'március' => '03',
            'április' => '04',
            'május' => '05',
            'június' => '06',
            'július' => '07',
            'augusztus' => '08',
            'szeptember' => '09',
            'október' => '10',
            'november' => '11',
            'december' => '12',
        ];
        $pieces = explode(' ', trim(str_ireplace('.', '', $date)));

        return Carbon::parse($pieces[0].'-'.$months[$pieces[1]].'-'.$pieces[2].' '.$pieces[4].':00');
    }
}