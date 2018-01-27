<?php

/**
 * Class Transaction
 *
 * Clase como modelo para guardar la información de la transacción
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class Transaction
{
    /**
     * @var PDO
     */
    protected $_connection = null;

    /**
     * Constructor
     */
    public function __construct() {
        $this->_connection = DbConnection::getDbo();
    }

    /**
     * Obtiene la información de una transacción en el sistema
     *
     * @param int $iTransactionId
     * @return mixed
     */
    public function getTransaction($iTransactionId) {
        $sQuery = "SELECT * FROM pse_transaction WHERE trn_id = ?";
        $oStatement = $this->_connection->prepare($sQuery);
        $oStatement->execute(array($iTransactionId));
        return $oStatement->fetchObject();
    }

    /**
     * Crea una transacción en la base de datos
     *
     * @param float $fTransactionValue
     * @throws Exception
     * @return string
     */
    public function createTransaction($fTransactionValue) {
        try {
            $sQuery = "INSERT INTO pse_transaction (trn_status, trn_value, trn_ip, trn_date)
                VALUES (?, ?, ?, ?)";
            $oStatement = $this->_connection->prepare($sQuery);
            $oStatement->execute(array(
                'Initial',
                $fTransactionValue,
                $_SERVER['REMOTE_ADDR'],
                date('Y-m-d H:i:s')
            ));
            return $this->_connection->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    /**
     * Actualizar de estado de la transacción y guardar los datos importantes que devuelva el webservice
     *
     * @param int $iTransactionId
     * @param string $sStatus
     * @param null $sMessage
     * @param string $sTransactionPseId
     */
    public function updateTransaction($iTransactionId, $sStatus, $sMessage = null, $sTransactionPseId = null) {
        $aSet = array("trn_status = '{$sStatus}'");
        if ($sMessage !== null) {
            $aSet[] = "trn_message = '{$sMessage}'";
        }
        if ($sTransactionPseId != null) {
            $aSet[] = "trn_transactionpseid = {$sTransactionPseId}";
        }
        $sSet = implode(',', $aSet);
        $sQuery = "
        UPDATE pse_transaction
            SET
              {$sSet}
        WHERE
            trn_id = ?";
        $oStatement = $this->_connection->prepare($sQuery);
        $oStatement->execute(array($iTransactionId));
        $_COOKIE['LogId'] = '';
    }
} 