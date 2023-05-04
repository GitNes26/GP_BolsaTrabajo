<?php
if (file_exists("../Configurations/globals.php")) {
   include("../Configurations/globals.php");
} else {
   if (file_exists("./Configurations/globals.php")) {
      include("./Configurations/globals.php");
   } else if (file_exists("../Configurations/globals.php")) {
      include("../Configurations/globals.php");
   } else if (file_exists("../../Configurations/globals.php")) {
      include("../../Configurations/globals.php");
   }
}


// VERIFICAR SESION ACTIVA
if (isset($_COOKIE["dpnstash_sesion"])) {
   if ($_COOKIE["dpnstash_sesion"] != "activa") {
      header("location:$URL_BASE");
      die();
   }
} else {
   header("location:$URL_BASE");
   die();
}
// VERIFICAR QUE NO SEA UN USUARIO TIPO CLIENTE
$perfil_id = $_COOKIE["dpnstash_perfil_id"];
if ($perfil_id == 2) {
  header("location:$URL_BASE");
  die();
}

// VERIFICAR QUE SU MENSUALIDAD ESTE PAGADA
if ($perfil_id == 3 || $perfil_id == 4) {
   include("../Backend/Usuario/Usuario.php");
   $ValidarPagoUsuario = new Usuario();
   $pago_vencido = $ValidarPagoUsuario->validarSuscripcionPagada($_COOKIE["dpnstash_id_usuario"])["pago_vencido"];
   echo $pago_vencido;
   // $pago_vencido = 1;
   if ($pago_vencido) die(header("location:$SUBSCRIBE_PAGE"));
}


if (isset($Perfil)) {
   if ($Perfil == null) {
      $perfil= "Admin";
   }
} else {
   $perfil= "Admin";
}

if ($perfil_id == 0) $perfil = "RESO Support";
else if ($perfil_id == 1) $perfil = "Admin";
else if ($perfil_id == 2) $perfil = "Customer";
else if ($perfil_id == 3) $perfil = "Consultant";
else if ($perfil_id == 4) $perfil = "Subscriber";
else if ($perfil_id == 5) $perfil = "Employee";
// echo "perfil: $perfil_id - $perfil";


// VALIDAR QUE TENGA ACCESOS A ESTA PAGINA
if (isset($_COOKIE["dpnstash_reporte_id_default"])) {
   if ($_COOKIE["dpnstash_reporte_id_default"] != "") {
     $reporte_id_default = $_COOKIE["dpnstash_reporte_id_default"];
   }
}

$URL_SERVER =  $_SERVER['REQUEST_URI'];
$url_ptr = explode("/", $URL_SERVER);
$path = end($url_ptr);
include ('../Backend/Menu/Menu.php');
$menu = new Menu();
$respuesta = $menu->obtenerIdPorPath($path);
$id=0;
$acceso = true;
if ($path != "profile.php") {
   if (!$respuesta['Resultado']) {
      header("location:$URL_BASE");
      die();
   }
   $id = $respuesta['Datos'];
   // ECHO "id_menu: $id<br>";
   // $acceso = true;
   if ($_COOKIE["dpnstash_permisos_lectura"] != "todos") {
      $accesos = explode(",", $_COOKIE["dpnstash_permisos_lectura"]);
      // ECHO "accesos: ".print_r($accesos)."<br>";

      if (!in_array($id,$accesos)) $acceso = false;
      // ECHO "acceso: $acceso<br>";
   }
   if (!$acceso && $URL_SERVER != "$ADMIN_PATH/") {
      // echo "ESTOY SIN ACCESO... CREO";
      header("location:$URL_BASE");
      die();
   }
}


// MOSTRAR EL REPORTE DEFAULT EN CASO DE QUE SE VAYA A LA VENTANA DE CUSTOMERS
$reporte_id_default = 0;

// CONOCER PERMISOS
if (!isset($_COOKIE["dpnstash_permisos_lectura"])) {
   include("../Backend/Usuario/Usuario.php");
   $PermisosUsuario = new Usuario();
   $PermisosUsuario->establecerCookies($_COOKIE["dpnstash_id_usuario"]);
}

$permiso_altas = $_COOKIE["dpnstash_permisos_altas"] == null ? false : true;
if ($_COOKIE["dpnstash_permisos_altas"] != "todos") {
   $accesos = explode(",", $_COOKIE["dpnstash_permisos_altas"]);
   if (!in_array($id,$accesos)) $permiso_altas = false;
}
$permiso_bajas = $_COOKIE["dpnstash_permisos_bajas"] == null ? false : true;
if ($_COOKIE["dpnstash_permisos_bajas"] != "todos") {
   $accesos = explode(",", $_COOKIE["dpnstash_permisos_bajas"]);
   if (!in_array($id,$accesos)) $permiso_bajas = false;
}
$permiso_cambios = $_COOKIE["dpnstash_permisos_cambios"] == null ? false : true;
if ($_COOKIE["dpnstash_permisos_cambios"] != "todos") {
   $accesos = explode(",", $_COOKIE["dpnstash_permisos_cambios"]);
   if (!in_array($id,$accesos)) $permiso_cambios = false;
}
$permiso_especiales = $_COOKIE["dpnstash_permisos_especiales"] == null ? false : true;
if ($_COOKIE["dpnstash_permisos_especiales"] != "todos") {
   $accesos = explode(",", $_COOKIE["dpnstash_permisos_especiales"]);
   if (!in_array($id,$accesos)) $permiso_especiales = false;
}

$tiempo_coockies = '+30 minutes';
setcookie("dpnstash_permiso_lectura",$acceso,strtotime($tiempo_coockies), "/");
setcookie("dpnstash_permiso_altas",$permiso_altas,strtotime($tiempo_coockies), "/");
setcookie("dpnstash_permiso_bajas",$permiso_bajas,strtotime($tiempo_coockies), "/");
setcookie("dpnstash_permiso_cambios",$permiso_cambios,strtotime($tiempo_coockies), "/");
setcookie("dpnstash_permiso_especiales",$permiso_especiales,strtotime($tiempo_coockies), "/");


$bg_powerbi = "navbar-white navbar-light";
$cookie_dark_mode = $_COOKIE["dpnstash_tema_oscuro"];
$dark_mode = $cookie_dark_mode == "1" ? "dark-mode" : "";
?>