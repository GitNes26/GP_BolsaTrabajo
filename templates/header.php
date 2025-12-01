<?php
// Evitar acceso directo al archivo
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  die('Acceso denegado');
}
include "../templates/validates.php";
$URL_BASE = $ENVIRONMENT === "production" ? "/empleos" : ""; #/empleos

$classBody = "hold-transition sidebar-mini layout-fixed ";
if ($URL_SERVER == "$URL_BASE/pages") $classBody = "layout-top-nav ";
elseif ($URL_SERVER == "$URL_BASE/pages/") $classBody = "layout-top-nav ";
elseif ($URL_SERVER == "$URL_BASE/pages/index.php") $classBody = "layout-top-nav ";

if (strpos($classBody, 'layout-top-nav') !== 0) $classBody .= "layout-navbar-fixed ";
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- TipoGrafia -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

   <!-- JQuery 6 -->
   <script src="<?= $PLUGINS_PATH ?>/jquery.min.js"></script>

   <!-- Bootstrap 5.3 -->
   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- AdminLTE 3.2 -->
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css"> -->
   <link rel="stylesheet" href="<?= $ADMINLTE_PATH ?>/css/adminlte.min.css">

   <!-- Dataables => DataTables | DataTables | AutoFill - FixedHeader - Buttons - Responsive - Scroller -->
   <link rel="stylesheet" type="text/css" href="<?= $PLUGINS_PATH ?>/dataTables/css/datatables.min.css" />
   <!-- <script src="<?= $PLUGINS_PATH ?>/DataTables/dataTables.fixedHeader.min.js"></script> -->

   <!-- Select2 -->
   <!-- <link href="<?= $PLUGINS_PATH ?>/select2/css/select2.min.css" rel="stylesheet" /> -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <!-- FontAwesome 6 -->
   <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">

   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="<?= $PLUGINS_PATH ?>/sweetAlert2/css/sweetalert2.min.css" />
   <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> -->

   <!-- Ion-RangeSlider -->
   <!-- <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" /> -->
   <link rel="stylesheet" href="<?= $PLUGINS_PATH ?>/ion-rangeslider/css/ion.rangeSlider.min.css">
   <!-- BootstrapSlider -->
   <!-- <link rel="stylesheet" href="<?= $PLUGINS_PATH ?>/bootstrap-slider/css/bootstrap-slider.min.css"> -->



   <!-- Moment JS -->
   <script src="<?= $PLUGINS_PATH ?>/moment-js/moment.min.js"></script>
   <!-- Moment JS en español -->
   <script type="text/javascript" src="<?= $PLUGINS_PATH ?>/moment-js/es.js"></script>


   <!---------------------------- OPCIONES EXTRAS ---------------------------->
   <!-- IMask JS -->
   <script src="<?= $PLUGINS_PATH ?>/imask-js/imask.js"></script>

   <!-- SUMMERNOTE - EDITOR DE TEXTO -->
   <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">  -->
   <link rel="stylesheet" href="<?= $PLUGINS_PATH ?>/summernote-0.8.18/summernote.min.css">

   <!-- slick-carousel 1.8.1 -->
   <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->

   <!-- SwiperJS - Carrusel -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

   <!-- bs-stepper- formularios en pasos -->
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css"> -->

   <!-- Mis Estilos -->
   <link rel="stylesheet" href="<?= $STYLES_PATH ?>/styles.css">
   <link rel="stylesheet" href="<?= $STYLES_PATH ?>/responsive.css">

   <title>Bolsa de Trabajo</title>
   <link href="<?= $ICONO ?>" rel="shortcut icon" type="image/x-icon" />
</head>


<body class="<?= $classBody ?>  text-sm" style="height: auto;">
   <input type="hidden" id="url_base" value="<?= strpos($_SERVER["HTTP_HOST"], ".test") ? "" : $URL_BASE ?>">
   <div class="wrapper">