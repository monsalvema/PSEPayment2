<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

define('APPLICATION_PATH', realpath('.'));

try {

    include APPLICATION_PATH . "/application/config/Config.php";
    include APPLICATION_PATH . "/application/config/Autoload.php";

    Autoload::register();

} catch (\Exception $e) {
    echo $e->getMessage();
}