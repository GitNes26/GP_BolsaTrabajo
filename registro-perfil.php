<?php
require_once "config.php";
if (isset($_COOKIE["session"])) {
   if ($_COOKIE["session"] != "active") {
      header("location:$URL_BASE/");
      die();
   }
   elseif (isset($_COOKIE["role_id"])) {
      if ($_COOKIE["role_id"] != "0") {
         header("location:$URL_BASE/");
         die();
      }
   }
} else {
   header("location:$URL_BASE/");
   die();
}

// $dark_mode = "";
// if (isset($_COOKIE["dpnstash_tema_oscuro"]))
//    $dark_mode = (bool)$_COOKIE["dpnstash_tema_oscuro"] ? "dark-mode" : "";

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
   <script src="<?=$PLUGINS_PATH?>/jquery.min.js"></script>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- AdminLTE-3 -->
   <link href="<?=$ADMINLTE_PATH ?>/css/adminlte.min.css" rel="stylesheet" />
   

   <!-- FontAwesome 6 -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/> -->
   <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">

   <!-- Moment JS -->
   <script src="<?=$PLUGINS_PATH?>/moment-js/moment.min.js"></script>

   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="<?=$PLUGINS_PATH?>/sweetAlert2/js/sweetalert2.all.min.js"/>

   <!-- Select2 -->
   <!-- <link href="<?=$PLUGINS_PATH?>/select2/css/select2.min.js" rel="stylesheet" /> -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <!-- SUMMERNOTE - EDITOR DE TEXTO -->
   <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">  -->
   <link rel="stylesheet" href="/plugins/summernote-0.8.18/summernote.min.css">


   <!-- MisEstilos -->
   <link rel="stylesheet" href="<?=$STYLES_PATH?>/responsive.css">
   <link rel="stylesheet" href="<?=$STYLES_PATH ?>/styles.css"/>

   <style>
      .select2-container--default .select2-selection--single .select2-selection__rendered {
         margin-top: -9px !important;
      }
   </style>

</head>

<!-- <body data-spy="scroll" data-target=".navbar" data-offset="90"
   class="particles_special_id green-version body-login <?=$dark_mode?>"> -->
<body 
   class="layout-top-nav layout-footer-fixed layout-navbar-fixed layout-fixed sidebar-mini-md sidebar-mini sidebar-mini-xs">
   <input type="hidden" id="url_base" value="<?=$URL_BASE?>">
   <!-- <input type="hidden" id="join_now" value="<?=$join_now?>"> -->

   <div class="wrapper">

      <nav class="main-header navbar navbar-expand-md navbar-success navbar-dark">
         <div class="container">
            <a href="/" class="navbar-brand">
               <img src="<?=$LOGO?>" alt="Imagen Logo" class="img-responsive"
                  style="opacity: .8; width:125px">
               <!-- <span class="brand-text font-weight-light">BT</span> -->
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
               aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">

               <ul class="navbar-nav">
                  <!-- <li class="nav-item">
                     <a href="<?= $URL_BASE ?>" class="nav-link">Iniciar Sesión</a>
                  </li> -->
                  <!-- <li class="nav-item">
                     <a href="/" class="nav-link">HomePage</a>
                  </li> -->
               </ul>

               <!-- Right navbar links -->
               <ul class="navbar-nav ml-auto">
                  <!-- Perfil -->
                  <li class='nav-item'>
                     <div class='user-panel d-flex'>
                        <div class='info'>
                           <span class='d-block text-decoration-none text-bold text-light'><i
                                 class=''><?= isset($_COOKIE["email"]) 
                                 ? $_COOKIE["email"] 
                                 : "<a class='nav-link' data-bs-toggle='modal' data-bs-target='#modal' style='cursor:pointer'>CERRAR SESIÓN</a>" ?></i></span>
                        </div>
                     </div>
                  </li>
                  <!-- Btn Logout -->
                  <?php if (isset($_COOKIE["user_id"])):
                  if ($_COOKIE["user_id"] > 0): ?>
                  <li class='nav-item ml-3'>
                     <a href='#' id="btn_logout" class='btn btn-outline-light btn_logout' title='Cerrar sesión'><i class="fas fa-door-closed"></i></a>
                  </li>
                  <?php endif; endif; ?>
               </ul>
            </div>
         </div>
      </nav>

      <div class="content-wrapper" style="min-height: 815px;">

         <div class="alert alert-info alert-dismissible rounded-0 d-flex justify-content-center">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
            <h5 class="fw-bold"><i class="icon fas fa-info"></i>&nbsp; Termina el registro con la información que complementará tu perfil.</h5>
            <!-- <p class="lead fw-bold"></p> -->
         </div>

         <div class="container">
            <!-- Card -->
            <form id="form_role" class="card rounded-3 card-outline card-success shadow" enctype="multipart/form-data" id="card_role">
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

                     <input type="hidden" id="op" name="op" value="create" class="not_validate">
                     <input type="hidden" id="user_id" name="user_id" value='' class="">
                     
                     <div id="div_company" class="">
                        <div class="row"> <!-- LOGO Y NOMBRE -->
                           <div class="col-3 rounded-lg text-center"> <!-- LOGO -->
                              <input type="file" id="input_logo_path" name="input_logo_path" class="d-none" accept="image/*">
                              <label for="input_logo_path">Logo
                                 <div id="preview_logo" class="d-flex justify-content-center">
                                    <img src="<?=$IMG_PATH?>/cargar_imagen.png" alt="Cargar Logo" class="img-fluid pointer p-3 rounded-lg" for="input_logo_path" title="Haz clic aquí para cargar tu logo de empresa">
                                 </div>
                              </label>

                           </div>
                           <div class="col"> <!-- NOMBRE Y ACERCA DE -->
                              <div class="mb-3 col">
                                 <label for="input_company" class="form-label">Nombre de Empresa: <span class="obligatory"></span></label>
                                 <input type="text" class="form-control" id="input_company" name="input_company" data-input-name="NOMBRES DE EMPRESA">
                              </div>
                              <div class="mb-3 col">
                                 <label for="input_description" class="form-label">Acerca de mí empresa: <span class="obligatory"></span></label>
                                 <textarea type="text" class="form-control counter" id="input_description" name="input_description" data-input-name="ACERCA DE" rows="4" data-limit="150" data-counter="counter_description"></textarea>
                                 <div class="text-sm text-end text-muted" id="counter_description"></div>
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
                              <span title="dar click aqui si no se cargan los datos." data-input="input_state" class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                              <select class="select2 form-control" style="width:100%; line-height:10px"
                              id="input_state" name="input_state"
                              data-input-name="ESTADO">
                              </select>
                           </div>
                           <div class="mb-3 col">
                              <label for="input_municipality" class="form-label">Municipio: <span class="obligatory"></span></label>
                              <span title="dar click aqui si no se cargan los datos." data-input="input_municipality" class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                              <select class="select2 form-control" style="width:100%; line-height:20px"
                              id="input_municipality" name="input_municipality"
                              data-input-name="MUNICIPIO" disabled>
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
                              <input type="text" class="form-control" id="input_contact_phone" name="input_contact_phone" data-input-name="TELÉFONO" maxlength="10">
                           </div>
                           <div class="mb-3 col">
                              <label for="input_contact_email" class="form-label">Correo: <span class="obligatory"></span></label>
                              <input type="email" class="form-control" id="input_contact_email" name="input_contact_email" data-input-name="CORREO">
                           </div>
                        </div>
                     </div>

                     <div id="div_candidate" class="">
                        <div class="row"><!-- NOMBRE Y APELLIDO -->
                           <div class="mb-3 col-md-6">
                              <label for="input_name" class="form-label">Nombre(s): <span class="obligatory"></span></label>
                              <input type="text" class="form-control not_validate" id="input_name" name="input_name" data-input-name="NOMBRES">
                           </div>
                           <div class="mb-3 col-md-6">
                              <label for="input_last_name" class="form-label">Apellido(s): <span class="obligatory"></span></label>
                              <input type="text" class="form-control not_validate" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
                           </div>
                        </div>
                        <div class="row"> <!-- CECULAR Y EDAD -->
                           <div class="mb-3 col-md-6">
                              <label for="input_cellphone" class="form-label">Celular: <span class="obligatory"></span></label>
                              <input type="text" class="form-control not_validate" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR" maxlength="10">
                           </div>
                           <div class="mb-3 col-md-6">
                              <label for="input_age" class="form-label">Edad: <span class="obligatory"></span></label>
                              <input type="number" class="form-control not_validate" id="input_age" name="input_age" data-input-name="CORREO">
                           </div>
                        </div>
                        <div class="row"> <!-- INTERESES -->
                           <div class="form-group">
                              <label for="input_interest_tags_ids">Intereses de búsqueda:</label>
                              <select class="select2 select2-hidden-accessible not_validate" multiple="" data-placeholder="Selecciona etiquetas relacionadas a tús intereses" style="width: 100%;" tabindex="-1" aria-hidden="true" id="input_interest_tags_ids" name="input_interest_tags_ids" data-input-name="INTERESES">
                              </select>
                           </div>
                        </div>

                        <div class="border rounded mt-2 p-2"> <!-- DATOS PROFESIONALES -->
                           <div for="" class="text-center fw-bolder mb-3">DATOS PROFESIONALES</div>
                           <div class="mb-3 col">
                              <label for="input_profession_id" class="form-label">Profesión/Oficio: <span class="obligatory"></span></label>
                              <select class="select2 form-control not_validate" style="width:100%"
                              id="input_profession_id" name="input_profession_id" data-input-name="PROFESIÓN">
                              </select>
                           </div>
                           <!-- ACERCA DE MÍ -->
                           <!-- <div class="row">
                              <div class="mb-3 col">
                                 <label for="input_about_me" class="form-label">Acerca de mí: <span class="obligatory"></span></label>
                                 <textarea type="text" class="form-control" id="input_about_me" name="input_about_me" data-input-name="ACERCA DE" rows="4" data-limit="150"></textarea>
                                 <div class="text-sm text-end text-muted" id="counter_description">0/150</div>
                              </div>
                           </div> -->
                           <!-- COMPETENCIAS Y HABILIDADES -->
                           <!-- <div class="row">
                              <div class="mb-3 col-md-6">
                                 <label for="">Competencias:</label>
                                 <ul class="list-group" id="list_skills">
                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="skill_li
                                    ">
                                       <input type="text" class="border-only-bottom not_validate" id="input_skill_" value="Competencia 1">
                                       <div class="">
                                          <span class="badge bg-success rounded-pill pointer btn_skill_ok" data-id="" title="Aceptar"><i class="fa-solid fa-check"></i></span>
                                          <span class="badge bg-primary rounded-pill pointer btn_skill_edit" data-id="" title="Editar"><i class="fa-solid fa-pen"></i></span>
                                          <span class="badge bg-danger rounded-pill pointer btn_skill_delete" data-id="" title="Eliminar"><i class="fa-solid fa-xmark"></i></span>
                                       </div>
                                    </li>
                                 </ul>
                                 <div class="d-grid gap-2">
                                    <button class="btn btn-outline-dark" type="button" id="btn_add_skill"><i class="fa-regular fa-circle-plus"></i>&nbsp; Agregar</button>
                                 </div>
                              </div>
                              <div class="mb-3 col-md-6">
                                 <label for="">Habilidades:</label>
                                 <ul class="list-group" id="list_abilities">
                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="ability_li
                                    ">
                                       <input type="text" class="border-only-bottom not_validate" id="input_ability_" value="Competencia 1">
                                       <div class="">
                                          <span class="badge bg-success rounded-pill pointer btn_ability_ok" data-id="" title="Aceptar"><i class="fa-solid fa-check"></i></span>
                                          <span class="badge bg-primary rounded-pill pointer btn_ability_edit" data-id="" title="Editar"><i class="fa-solid fa-pen"></i></span>
                                          <span class="badge bg-danger rounded-pill pointer btn_ability_delete" data-id="" title="Eliminar"><i class="fa-solid fa-xmark"></i></span>
                                       </div>
                                    </li>
                                 </ul>
                                 <div class="d-grid gap-2">
                                    <button class="btn btn-outline-dark" type="button" id><i class="fa-regular fa-circle-plus"></i>&nbsp; Agregar</button>
                                 </div>
                              </div>
                           </div> -->
                           <!-- INFORMACION PROFESIONAL -->
                           <div class="mb-3">
                                 <label for="input_professional_info" class="form-label">Más información: &nbsp;<i class="fa-duotone fa-circle-info" title="Escribir Habilidades, competencias, experiencias, observaciones, etc."></i></label>
                                 <div class="summernote"></div>
                              </div>
                           <div class="row"> <!-- LENGUAJE Y CV-->
                              <div class="mb-3 col-md-6">
                                 <label for="input_languages">Domínio del inglés: <span class="obligatory"></span></label>
                                 <div class="btn-group ml-3" role="group">
                                    <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_b" autocomplete="off" value="Inglés - Básico" checked>
                                    <label class="btn btn-outline-dark rounded-left" for="input_languages_b">Básico</label>

                                    <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_i" autocomplete="off" value="Inglés - Intermedio">
                                    <label class="btn btn-outline-dark" for="input_languages_i" >Intermedio</label>

                                    <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_a" autocomplete="off" value="Inglés - Avanzado">
                                    <label class="btn btn-outline-dark" for="input_languages_a" >Avanzado</label>
                                 </div>
                              </div>
                              <div class="mb-3 col-md-6">
                                 <label for="input_cv_path" class="form-label">Cargar CV: <span class="obligatory"></span></label>
                                 <input type="file" class="form-control not_validate" accept=".pdf" id="input_cv_path" name="input_cv_path" data-input-name="CURRICULUM VITAE">
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <div class="card-footer">
                  <button type="submit" id="btn_done"
                     class="btn btn-outline-success btn-block fw-bold text-center">
                     <i class="fa-solid fa-circle-check"></i>&nbsp;&nbsp;TERMINAR
                  </button>
                  <button type="reset" id="btn_reset"
                     class="btn btn-outline-secondary btn-block fw-bold text-center">
                     <i class="fa-solid fa-ban"></i>&nbsp;&nbsp;LIMPIAR
                  </button>
                  <!-- <button type="button" id="btn_return" class="btn btn-outline-secondary btn-block fw-bold text-center" onclick="history.back()">
                     <i class="fa-solid fa-circle-arrow-left"></i>&nbsp;&nbsp;REGRESAR
                  </button> -->
               </div>
               <!-- /.login-card-body -->
            </form>
            <!-- /.Card -->
         </div>

      </div>


   </div>

   <!-- setting -->
   <!-- <script src="Assets/js/main.js"></script> -->


   <!-- SCRIPTS -->
   <!-- JQuery 6 -->
   <script src="<?=$PLUGINS_PATH?>/jquery.min.js"></script>

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="<?=$PLUGINS_PATH?>/bootstrap-5.2.3/js/bootstrap.bundle.min.js"></script>

   <!-- AdminLTE-3 -->
   <script src="<?=$ADMINLTE_PATH ?>/js/adminlte.min.js"></script>

   <!-- SweetAlert2 -->
   <script src="<?=$PLUGINS_PATH?>/sweetAlert2/js/sweetalert2.all.min.js"></script>

   <!-- Select2 -->
   <!-- <script src="<?=$PLUGINS_PATH?>/select2/js/select2.min.js"></script> -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <!-- Block-UI -->
   <script src="<?=$PLUGINS_PATH ?>/BlockUI/jquery.blockui.min.js"></script>

   <!-- Cookies -->
   <script src="<?=$PLUGINS_PATH?>/js-cookie/js.cookie.min.js"></script>

   <!-- SUMMERNOTE - EDITOR DE TEXTO -->
   <script src="/plugins/summernote-0.8.18/summernote.min.js"></script>
   <script src="/plugins/summernote-0.8.18/summernote-bs4.min.js"></script>
   <script src="/plugins/summernote-0.8.18/lang/summernote-es-ES.min.js"></script>


   <script src="<?=$SCRIPTS_PATH ?>/master.js"></script>
   <script src="<?=$SCRIPTS_PATH ?>/registro-perfil.js"></script>
</body>

</html>