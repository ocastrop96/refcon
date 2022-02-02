<?php
require_once "../../../app/controller/LicenciasControlador.php";
require_once "../../../app/model/LicenciasModelo.php";

class ajaxDiagnosticos
{
  public $dato1;
  public function ajaxListarDxs()
  {
    $datob = $this->dato1;
    $datosDx = LicenciasControlador::ctrTraerDatosDxs($datob);
    $totalDataDx = count($datosDx);
    if ($totalDataDx > 0) {
      $data = "";
      foreach ($datosDx as $key => $value) {
        $data .= "<div class='card card-olive'>
                <div class='card-header'>
                  <h3 class='card-title font-weight-bold'>CIE 10 | " . $value["CodigoCIE10"] . "</h3>
                </div>
                <div class='card-body'>
                  <div class='row'>
                    <div class='col-12 col-sm-2 col-md-2 col-lg-2'><strong>
                        <i class='fas fa-book mr-1'></i> Descripción</strong>
                    </div>
                    <div class='col-12 col-sm-9 col-md-9 col-lg-9'>
                      <p class='text-olive font-weight-bold'>$value[Descripcion]</p>
                    </div>
                  </div>
                  <div class='row'>
                  <div class='col-12 col-sm-12 col-md-12 col-lg-12'>
                  <button type='button' class='btn btn-info btn-block border-5' id='btnCargaDx' onclick='cargaDatosDx($value[IdDiagnostico])'><i class='fas fa-sync-alt'></i> &nbsp; Cargar Diagnóstico</button>
                  </div>
                  </div>
                </div>
              </div>";
      }
      $data .= "";
    } else {
      $data = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h5 class='font-weight-bold'><i class='icon fas fa-exclamation-triangle'></i> ¡Datos no encontrados!</h5>
                No se encontró Dx con el Cie o Descripción ingresada.
            </div>";
    }
    echo $data;
  }

  public $dato3;
  public function ajaxListarDxs2()
  {
    $datob = $this->dato3;
    $datosDx = LicenciasControlador::ctrTraerDatosDxs($datob);
    $totalDataDx = count($datosDx);
    if ($totalDataDx > 0) {
      $data = "";
      foreach ($datosDx as $key => $value) {
        $data .= "<div class='card card-olive'>
                <div class='card-header'>
                  <h3 class='card-title font-weight-bold'>CIE 10 | " . $value["CodigoCIE10"] . "</h3>
                </div>
                <div class='card-body'>
                  <div class='row'>
                    <div class='col-12 col-sm-2 col-md-2 col-lg-2'><strong>
                        <i class='fas fa-book mr-1'></i> Descripción</strong>
                    </div>
                    <div class='col-12 col-sm-9 col-md-9 col-lg-9'>
                      <p class='text-olive font-weight-bold'>$value[Descripcion]</p>
                    </div>
                  </div>
                  <div class='row'>
                  <div class='col-12 col-sm-12 col-md-12 col-lg-12'>
                  <button type='button' class='btn btn-info btn-block border-5' id='btnCargaDx2' onclick='cargaDatosDx2($value[IdDiagnostico])'><i class='fas fa-sync-alt'></i> &nbsp; Cargar Diagnóstico</button>
                  </div>
                  </div>
                </div>
              </div>";
      }
      $data .= "";
    } else {
      $data = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h5 class='font-weight-bold'><i class='icon fas fa-exclamation-triangle'></i> ¡Datos no encontrados!</h5>
                No se encontró Dx con el Cie o Descripción ingresada.
            </div>";
    }
    echo $data;
  }
  public $dato2;
  public function ajaxListarDatosDx()
  {
    $datob2 = $this->dato2;
    $datosLDx = LicenciasControlador::ctrListarDx($datob2);
    echo json_encode($datosLDx);
  }
}

if (isset($_POST["dato1"])) {
  $list1 = new ajaxDiagnosticos();
  $list1->dato1 = $_POST["dato1"];
  $list1->ajaxListarDxs();
}

if (isset($_POST["dato3"])) {
  $list3 = new ajaxDiagnosticos();
  $list3->dato3 = $_POST["dato3"];
  $list3->ajaxListarDxs2();
}

if (isset($_POST["dato2"])) {
  $list2 = new ajaxDiagnosticos();
  $list2->dato2 = $_POST["dato2"];
  $list2->ajaxListarDatosDx();
}
