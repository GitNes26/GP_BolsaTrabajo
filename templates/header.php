<?php
include "../templates/validates.php"
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Bootstrap 5.3 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- AdminLTE 3.2 -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css"> -->
  <link rel="stylesheet" href="<?=$ADMINLTE_PATH?>/css/adminlte.min.css">

  <!-- Dataables => DataTables | DataTables | AutoFill - FixedHeader - Buttons - Responsive - Scroller -->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/dt-1.11.3/af-2.3.7/fh-3.2.3/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/r-2.2.9/sc-2.0.5/datatables.min.css" />
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css"> -->
  <!-- <script src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"> -->
  <!-- <script src="<?=$PLUGINS_PATH?>/DataTables/dataTables.fixedHeader.min.js"></script> -->

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    referrerpolicy="no-referrer" />
  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <!-- Moment JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" referrerpolicy="no-referrer">
  </script>
  <!-- Moment JS en español -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/es.js"></script>


  <!---------------------------- OPCIONES EXTRAS ---------------------------->
  <!-- IMask JS -->
  <script src="https://unpkg.com/imask"></script>

  <!-- bs-stepper- formularios en pasos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

  <!-- Mis Estilos -->
  <link rel="stylesheet" href="<?=$STYLES_PATH?>/styles.css">
  <link rel="stylesheet" href="<?=$STYLES_PATH?>/responsive.css">

  <title>Bolsa de Trabajo</title>
</head>

<body class="layout-top-nav layout-navbar-fixed layout-footer-fixed text-sm" style="height: auto;">
  <input type="hidden" id="url_base" value="<?=$URL_BASE?>">
  <div class="wrapper">
