<?php
namespace App\Controllers;

use App\Util\Renderer;
use App\Parser\Parser;

class IndexController extends \App\Util\Request {
    /**
     * @var Object Renderer
     */
    public $view;

    /**
     * class constructor
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     */
    public function __construct() {
        $this->view = new Renderer();
        parent::__construct();
    } 

    /**
     * process request
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return Object Renderer view
     */
    public function execute() : Renderer {
        if($this->isPost()) { 
            $data = $this->getPost();
            $validationErrors = $this->validateRequest($data);

            if(empty($validationErrors)) {
                $parser = new Parser();
                $parsedData = $parser->parse($data['text']);
                if(!empty($parsedData)) { 
                    $this->view->setData(['showParsedDataForm' => 'true', 'formData' => $parsedData, 'text' => $data['text'], 'fields' => json_decode(getenv('FIELDS_TO_EXTRACT'), true)]);
                } else {
                    $this->view->setErrorMessage('Something went wrong while parsing the data.');
                }
            } else {
                $this->view->setErrorMessage('You have some validation errors. '.$validationErrors);
            }
        }

        return $this->view;
    }

    /**
     * Validate request
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param array $data Input Data
     * @return String validationErrors
     */
    public function validateRequest(Array $data):String {
        $validationErrors = '';
        
        if(!isset($data['text']) || !trim($data['text'])) {
            $validationErrors = 'Text field is empty.';
        }  

        return $validationErrors;
    }

}
