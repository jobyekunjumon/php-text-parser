<?php
namespace App\Util;
use Mysqli;

class Db {
    /**
     * @var Object
     */
    protected $connection;

    /**
     * @var Object 
     */
    protected $query;

    /**
     * @var String
     */
    protected $error;

    /**
     * @var Bool
     */
    protected $showErrors = false;

    /**
     * class constructor
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param String $configs
     */
	public function __construct($configs) {
		$this->connection = new Mysqli($configs['HOST'], $configs['USER'], $configs['PASSWORD'], $configs['DB_NAME']);
		if ($this->connection->connect_error) {
			$this->error('Failed to connect to MySQL');
        }
	}

    /**
     * prepare and execute query
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param String $query
     * @return Object $this
     */
    public function query($query) {
        $this->query = $this->connection->prepare($query);
		if ($this->query) {
            if (func_num_args() > 1) {
                $arguments = func_get_args();
                $args = array_slice($arguments, 1);
				$types = '';
                $argsList= [];
                foreach ($args as $key => &$arg) {
					if (is_array($args[$key])) {
						foreach ($args[$key] as $innerKey => &$innerArg) {
							$types .= $this->getType($args[$key][$innerKey]);
							$argsList[] = &$innerArg;
						} // end: if
					} else {
	                	$types .= $this->getType($args[$key]);
	                    $argsList[] = &$arg;
					} // end: if
                } // end: foreach
                array_unshift($argsList, $types);
                
                call_user_func_array(array($this->query, 'bind_param'), $argsList);
            } // end: if
            $this->query->execute();

        } else {
            $this->error('Unable to prepare MySQL statement');
        } // end: if

		return $this;
    }
    
    /**
     * fetch all rows 
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param Array $data
     * @return Array $data
     */
    public function sanitizeData($data) {
         if(!is_array($data)) {
             $data = $this->connection->real_escape_string( $data );
             $data = trim(htmlentities($data, ENT_QUOTES, 'UTF-8', false));
         } else {
             $data = array_map([$this, 'sanitizeData'], $data );
         } // end: if
         return $data;
    }

    /**
     * get number of rows
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return int 
     */
    public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

    /**
     * get number of affected rows
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return int 
     */
	public function affectedRows() {
		return $this->query->affected_rows;
    }
    
    /**
     * handle error
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @return int 
     */
    public function error($error) {
        if ($this->showErrors) {
            exit($error);
        }
    }

    /**
     * get type of variable
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     * @param mixed $var 
     * @return String 
     */
	private function getType($var) {
        $type = 'b';

	    if (is_string($var)) { 
            $type = 's';
        } else if (is_float($var)) { 
            $type = 'd';
        } else if (is_int($var)) {
            $type = 'i';
        } // end: if

	    return $type;
    }

    /**
     * close connection
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     */
	public function close() {
		return $this->connection->close();
    }
    
    /**
     * class destructor
     * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
     */
    public function __destruct() {
        $this->close();
    }

}
