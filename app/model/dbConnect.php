<?php
class Conexion
{
    static public function conectar()
    {
        $link = new PDO(
            "mysql:host=localhost;dbname=db-refcon",
            "adm-refcon",
            '4gn&Ar@5@Yg&eamYs#k5'
        );
        $link->exec("set names utf8");
        return $link;
    }
}
