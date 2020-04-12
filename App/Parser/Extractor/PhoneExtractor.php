<?php
namespace App\Parser\Extractor;

class PhoneExtractor implements ExtractorInterface {

    public function getContext($text): String {
        return $this->getPhoneNumber($text);
    } 

    public function getPhoneNumber($text) {
        $phone = '';
        $pattern = '/(\+?[\d-\(\)\s]{8,20}[0-9]?\d)/';
        preg_match_all($pattern, $text, $matches);
        if(!empty($matches[0][0])) {
            $phone = $matches[0][0];
        }
        return $phone;
    }
}