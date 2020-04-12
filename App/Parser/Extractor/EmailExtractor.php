<?php
namespace App\Parser\Extractor;

class EmailExtractor implements ExtractorInterface {

    public function getContext($text): String {
        return $this->getEmail($text);
    } 

    
    public function getEmail($text) {
        $email = '';
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $text, $matches);
        if(!empty($matches[0][0])) {
            $email = $matches[0][0];
        }
        return $email;
    }
}