<?php
/**
 * Autoloader function 
 * @author Joby E Kunjumon <jobyekunjumon@gmail.com>
 * @param string $className Name of class
 */
function loadClass($className) {
    $fileName = '';
    $namespace = '';

    $includePath = dirname(__FILE__);

    if (false !== ($lastNsPos = strripos($className, '\\'))) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    $fullFileName = $includePath . DIRECTORY_SEPARATOR . $fileName;
   
    if (file_exists($fullFileName)) {
        require $fullFileName;
    } else {
        echo 'Class "'.$fullFileName.'" does not exist.';
    }
} //end: function loadClass

spl_autoload_register('loadClass');

// include configurations
if(file_exists(__DIR__.'/App/Configs/configs.env.php')) {
    require_once('App/Configs/configs.env.php');
}