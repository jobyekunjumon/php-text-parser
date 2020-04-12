<?php
namespace App\Parser;

class Parser {

    private $response;
    
    private $extractors = [];

    /**
     * Class constructor
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     */
    public function __construct() {
        $extractors = json_decode(getenv('FIELDS_TO_EXTRACT'), true);
        if(!empty($extractors)) {
            foreach($extractors as $fieldName => $fieldType) {
                $extractorClass = '\App\Parser\Extractor\\'.ucwords($fieldName).'Extractor';
                if(class_exists($extractorClass)) {
                    $this->extractors[$fieldName] = $extractorClass;
                }
            }
        }
    }

    /**
     * Parse Text
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param String $text
     */
    public function parse(String $text) {
        if(!empty($text) && !empty($this->extractors)) {
            foreach($this->extractors as $fieldName => $extractor) {
                $extractorInstance = new $extractor();
                $this->response[$fieldName] = $extractorInstance->getContext($text);
            }
        }
        return $this->response;
    }
}