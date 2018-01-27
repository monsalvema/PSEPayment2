<?php


/**
 * Class Loader
 *
 * Carga automáticamente las clases que son requeridas
 *
 * @author Jhonatan Alexis Monsalve Marín
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version 1.0
 */
class Autoload {

    /**
     *
     * registra las clases que se necesitarán en el proyecto
     *
     * @author Jhonatan Alexis Monsalve Marín <monsalvema87@hotmail.com>
     */
    static public function register() {
        $aClasses = Config::$classes;
        foreach ($aClasses as $sClass) {
            if (file_exists(APPLICATION_PATH . $sClass)) {
                require_once APPLICATION_PATH . $sClass;
            }
        }
    }
}