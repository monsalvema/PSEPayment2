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
    protected $webserviceproxy = null;

    /**
     * Método constructor
     */
    public function __construct() {
        $this->webserviceproxy = new WebServiceProxy();
    }

    /**
     * Método que obtiene la lista de bancos
     *
     * @return bool|mixed
     */
    public function getBankList() {
        return $this->webserviceproxy->callMethod(__FUNCTION__, array());
    }

    /**
     * Método que crea una transacción en PSE
     *
     * @param array $aParams
     * @return bool|mixed
     */
    public function createTransaction($aParams) {
        return $this->webserviceproxy->callMethod(__FUNCTION__, $aParams);
    }

    /**
     * @param array $aParams
     * @return bool|mixed
     */
    public function getTransactionInformation($aParams) {
        return $this->webserviceproxy->callMethod(__FUNCTION__, $aParams);
    }

    public function getCreateTransactionRequest() {
        return array(
            'transaction' => array(
                //Se queman valores de prueba
                'bankCode' => null,
                'bankInterface' => null,
                'returnURL' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?action=confirm' ,
                'reference' => null,
                'description' => 'Pago prueba',
                'language' => 'ES',
                'currency' => 'COP',
                'totalAmount' => 1,
                'taxAmount' => 0,
                'devolutionBase' => 0,
                'tipAmount' => 0,
                'payer' => array(
                    //Se queman estos valores para simular los datos del pagador
                    'documentType' => 'CC',
                    'document' => '1036608350',
                    'firstName' => 'Jhonatan',
                    'lastName' => 'Monsalve',
                    'company' => 'company',
                    'emailAddress' => 'monsalvema87@hotmail.com',
                    'address' => 'Cll 1',
                    'city' => 'Medellín',
                    'province' => 'Antioquia',
                    'country' => 'Colombia',
                    'phone' => '2858320',
                    'mobile' => '3106874533'
                ),
                'buyer' => array(
                    'documentType' => null,
                    'document' => null,
                    'firstName' => null,
                    'lastName' => null,
                    'company' => null,
                    'emailAddress' => null,
                    'address' => null,
                    'city' => null,
                    'province' => null,
                    'country' => null,
                    'phone' => null,
                    'mobile' => null
                ),
                'shipping' => array(
                    'documentType' => null,
                    'document' => null,
                    'firstName' => null,
                    'lastName' => null,
                    'company' => null,
                    'emailAddress' => null,
                    'address' => null,
                    'city' => null,
                    'province' => null,
                    'country' => null,
                    'phone' => null,
                    'mobile' => null
                ),
                'ipAddress' => null,
                'userAgent' => null
            )
        );
    }
} 