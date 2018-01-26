<?php


/**
 * Class config
 *
 * Clase que expone las variables de configuración
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class Config {

    public static $database = array(
        'dsn'         => 'mysql:dbname=psepayment;host=cxsrv002.cognox.com;port=3307',
        'username'    => 'root',
        'password'    => 'root',
    );
    public static $classes = array(
        'config' => "/application/config/Config.php",
        'DbConnection' => "/application/config/DbConnection.php",
        'Log' => "/application/models/Log.php",
        'WebservicePse' => "/application/models/WebservicePse.php",
    );
    public static $pseUrl = "https://test.placetopay.com/soap/pse/?wsdl";
    public static $pseEndPoint = "https://test.placetopay.com/soap/pse/";
    public static $login = "6dd490faf9cb87a9862245da41170ff2";
    public static $transactionKey = "024h1IlD";
}