<?php
namespace App\Parser\Extractor;

class UrlExtractor implements ExtractorInterface {

    public function getContext($text): String {
        return $this->getUrls($text);
    } 

    public function getUrls($text) {
        $urls = '';
        $pattern = '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#';
        preg_match_all($pattern, $text, $matches);
        if(!empty($matches[0]) && is_array($matches[0])) {
            $urls = implode(' , ',$matches[0]);
        }
        return $urls;
    }
}