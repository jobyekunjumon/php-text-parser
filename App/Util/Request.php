<?php
namespace App\Util;

class Request {
    /**
     * @var Array 
     */
    private $post;


    /**
     * Class constructor
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     */
    public function __construct() {
        $this->post = $_POST ?? [];
    }

    /**
     * Check whether request is post request
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return bool 
     */
    public function isPost() {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    /**
     * Return post request parameters
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return Array $post
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * Redirect to a particular url using relative path
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return Array $files
     */
    public function redirect(String $url) {
        if(!empty($url)) {
            ob_start();
            header('Location: '.$url);
        }
    }
}