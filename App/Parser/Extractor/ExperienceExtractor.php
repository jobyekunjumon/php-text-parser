<?php
namespace App\Parser\Extractor;

class ExperienceExtractor implements ExtractorInterface {

    private $experienceTitle;
    private $experienceKeywords = [];

    public function __construct() {
        $this->experienceTitle = json_decode(getenv('EXPERIENCE_TITLE')) ?? 'Experience';
        $this->experienceKeywords = json_decode(getenv('EXPERIENCE_KEYWORDS')) ?? [];
    }

    public function getContext(String $text): String {
        return $this->getExperiences($text);
    } 

    public function getExperiences(String $text): String {
        $experience = '';
        if(!empty($text)) {
            $experience = $this->extractExperienceLines($text);
            if(empty($experience)) {
                $experience = $this->extractExperienceByKeywords($text);
            } 
        }
        return $experience;
    }

    public function extractExperienceLines(String $text): String {
        $experience = '';
        $textLines = explode(PHP_EOL, $text);
        if(!empty($textLines) && is_array($textLines)) {
            foreach($textLines as $line) {
                if(stripos($line, $this->experienceTitle)) {
                    $experience .= ' '.$line;
                }
            } 
        }
        return $experience;
    }

    public function extractExperienceByKeywords(String $text): String {
        $experiences = '';
        $textTokens = explode(' ', preg_replace('/[^A-Za-z0-9\- ]/', '', $text));
        
        $tokensMatched = array_intersect($this->experienceKeywords, array_map('strtolower',$textTokens));
        if(!empty($tokensMatched)) {
            $experiences = implode(', ', $tokensMatched);
        } 
        return $experiences;
    }
}