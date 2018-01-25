<?php


/**
 * Class DbConnection
 *
 * Clase para la conexión a la base de datos
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0

 */
class DbConnection
{
    /**
     * @var PDO
     */
    static protected $_connection = null;

    /**
     *
     * Obtiene la conexión a la base de datos
     *
     * @author Jhonatan Alexis Monsalve Marín <jamonsalve@cognox.com>
     * @return PDO
     * @throws Exception
     */
    static public function getDbo() {
        try {
            if (null === self::$_connection) {
                self::$_connection = new \PDO(
                    Config::$database['dsn'],
                    Config::$database['username'],
                    Config::$database['password']
                );
            }
            return self::$_connection;
        } catch (\PDOException $e) {
            throw new \Exception('1', 'Database connection failed' . $e->getMessage());
        }
    }
}