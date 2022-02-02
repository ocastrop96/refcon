<?php
class Conexion
{
    static public function conectar()
    {
        $link = new PDO(
            "mysql:host=localhost;dbname=db-mrms-web",
            "adm-mrms",
            'lWtnVVDlD*JuAxF^#zb'
        );
        $link->exec("set names utf8");
        return $link;
    }
}
