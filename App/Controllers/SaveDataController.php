<?php
namespace App\Controllers;

use App\Util\Renderer;
use App\Util\Db;

class SaveDataController extends \App\Util\Request {
    /**
     * @var Object Renderer
     */
    public $view;

    /**
     * @var Object Db
     */
    private $db;

    /**
     * @var Array 
     */
    private $fields;

    /**
     * class constructor
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     */
    public function __construct() {
        $this->view = new Renderer();
        $this->db = new Db(json_decode(getenv('DB'), true));
        $this->fields = json_decode(getenv('FIELDS_TO_EXTRACT'), true);
        parent::__construct();
    }
    
    /**
     * process request
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return Object Renderer view
     */
    public function execute(): Renderer {
        if($this->isPost()) { 
            $data = $this->getPost();
            
            $cleanData = $this->db->sanitizeData($data);

            $isValidRequest = $this->isValidRequest($cleanData);

            if($isValidRequest) {
                $isDataSaved = $this->saveData($cleanData);
                if(!empty($isDataSaved)) { 
                    $this->view->setMessage('Your data saved successfully');
                } else {
                    $this->view->setErrorMessage('Something went wrong while processing the data.');
                }
            } else {
                $this->view->setErrorMessage('You have some validation errors. Atleast one field is required to save your data.'.$validationErrors);
            }
        }

        return $this->view;
    }

    /**
     * Insert data to db
     * @param Array $data
     * @return Int $isSaved
     */
    public function saveData(Array $data): Int {
        $isDataSaved = 0;

        $query = $this->getQuery($data);
        if(!empty($query['queryString']) && !empty($query['values'])) {
            $isDataSaved = $this->db->query($query['queryString'], ...$query['values'])->affectedRows();
        }
        return $isDataSaved;
    }

    /**
     * Prepare query 
     * @param Array $data
     * @return Array $query
     */
    public function getQuery(Array $data) : Array {
        $query = [];
        if(!empty($this->fields) && is_array($this->fields)) {
            $valueData = []; 
            $values = ''; 
            $fields = '';
            $conj = '';
            foreach($this->fields as $field => $fieldType) {
                if(!empty($data[$field])) {
                    $fields .= $conj . '`'. $field.'`';
                    $values .= $conj . '?';
                    $valueData[] = $data[$field];
                    $conj = ', ';
                }
            }

            if(!empty($fields) && !empty($values) && !empty($valueData)) {
                $queryString = 'INSERT INTO `description` ('.$fields.') VALUES ('.$values.') ';
                $query['queryString'] = $queryString;
                $query['values'] = $valueData;
            }
        }

        return $query;
    }

    /**
     * Validate request
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param array $data Input Data
     * @return Bool isValid
     */
    public function isValidRequest(Array $data): Bool {
        $isValid = false;
        // make sure that atleast one field is not empty to save the data
        foreach($this->fields as $field => $fieldType) {
            if(!empty($data[$field])) {
                $isValid = true;
                break;
            }
        }
        return $isValid;
    }
}
