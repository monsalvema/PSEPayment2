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
    public function firstPage() {
        $oPse = new Pse();
        $oBanks = $oPse->getBankList();
        require_once($this->getView('default'));
    }

    private function getView($sViewName) {
        return Config::$urlViews . $sViewName . '/' . $sViewName . '.php';
    }
}