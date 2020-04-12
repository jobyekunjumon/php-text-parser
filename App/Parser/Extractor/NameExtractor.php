<?php
namespace App\Parser\Extractor;

class NameExtractor implements ExtractorInterface {

    private $namePatterns = [];

    public function __construct() {
        $this->namePatterns = json_decode(getenv('NAME_PATTERNS')) ?? [];
    }

    public function getContext(String $text): String {
        return $this->getName($text);
    } 

    public function getName(String $text): String {
        $name = '';
        $name = $this->getNameFromPattern($text);
        // try to get name from email
        if(empty($name)) {
            $name = $this->getNameFromEmail($text);
        }

        return $name;
    }

    public function getNameFromEmail(String $text): String {
        $name = '';
        // get email if exists
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $text, $matches);
        if(!empty($matches[0][0])) {
            $name = explode('@', $matches[0][0])[0] ?? '';
        }
        return $name;
    }

    public function getNameFromPattern(String $text): String {
        $name = '';
        foreach($this->namePatterns as $pattern) {
            $regexPattern =  '/(?<=\b'.$pattern.'\s)(?:[\w-]+)/is';
            preg_match_all($regexPattern, $text, $matches);
            if(!empty($matches[0][0])) {
                $name = $matches[0][0];
                break;
            }
        }
        return $name;
    }
}