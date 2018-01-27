<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

date_default_timezone_set('America/Bogota');

define('APPLICATION_PATH', realpath('.'));

try {

    include APPLICATION_PATH . "/application/config/Config.php";
    include APPLICATION_PATH . "/application/config/Autoload.php";

    Autoload::register();

    $sAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $oController = new controller();

    switch ($sAction) {
        case 'transaction':
            $oController->transaction();
            break;
        case 'confirm':
            $oController->confirm();
            break;
        default:
            $oController->firstPage();
            break;
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}