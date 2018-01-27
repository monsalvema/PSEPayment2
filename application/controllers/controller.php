<?php

/**
 * Class controller
 *
 * Controlador de la aplicación
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 *
 */
class controller
{
    /**
     *
     * Función que redirige a la primera página
     *
     * @author Jhonatan Alexis Monsalve Marín <jamonsalve@cognox.com>
     * @version SVN:$id$
     */
    public function firstPage($sDefaultMessage = null) {
        $aCacheBanks = Cache::get();
        if (count($aCacheBanks) > 0) {
            $oBanks = $aCacheBanks;
        } else {
            $oPse = new Pse();
            $oBanks = $oPse->getBankList();
            $oBanks = isset($oBanks->getBankListResult->item) ? $oBanks->getBankListResult->item : array();
            Cache::put($oBanks);
        }
        $sMessage = $sDefaultMessage;
        if (count($oBanks) <= 0) {
            $sMessage .= "*No se pudo obtener la lista de Entidades Financieras, por favor intente más tarde.";
        }
        require_once($this->getView('default'));
    }

    /**
     * Método que realiza la transacción
     */
    public function transaction() {
        $iBankId = isset($_POST['slcBanks']) ? $_POST['slcBanks'] : '';
        if ('' != $iBankId && $iBankId != 0) {
            try {
                $iAccountType = $_POST['cuenta'];
                $oTransaction = new Transaction();
                //Se asigna un valor genérico de pruebas para las transacciones
                $iTransactionId = $oTransaction->createTransaction(1);
                $oPse = new Pse();
                $aParams = $oPse->getCreateTransactionRequest();
                $aParams['transaction']['bankCode'] = $iBankId;
                $aParams['transaction']['bankInterface'] = $iAccountType;
                $aParams['transaction']['reference'] = $iTransactionId;
                $aParams['transaction']['ipAddress'] = $_SERVER['REMOTE_ADDR'];
                $aParams['transaction']['returnURL'] .= "&trn={$iTransactionId}";
                $oTransactionResponse = $oPse->createTransaction($aParams);
                if ($oTransactionResponse && isset($oTransactionResponse->createTransactionResult)) {
                    if ('SUCCESS' == $oTransactionResponse->createTransactionResult->returnCode) {
                        $oTransaction->updateTransaction($iTransactionId, 'Processing', null
                            , $oTransactionResponse->createTransactionResult->transactionID);
                        $this->redirect($oTransactionResponse->createTransactionResult->bankURL);
                    } else {
                        $sMessage = "*{$oTransactionResponse->createTransactionResult->responseReasonText}";
                        $oTransaction->updateTransaction($iTransactionId, 'Error', $sMessage);
                        $this->firstPage($sMessage);
                    }
                } else {
                    $sMessage = "*Error conexión PSE <br/>";
                    $oTransaction->updateTransaction($iTransactionId, 'Error', $sMessage);
                    $this->firstPage($sMessage);
                }
            } catch (Exception $e) {
                $this->firstPage($e->getMessage());
            }
        } else {
            $sMessage = "*Error. No seleccionó banco <br/>";
            $this->firstPage($sMessage);
        }
    }

    /**
     * Buscar la transacción y mostrar el estado de esta
     */
    public function confirm() {
        $iTransactionId = isset($_REQUEST['trn']) ? $_REQUEST['trn'] : 0;
        if ($iTransactionId > 0) {
            $oTransaction = new Transaction();
            $oCurrentTransaction = $oTransaction->getTransaction($iTransactionId);
            if ($oCurrentTransaction) {
                $oPse = new Pse();
                $oPseTransaction = $oPse->getTransactionInformation(array(
                    'transactionID' => $oCurrentTransaction->trn_transactionpseid)
                );
                if (isset($oPseTransaction->getTransactionInformationResult)) {
                    $oTransaction->updateTransaction($oCurrentTransaction->trn_id
                        , $oPseTransaction->getTransactionInformationResult->transactionState);
                    $oResponse = (object) array(
                        'SystemTransaction' => $oCurrentTransaction,
                        'PseTransasction' => $oPseTransaction->getTransactionInformationResult
                    );
                    require_once($this->getView('confirm'));
                } else {
                    $sMessage = "Error consultando transacción PSE";
                    require_once($this->getView('confirm'));
                }
            } else {
                $sMessage = "Error, la transacción no existe";
                require_once($this->getView('confirm'));
            }
        } else {
            $sMessage = "Error";
            require_once($this->getView('confirm'));
        }
    }

    /**
     * Obtiene la Url de la vista
     *
     * @param string $sViewName
     * @return string
     */
    private function getView($sViewName) {
        return Config::$urlViews . $sViewName . DIRECTORY_SEPARATOR . $sViewName . '.php';
    }

    /**
     * Realiza el redirect hacia PSE
     *
     * @param string $sUrl
     */
    private function redirect($sUrl) {
        header("Location: {$sUrl}");
        exit;
    }
}