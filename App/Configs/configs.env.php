<?php
$settings = [
    'DB' => [
        'HOST' => '127.0.0.1',
        'USER' => 'root',
        'PASSWORD' => 'root',
        'DB_NAME' => 'text_parser'
    ],
    'FIELDS_TO_EXTRACT' => [
        'name' => 'text', 
        'email' => 'email', 
        'phone' => 'text',
        'experience' => 'textarea',
        'keywords' => 'textarea',
        'url' => 'textarea'
    ],
    'KEYWORDS' => [
        'mysql', 
        'php', 
        'php7', 
        'git', 
        'javascript', 
        'zend', 
        'zend framework', 
        'html', 
        'api', 
        'rest', 
        'aws', 
        's3'
    ],
    'EXPERIENCE_KEYWORDS' => [
        'mysql', 
        'php', 
        'php7', 
        'git', 
        'javascript', 
        'zend', 
        'zend framework', 
        'html', 
        'api', 
        'rest', 
        'aws', 
        's3'
    ],
    'EXPERIENCE_TITLE' => 'Experience',
    'NAME_PATTERNS' => [
        'name is', 
        'i am', 
        'name:',
        'name :',
        'name'
    ]
];

foreach ($settings as $key => $value) {
    putenv($key.'='.json_encode($value));
}