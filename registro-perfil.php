<?php
require_once "config.php";
if (isset($_COOKIE["session"])) {
   if ($_COOKIE["session"] == "active") {
      // if ($_COOKIE["profile_id"] == 2)
         // die(header("location:$CUSTOMER_PATH"));
      die(header("location:$PAGES_PATH"));
   }
}
// $join_now = '0';
// if (isset($_GET["join_now"])) {
//   $join_now = $_GET["join_now"];
// }

// $dark_mode = "";
// if (isset($_COOKIE["dpnstash_tema_oscuro"]))
//    $dark_mode = (bool)$_COOKIE["dpnstash_tema_oscuro"] ? "dark-mode" : "";

$e=null;
$p=null;
if (isset($_GET["e"])) {
   $e = $_GET["e"];
}
if (isset($_GET["p"])) {
   $p = $_GET["p"];
}
// echo "la e: $e";
?>


<!doctype html>
<html class="no-js" lang="es">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
   <meta name="author" content="Theme Industry">
   <!-- description -->
   <meta name="description" content="">
   <!-- keywords -->
   <meta name="keywords" content="">
   <!-- title -->
   <title>Bolsa de trabajo GP | Login</title>
   <link href="<?=$ICONO ?>" rel="shortcut icon" type="image/x-icon" />


   <!-- bundle css -->
   <!-- <link rel="stylesheet" href="Assets/css/packed.css" /> -->
   <!-- style -->
   <!-- <link rel="stylesheet" href="Assets/css/style.css" /> -->

   <!-- Tipo de letra -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- JQuery 6 -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <!-- AdminLTE-3 -->
   <link href="<?=$ADMINLTE_PATH ?>/css/adminlte.min.css" rel="stylesheet" />

   <!-- FontAwesome 6 -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">

   <!-- Moment JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
      integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
      integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- Select2 -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <!-- MisEstilos -->
   <link rel="stylesheet" href="<?=$STYLES_PATH ?>/styles.css"/>
   <link rel="stylesheet" href="<?=$STYLES_PATH?>/responsive.css">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="90"
   class="particles_special_id green-version body-login <?=$dark_mode?>">
   <input type="hidden" id="url_base" value="<?=$URL_BASE?>">
   <!-- <input type="hidden" id="join_now" value="<?=$join_now?>"> -->

   <!-- start slider -->
   <section class="fadeIn example no-padding no-transition" id="home">
      <article class="content">
         <h2 class="display-none no-padding no-margin" aria-hidden="true"></h2>
         <div id="rev_slider_1078_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
            data-alias="classic4export" data-source="gallery"
            style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <!-- start revolution slider 5.4.1 fullwidth mode -->
            <div id="rev_slider_1078_1" class="rev_slider fullwidthabanner hold-transition login-page"
               style="background-image: url(); background-size:cover;" data-version="5.4.1">
               <canvas id="particles_bg"
                  style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 1; overflow:hidden;"></canvas>
               <div class="opacity-extra-medium bg-black position-absolute z-index-1"></div>

               <div class="container  justify-content-center overflow-auto py-3" style="z-index:1">



                  <!-- Card Login -->
                  <form id="form_role" class="card rounded-3 card-outline card-primary shadow" id="card_role" data-slide-down="1">
                     <div class="card-body login-card-body">
                        <div class="text-center mb-4">
                           <label class="form-control">Soy: &nbsp;&nbsp;&nbsp;&nbsp;
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="input_role" id="input_role_company" value="Empresa" checked>
                                 <label class="form-check-label" for="input_role_company">Empresa</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="input_role" id="input_role_candidate" value="Candidato">
                                 <label class="form-check-label" for="input_role_candidate">Candidato</label>
                              </div>
                           </label>
                        </div>

                           <input type="hidden" id="op" name="op" value="" class="not_validate">
                           <input type="hidden" id="id" name="id" value='' class="">
                           
                           <div id="div_company" class="d-none">
                              <div class="row"> <!-- LOGO Y NOMBRE -->
                                 <div class="col-3"> <!-- LOGO -->
                                    <img src="https://thumbs.dreamstime.com/z/plantilla-del-dise%C3%B1o-logotipo-vector-concepto-edificio-para-la-construcci%C3%B3n-126177482.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="col"> <!-- NOMBRE Y ACERCA DE -->
                                    <div class="mb-3 col">
                                       <label for="input_company" class="form-label">Nombre de Empresa: <span class="obligatory"></span></label>
                                       <input type="text" class="form-control" id="input_company" name="input_company" data-input-name="NOMBRES DE EMPRESA">
                                    </div>
                                    <div class="mb-3 col">
                                       <label for="input_description" class="form-label">Acerca de mí empresa: <span class="obligatory"></span></label>
                                       <textarea type="text" class="form-control" id="input_description" name="input_description" data-input-name="ACERCA DE" rows="4" max-length="150"></textarea>
                                       <div class="text-sm text-end text-muted" id="counter_description">0/150</div>
                                    </div>
                                 </div>
                              </div>

                              <div class="row"> <!-- GIRO Y CLASIFICACION -->
                                 <div class="mb-3 col">
                                    <label for="input_business_line_id" class="form-label">Giro: <span class="obligatory"></span></label>
                                    <select class="select2 form-control" style="width:100%"
                                    id="input_business_line_id" name="input_business_line_id" data-input-name="GIRO">
                                    </select>
                                 </div>
                                 <div class="mb-3 col">
                                    <label for="input_company_ranking_id" class="form-label">Clasificacón: <span class="obligatory"></span></label>
                                    <select class="select2 form-control" style="width:100%"
                                    id="input_company_ranking_id" name="input_company_ranking_id" data-input-name="ACERCA DE">
                                    </select>
                                 </div>
                              </div>
                              <div class="row border rounded mb-3"> <!-- UBICACION -->
                                 <label class="text-center">UBICACIÓN</label>
                                 <div class="mb-3 col">
                                    <label for="input_state" class="form-label">Estado: <span class="obligatory"></span></label>
                                    <select class="select2 form-control" style="width:100%; line-height:10px"
                                    id="input_state" name="input_state"
                                    data-input-name="ESTADO">
                                    </select>
                                 </div>
                                 <div class="mb-3 col">
                                    <label for="input_municipality" class="form-label">Municipio: <span class="obligatory"></span></label>
                                    <select class="select2 form-control" style="width:100%; line-height:20px"
                                    id="input_municipality" name="input_municipality"
                                    data-input-name="MUNICIPIO">
                                    </select>
                                 </div>
                              </div>
                              <div class="row border rounded"> <!-- CONTACTO -->
                                 <label class="text-center">CONTACTO</label>
                                 <div class="mb-3 col">
                                    <label for="input_contact_name" class="form-label">Nombre: <span class="obligatory"></span></label>
                                    <input type="text" class="form-control" id="input_contact_name" name="input_contact_name" data-input-name="NOMBRE DE CONTACTO">
                                 </div>
                                 <div class="mb-3 col">
                                    <label for="input_contact_phone" class="form-label">Teléfono: <span class="obligatory"></span></label>
                                    <input type="text" class="form-control" id="input_contact_phone" name="input_contact_phone" data-input-name="TELÉFONO">
                                 </div>
                                 <div class="mb-3 col">
                                    <label for="input_contact_email" class="form-label">Correo: <span class="obligatory"></span></label>
                                    <input type="email" class="form-control" id="input_contact_email" name="input_contact_email" data-input-name="CORREO">
                                 </div>
                              </div>
                           </div>

                           <div id="div_candidate" class="">
                              <div class="row">
                                 <div class="mb-3 col-md-4">
                                    <label for="input_name" class="form-label">Nombre(s): <span class="obligatory"></span></label>
                                    <input type="text" class="form-control" readonly id="input_name" name="input_name" data-input-name="NOMBRES">
                                 </div>
                                 <div class="mb-3 col-md-4">
                                    <label for="input_last_name" class="form-label">Apellido(s): <span class="obligatory"></span></label>
                                    <input type="text" class="form-control" readonly id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
                                 </div>
                                 <div class="mb-3 col-md-4">
                                    <label for="input_email" class="form-label">Correo: <span class="obligatory"></span></label>
                                    <input type="email" class="form-control" readonly id="input_email" name="input_email" data-input-name="APELLIDOS">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="mb-3 col-md-6">
                                    <label for="input_cellphone" class="form-label">Celular: <span class="obligatory"></span></label>
                                    <input type="text" class="form-control" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label for="input_age" class="form-label">Edad: <span class="obligatory"></span></label>
                                    <input type="number" class="form-control" id="input_age" name="input_age" data-input-name="CORREO">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group" data-select2-id="29">
                                    <label for="input_interest_tags_ids">Intereses de busqueda:</label>
                                    <select class="select2 select2-hidden-accessible not_validate" multiple="" data-placeholder="Selecciona etiquetas relacionadas a tu empresa" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true" id="input_interest_tags_ids" name="input_interest_tags_ids" data-input-name="ETIQUETAS">
                                       <option data-select2-id="35">Alabama</option>
                                       <option data-select2-id="36">Alaska</option>
                                       <option data-select2-id="37">California</option>
                                       <option data-select2-id="38">Delaware</option>
                                       <option data-select2-id="39">Tennessee</option>
                                       <option data-select2-id="40">Texas</option>
                                       <option data-select2-id="41">Washington</option>
                                       <option data-select2-id="41">Washington</option>
                                       <option data-select2-id="41">Washington</option>
                                       <option data-select2-id="41">Washington</option>
                                       <option data-select2-id="41">Washington</option>
                                    </select>
                                 </div>
                              </div>

                              <div class="border rounded mt-3 p-2">
                                 <div for="" class="text-center fw-bolder mb-3">DATOS PROFESIONALES</div>
                                 <div class="row">
                                    <div class="mb-3 col">
                                       <label for="input_description" class="form-label">Acerca de mí empresa: <span class="obligatory"></span></label>
                                       <textarea type="text" class="form-control" id="input_description" name="input_description" data-input-name="ACERCA DE" rows="4" data-limit="150"></textarea>
                                       <div class="text-sm text-end text-muted" id="counter_description">0/150</div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <ul class="list-group">
                                          <li class="list-group-item d-flex justify-content-between align-items-center">
                                             A list item
                                             <span class="badge bg-primary rounded-pill">14</span>
                                          </li>
                                          <li class="list-group-item d-flex justify-content-between align-items-center">
                                             A second list item
                                             <span class="badge bg-primary rounded-pill">2</span>
                                          </li>
                                          <li class="list-group-item d-flex justify-content-between align-items-center">
                                             A third list item
                                             <span class="badge bg-primary rounded-pill">1</span>
                                          </li>
                                       </ul>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                 </div>
                              </div>
                           </div>
                     </div>
                     <div class="card-footer">
                        <button type="submit" id="btn_done"
                           class="btn btn-outline-primary btn-block fw-bold text-center">
                           <i class="fa-solid fa-circle-check"></i>&nbsp;&nbsp;TERMINAR
                        </button>
                        <button type="submit" id="btn_return"
                           class="btn btn-outline-secondary btn-block fw-bold text-center" onclick="history.back()">
                           <i class="fa-solid fa-circle-arrow-left"></i>&nbsp;&nbsp;REGRESAR
                        </button>
                     </div>
                     <!-- /.login-card-body -->
                  </form>


                  <!-- /.Registro-box -->
               </div>

            </div>
         </div>
         <!-- end revolution slider -->
      </article>
      <!-- end slider -->
   </section>
   <!-- end slider -->



   <!-- setting -->
   <!-- <script src="Assets/js/main.js"></script> -->


   <!-- SCRIPTS -->
   <!-- JQuery 6 -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>

   <!-- AdminLTE-3 -->
   <script src="<?=$ADMINLTE_PATH ?>/js/adminlte.min.js"></script>

   <!-- SweetAlert2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

   <!-- Select2 -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <!-- Block-UI -->
   <script src="<?=$VENDORS_PATH ?>/BlockUI/jquery.blockui.min.js"></script>

   <!-- Cookies -->
   <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

   <script src="<?=$SCRIPTS_PATH ?>/master.js"></script>
   <script src="<?=$SCRIPTS_PATH ?>/registro-perfil.js"></script>
</body>

</html>