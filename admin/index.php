<?php
// Controladores
require_once "./app/controller/PlantillaControlador.php";
require_once "./app/controller/UsuariosControlador.php";
require_once "./app/controller/ReferenciasControlador.php";


require_once "./app/controller/CargosControlador.php";
require_once "./app/controller/LicenciasControlador.php";
require_once "./app/controller/ReportesControlador.php";
require_once "./app/controller/SOcupControlador.php";


// Modelos
require_once "./app/model/UsuariosModelo.php";
require_once "./app/model/ReferenciasModelo.php";



require_once "./app/model/CargosModelo.php";
require_once "./app/model/LicenciasModelo.php";
require_once "./app/model/ReportesModelo.php";
require_once "./app/model/SOcupModelo.php";


$template = new ControladorPlantilla();
$template->ctrPlantilla();
