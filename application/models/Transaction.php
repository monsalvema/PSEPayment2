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
     * Crea una transacción en la base de datos
     *
     * @return string
     */
    public function createTransaction() {
        $sQuery = "INSERT INTO pse_transaction (trn_log_id, trn_status, trn_message, trn_ip, trn_date)
            VALUES (?, ?, ?, ?, ?)";
        $oStatement = $this->_connection->prepare($sQuery);
        $oStatement->execute(array(
            null,
            'Initial',
            null,
            $_SERVER['REMOTE_ADDR'],
            date('Y-m-d H:i:s')
        ));
        return $this->_connection->lastInsertId();
    }

    /**
     * Actualizar de estado de la transacción y guardar los datos importantes que devuelva el webservice
     *
     * @param int $iTransactionId
     * @param string $sStatus
     * @param string $sTransactionPseId
     */
    public function updateTransaction($iTransactionId, $sStatus, $sMessage = null, $sTransactionPseId = null) {
        $sQuery = "
        UPDATE pse_transaction
            SET
                trn_status = ?,
                trn_message = ?,
                trn_transactionpseid = ?
        WHERE
            trn_id = ?";
        $oStatement = $this->_connection->prepare($sQuery);
        $oStatement->execute(array($sStatus, $sMessage, $sTransactionPseId, $iTransactionId));
    }
} 