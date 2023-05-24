<?php
require_once "../config.php";
// echo "hola $TEMPLATES_PATH";
include "../templates/validates.php";
// include "$TEMPLATES_PATH/aside_configurations.php";

$Page = "Nominas";
$Single = "nomina";
$Plural = "nominas" 
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php include "../templates/styles.php"; ?>
  <title>Document</title>
</head>
<body>
  
</body>
</html>

<div class="content-wrapper" style="min-height: 1145.31px;">
  <?php include "../templates/aside_configurations.php";?>

  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Registros de Compaq <small>[ctPRES]</small></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
            <li class="breadcrumb-item active">Nomina Compaq</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container">

      <!-- formulario filtros -->
      <form id="form" class="card card-dark shadow mb-2">
        <input type="hidden" id="op" name="op" value="LoadInfo">
        <div class="card-header btn" data-card-widget="collapse">
          <h3 class="card-title fw-bold"><i class="fa-duotone fa-filters"></i>&nbsp; FILTROS PARA CONSULTA<small>
            </small></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button> -->
          </div>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-3 my-2">
              <label for="input_db" class="form-label" autofocus>Base de datos <span class="obligatory"></span></label>
              <select class="form-select" style="width:100%;" aria-label="Default select example" id="input_db" name="input_db" data-nombre-campo="Base de datos">
                <option value="ctPRES_CON">BD [ctPRES_CON]</option>
                <option value="ctPRES_SIN">BD [ctPRES_SIN]</option>
              </select>
              <!-- <div id="input_db_feedback" class="invalid-feedback">
                Selecciona una opción valida.
              </div> -->
            </div>
            <!-- <div class="col-md-3 my-2 my-auto pt-2">
              <button type="submit" id="btn_submit" class="btn btn-outline-dark fw-bolder"><i
                  class="fa-duotone fa-filters"></i>&nbsp; FILTRAR</button>
              <button type="reset" id="btn_reset" class="btn btn-outline-secondary fw-bold"><i
                  class="fa-regular fa-ban"></i>&nbsp; CANCELAR</button>
            </div> -->
            <!-- <div class="col-md-4 my-2">
              <label for="input_ejercicio" class="form-label">Ejercicio <span class="obligatory"></span></label>
              <select class="select2 form-select is-valid" style="width:100%" aria-label="Default select example"
                id="input_ejercicio" name="input_ejercicio" data-nombre-campo="Ejercicio">
                <option selected value="-1" disabled>Selecciona una opción...</option>
                <option>2023</option>
                <option>2022</option>
                <option>2021</option>
                <option>2020</option>
                <option>2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
                <option>2015</option>
              </select>
              <div id="input_ejercicio_feedback" class="valid-feedback">
                Looks good!
              </div>
            </div> -->
            <!-- <div class="col-md-4 my-2">
              <label for="validationServerUsername" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                <input type="text" class="form-control is-invalid" id="validationServerUsername"
                  aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                  Please choose a username.
                </div>
              </div>
            </div> -->

            <!-- <div class="col-12">
              <div class="form-check">
                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3"
                  aria-describedby="invalidCheck3Feedback">
                <label class="form-check-label" for="invalidCheck3">
                  Agree to terms and conditions
                </label>
                <div id="invalidCheck3Feedback" class="invalid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div> -->
          </div>
        </div>
        <!-- <div class="card-footer">
        </div> -->
      </form>
      <!-- /. formulario filtros -->

      <!-- card tabla-->
      <div class="card card-outline card-dark shadow">
        <div class="container-fluid mt-2 float-end">
          <!-- <button id="btn_abrir_modal" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-circle-plus"></i>&nbsp; ADD USER</button> -->
          <button type="button" id="btn_sync_info" class="btn btn-outline-dark fw-bold float-end">
            <i class="fa-duotone fa-rotate"></i>&nbsp; SINCRONIZAR INFORMACIÓN
          </button>
          <i class="float-end mx-2 my-auto">Se sincronizarán el total de registros de la tabla.</i>
        </div>
        <div class="card-body">
          <!-- tabla -->
          <div class="table-responsive">
            <table id="table_<?=$Plural?>" class="table table-hover text-center text-sm" style="width:100%">
              <thead class="thead-dark">
                <tr>
                  <th>Código Empleado</th>
                  <th>Nombre</th>
                  <th>A. Paterno</th>
                  <th>A. Materno</th>
                  <th>RFC</th>
                  <th>CURP</th>
                  <th>Fecha Alta</th>
                  <!-- <th>Acciones</th> -->
                </tr>
              </thead>
              <tbody id="tbody">
                <template id="row_template">
                  <tr>
                    <th class="td_ce">Código Empleado</th>
                    <td class="td_n">Nombre</td>
                    <td class="td_ap">A. Paterno</td>
                    <td class="td_am">A. Materno</td>
                    <th class="td_rfc">RFC</th>
                    <td class="td_curp">CURP</td>
                    <td class="td_fa">Fecha Alta</td>
                    <!-- <td>Acciones</td> -->
                  </tr>
                </template>
              </tbody>
              <tfoot>
                <tr class="thead-dark">
                  <th>Código Empleado</th>
                  <th>Nombre</th>
                  <th>A. Paterno</th>
                  <th>A. Materno</th>
                  <th>RFC</th>
                  <th>CURP</th>
                  <th>Fecha Alta</th>
                  <!-- <th>Acciones</th> -->
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card tabla -->
    </div>
  </div>

</div>

<!-- <?php include "./templates/footer.php" ?> -->


<!-- MIS SCRIPTS -->
<script src="index.js"></script>
</body>

</html>