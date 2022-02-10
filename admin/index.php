<?php
// Controladores
require_once "./app/controller/PlantillaControlador.php";
require_once "./app/controller/UsuariosControlador.php";
require_once "./app/controller/ReferenciasControlador.php";
// Modelos
require_once "./app/model/UsuariosModelo.php";
require_once "./app/model/ReferenciasModelo.php";

$template = new ControladorPlantilla();
$template->ctrPlantilla();
