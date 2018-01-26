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
class WebServiceProxy
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
                'trace' => true,
            )
        );
        $this->_soapClient->__setLocation(Config::$pseEndPoint);
    }

    /**
     * Método que calcula los datos para la autenticación
     *
     * @return array
     */
    private function getAutenticationData() {
        $sSeed = date('c');
        $sHash = sha1($sSeed . Config::$transactionKey);
        return array(
            'auth' => array(
                'login' => (string) Config::$login,
                'tranKey' => (string) $sHash,
                'seed' => (string) $sSeed
            )
        );
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
            $aParams = array_merge($this->getAutenticationData(), $aArguments);
            $fInitalTime = microtime(true);
            $mResult = $this->_soapClient->{$sMethodName}($aParams);
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