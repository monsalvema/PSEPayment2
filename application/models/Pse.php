<?php

/**
 * Class Pse
 *
 * Clase que expone las funcionalidades del webservice de Pse
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class Pse
{
    /**
     * @var WebServiceProxy
     */
    protected  $webserviceproxy = null;

    /**
     * Método constructor
     */
    public function __construct() {
        $this->webserviceproxy = new WebServiceProxy();
    }

    public function getBankList() {
        return $this->webserviceproxy->callMethod(__FUNCTION__, array());
    }
} 