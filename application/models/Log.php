<?php


/**
 * Class Log
 *
 * Clase para guardar los logs de las peticiones al webservice
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class Log
{
    /**
     * @var PDO
     */
    protected $_connection = null;

    /**
     * @var int
     */
    public $_logId = null;

    /**
     *
     * Log constructor.
     *
     */
    public function __construct() {
        $this->_connection = DbConnection::getDbo();
    }

    /**
     *
     * Insert el request en la tabla pse_log
     *
     * @param string $sLogType
     * @param string $sRequest
     *
     * @author Jhonatan Alexis Monsalve Marín <jamonsalve@cognox.com>
     * @return string
     */
    public function insert($sLogType, $sRequest) {
        $sQuery = "INSERT INTO pse_log (log_type, log_request, log_ipAddress, log_date) VALUES (?, ?, ?, ?)";
        $oStatement = $this->_connection->prepare($sQuery);
        $oStatement->execute(array(
            $sLogType,
            $sRequest,
            $_SERVER['REMOTE_ADDR'],
            date('Y-m-d H:i:s')
        ));
        return $this->_connection->lastInsertId();
    }

    /**
     *
     * Actualiza el log con el Response
     *
     * @param int $iLogId
     * @param string $sResponse
     * @param float $fDuration
     *
     * @author Jhonatan Alexis Monsalve Marín <jamonsalve@cognox.com>
     */
    public function update($iLogId, $sResponse, $fDuration) {
        $sQuery = "
            UPDATE pse_log
                SET
                  log_response = ?,
                  log_duration = ?,
                  log_date = ?
            WHERE
                log_id = ?
            ";
        $oStatement = $this->_connection->prepare($sQuery);
        $oStatement->execute(array(
            $sResponse,
            $fDuration,
            date('Y-m-d H:i:s'),
            $iLogId
        ));
    }
}