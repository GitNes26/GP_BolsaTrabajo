<?php
require_once "config.php";
// if (isset($_COOKIE["session"])) {
//    if ($_COOKIE["session"] == "active") {
//       if ($_COOKIE["profile_id"] == 2)
//          die(header("location:$CUSTOMER_PATH"));
//       die(header("location:$ADMIN_PATH"));
//    }
// }
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

               <div class="container-fluid d-flex justify-content-center overflow-auto py-3" style="z-index:1">
                  <div class="login-box">
                     <div class="login-logo">
                        <!-- <span class="fw-bold h1">RESO</span>
                          <span class="fw-light h1">Sistemas</span> -->
                        <div class="login-logo">
                           <img src="<?=$LOGO ?>" alt='GP Logo' class='img-fluid' />
                        </div>
                     </div>
                     <!-- /.login-logo -->

                     <!-- Card Login -->
                     <div class="card rounded-3 card-outline card-primary shadow" id="card_login" data-slide-down="1">
                        <div class="card-body login-card-body">
                           <p class="login-box-msg text-sm fst-italic">Ingresa tus credenciales para inicar sesión</p>

                           <form id="form_login">
                              <input type="hidden" id="op" name="op" value="login">
                              <div class="form-floating mb-3">
                                 <input type="email" class="form-control rounded-lg" id='email' name='email'
                                    placeholder="Correo Electronico" autofocus="autofocus" data-input-name="Correo" value="<?=$e?>"/>
                                 <label for="email">Correo Electrónico</label>
                              </div>
                              <div class="form-floating mb-3">
                                 <input type="password" class="form-control" id='password' name='password'
                                    placeholder="Contraseña" autocomplete="off" data-input-name="CONTRASEÑA" value="<?=$p?>"/>
                                 <label for="password">Contraseña</label>
                                 <i class="fa-duotone fa-eye-slash eye_icon" data-input="password"></i>
                              </div>
                              <div class="row">
                                 <div class="col">
                                    <button type="submit" id="btn_login"
                                       class="btn btn-outline-primary btn-block fw-bold text-center">
                                       <i class="fa-solid fa-circle-arrow-right"></i>&nbsp;&nbsp;INICIAR SESIÓN
                                    </button>
                                    <br>
                                    <a class="float-start" id="btn_signup" style="cursor:pointer">REGISTRARME!</a>
                                    <!-- <a href="/" class="float-end">Regresar a gomezpalacio.gom.mx</a> -->
                                 </div>
                                 <!-- /.col -->
                              </div>
                           </form>
                        </div>
                        <!-- /.login-card-body -->
                     </div>

                     <!-- Card Regitro -->
                     <div class="card rounded-3 card-outline card-primary shadow" id="card_register">
                        <div class="card-body login-card-body">
                           <p class="login-box-msg text-sm fst-italic">Favor de llenar todos los campos.</p>

                           <form id="form_register">
                              <div class="form-floating mb-3">
                                 <input type="text" class="form-control rounded-lg" id='input_name'
                                    name='input_name' placeholder="Nombres" autofocus="autofocus"
                                    data-input-name="NOMBRES" />
                                 <label for="input_name">Nombre(s)</label>
                              </div>
                              <div class="form-floating mb-3">
                                 <input type="text" class="form-control rounded-lg" id='input_last_name'
                                    name='input_last_name' placeholder="Apellidos" autofocus="autofocus"
                                    data-input-name="APELLIDOS" />
                                 <label for="input_last_name">Apellido(s)</label>
                              </div>
                              <div class="form-floating mb-3">
                                 <input type="email" class="form-control rounded-lg" id='input_email'
                                    name='input_email' placeholder="Correo Electrónico" autofocus="autofocus"
                                    data-input-name="CORREO" />
                                 <label for="input_email">Correo Electrónico</label>
                              </div>
                              <div class="form-floating mb-3">
                                 <input type="password" class="form-control" id='input_password'
                                    name='input_password' placeholder="Contraseña" autocomplete="off"
                                    data-input-name="CONTRASEÑA" />
                                 <label for="input_password">Contraseña</label>
                                 <i class="fa-duotone fa-eye-slash eye_icon" tittle="show text"
                                    data-input="input_password"></i>

                              </div>
                              <div class="form-floating mb-3">
                                 <input type="password" class="form-control" id='input_confirm_password'
                                    name='input_confirm_password' placeholder="Confirm Password" autocomplete="off"
                                    data-input-name="CONFIRMAR CONTRASEÑA" />
                                 <label for="input_confirm_password">Confirmar Contraseña</label>
                                 <span class="fst-italic" id="feedback_confirm_password"></span>
                                 <i class="fa-duotone fa-eye-slash eye_icon" tittle="show text"
                                    data-input="input_confirm_password"></i>
                              </div>
                              
                              <div class="row">
                                 <div class="col">
                                    <button type="submit" id="btn_register"
                                       class="btn btn-outline-primary btn-block fw-bold text-center">
                                       <i class="fa-solid fa-circle-arrow-up"></i>&nbsp;&nbsp;REGISTRARME
                                    </button>
                                    <br>
                                    <a class="float-start" id="btn_signin" style="cursor:pointer">Ya tengo cuenta</a>
                                    <!-- <a href="/" class="float-end">Return to main page</a> -->
                                 </div>
                                 <!-- /.col -->
                              </div>
                           </form>
                        </div>
                        <!-- /.Registro-card-body -->
                     </div>
                  </div>
                  <!-- /.Registro-box -->

                  <!-- <footer class="footer-login mt-5 text-light">
                      <p><b>Presidencia de GP</b> | 2023</p>
                  </footer> -->
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

   <!-- Block-UI -->
   <script src="<?=$VENDORS_PATH ?>/BlockUI/jquery.blockui.min.js"></script>

   <!-- Cookies -->
   <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

   <script src="<?=$SCRIPTS_PATH ?>/master.js"></script>
   <script src="<?=$SCRIPTS_PATH ?>/login.js"></script>
</body>

</html>