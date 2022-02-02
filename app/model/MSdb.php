<?php
class ConexionConsulta
{
    static public function conectar()
    {
        $link = new PDO(
            'sqlsrv:Server=KILLASISA;Database=SIGH',
            'consulta',
            'consulta'
            // 'sqlsrv:Server=VISION;Database=SIGH',
            // 'sa',
            // 'Sistemas2021+-+'
        );
        $link->exec("set names utf8");
        return $link;
    }
}
