<?php
namespace App\Parser\Extractor;

class KeywordsExtractor implements ExtractorInterface {

    private $keywords = [];
    
    public function __construct() {
        $this->keywords = json_decode(getenv('KEYWORDS')) ?? [];
    }

    public function getContext(String $text): String {
        return $this->getKeywords($text);
    } 

    public function getKeywords(String $text): String {
        $keywords = '';
        $textTokens = explode(' ', preg_replace('/[^A-Za-z0-9\- ]/', '', $text));
        
        $tokensMatched = array_intersect($this->keywords, array_map('strtolower',$textTokens));
        if(!empty($tokensMatched)) {
            $keywords = implode(', ', $tokensMatched);
        } 
        return $keywords;
    }
}