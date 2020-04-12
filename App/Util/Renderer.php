<?php
namespace App\Util;

class Renderer {
    /**
     * @var String
     */
    private $message;

    /**
     * @var String
     */
    private $errorMessage;

    /**
     * @var Array
     */
    private $data;

    /**
     * Set data property
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param Arra $data 
     */
    public function setData(Array $data) {
        $this->data = $data;
    }

    /**
     * Get data property
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return Array $data 
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Get message property
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return String $message 
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Set message property
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param String $message 
     */
    public function setMessage(String $message) {
        $this->message = $message ?? null;
    }

    /**
     * Get errorMessage property
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return String $errorMessage 
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * Set errorMessage property
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param String $errorMessage 
     */
    public function setErrorMessage(String $errorMessage) {
        $this->errorMessage = $errorMessage ?? null;
    }
}