<?php

/**
 * Class Cache
 *
 * Clase para la implementación del cache de la lista de los bancos
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class Cache {

    /**
     * Obtiene la ruta del archivo caché
     *
     * @return string
     */
    private  static function getRoute() {
        return APPLICATION_PATH . DIRECTORY_SEPARATOR . Config::$cachePath;
    }

    /**
     * Guarda los datos en el archivo caché
     *
     * @param array $aContent
     * @return bool
     */
    public static function put($aContent) {
        $sFileName = self::getRoute() . 'Banks_' .date('Ymd') . '.php';
        if (file_put_contents($sFileName, serialize($aContent))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Obtiene el archivo de caché
     *
     * @return string
     */
    public static function get() {
        $sRoute = self::getRoute() . 'Banks_' . date('Ymd') . '.php';
        $aContent = array();
        if (file_exists($sRoute)) {
            $sContent = file_get_contents($sRoute);
            $aContent = unserialize($sContent);
        }
        return $aContent ;
    }
}