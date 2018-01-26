<?php


class controller
{
    public function home() {
        $oPse = new Pse();
        $oBanks = $oPse->getBankList();
        require_once("application/views/default/default.php");
    }
}