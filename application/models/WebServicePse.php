<?php

/**
 * Class webServiceProxy
 *
 * Clase que expone las funcionalidades para la conexión con el webservice
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class WebServicePse
{
    /**
     * @var SoapClient
     */
    private $_soapClient = null;

    /**
     * webServicePse constructor.
     */
    public function __construct() {
        $this->_soapClient = new SoapClient(
            Config::$pseUrl,
            array(
                'trace' => true
            )
        );
        $this->_soapClient->__setLocation(Config::$pseEndPoint);
    }

    /**
     *
     * Llama un método
     *
     * @param string $sMethodName
     * @param array $aArguments
     *
     * @author Jhonatan Alexis Monsalve Marín <jamonsalve@cognox.com>
     * @return bool|mixed
     */
    public function callMethod($sMethodName, $aArguments) {
        try {
            $fInitalTime = microtime(true);
            $mResult = $this->_soapClient->__soapCall($sMethodName, $aArguments);
            $fFinalTime = microtime(true);

            $oLog = new Log();
            $iLogId = $oLog->insert($this->_soapClient->__getLastRequest());
            $oLog->update($iLogId, $this->_soapClient->__getLastResponse(), $fFinalTime - $fInitalTime);

            return $mResult;
        } catch (SoapFault $e) {
            return false;
        }
    }
}