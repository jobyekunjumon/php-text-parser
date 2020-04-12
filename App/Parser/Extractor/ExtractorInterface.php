<?php
namespace App\Parser\Extractor;

interface ExtractorInterface {
    public function getContext(String $text): String;
}