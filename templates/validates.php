<?php
include_once "../config.php";


// VERIFICAR SESION ACTIVA
// if (isset($_COOKIE["sesion"])) {
//    if ($_COOKIE["sesion"] != "activa") {
//       header("location:$URL_BASE");
//       die();
//    }
// } else {
//    header("location:$URL_BASE");
//    die();
// }


// VERIFICAR QUE NO SEA UN USUARIO TIPO CLIENTE
$role_id = 0; //$_COOKIE["role_id"];
// if ($role_id == 2) {
//   header("location:$URL_BASE");
//   die();
// }


// VERIFICAR QUE SU MENSUALIDAD ESTE PAGADA
// if ($role_id == 3 || $role_id == 4) {
//    include("../Backend/Usuario/Usuario.php");
//    $ValidarPagoUsuario = new Usuario();
//    $pago_vencido = $ValidarPagoUsuario->validarSuscripcionPagada($_COOKIE["id_usuario"])["pago_vencido"];
//    echo $pago_vencido;
//    // $pago_vencido = 1;
//    if ($pago_vencido) die(header("location:$SUBSCRIBE_PAGE"));
// }

$role = "Admin";
if (isset($Role)) {
   if ($Role == null) {
      $role = "Admin";
   }
} else {
   $role = "Admin";
}

if ($role_id == 0) $role = "SuperAdmin";
else if ($role_id == 1) $role = "Admin";
else if ($role_id == 2) $role = "Trabajador";
else if ($role_id == 3) $role = "Usuario";
else $role = "SuperAdmin";
// echo "perfil: $role_id - $role ";


// VALIDAR QUE TENGA ACCESOS A ESTA PAGINA
$URL_SERVER =  $_SERVER['REQUEST_URI'];
$url_ptr = explode("/", $URL_SERVER);
$path = end($url_ptr);
// include ('../Backend/Menu/Menu.php');
// $menu = new Menu();
// $respuesta = $menu->getIdForPath($path);
// $id=0;
// $acceso = true;
// if ($path != "perfil.php") {
//    if (!$respuesta['result']) {
//       header("location:$URL_BASE");
//       die();
//    }
//    $id = $respuesta['data'];
//    // echo "id_menu: $id<br>";
//    // $acceso = true;
//    if ($_COOKIE["permisos_lectura"] != "todos") {
//       $accesos = explode(",", $_COOKIE["permisos_lectura"]);
//       // echo "accesos: ".print_r($accesos)."<br>";

//       if (!in_array($id,$accesos)) $acceso = false;
//       // echo "acceso: $acceso<br>";
//    }
//    if (!$acceso && $URL_SERVER != "$ADMIN_PATH/") {
//       // echo "ESTOY SIN ACCESO... CREO";
//       header("location:$URL_BASE");
//       die();
//    }
// }


// MOSTRAR EL REPORTE DEFAULT EN CASO DE QUE SE VAYA A LA VENTANA DE CUSTOMERS
$reporte_id_default = 0;

// CONOCER PERMISOS
// if (!isset($_COOKIE["permisos_lectura"])) {
//    include("../Backend/Usuario/Usuario.php");
//    $PermisosUsuario = new Usuario();
//    $PermisosUsuario->establecerCookies($_COOKIE["id_usuario"]);
// }

// $permiso_altas = $_COOKIE["permisos_altas"] == null ? false : true;
// if ($_COOKIE["permisos_altas"] != "todos") {
//    $accesos = explode(",", $_COOKIE["permisos_altas"]);
//    if (!in_array($id,$accesos)) $permiso_altas = false;
// }
// $permiso_bajas = $_COOKIE["permisos_bajas"] == null ? false : true;
// if ($_COOKIE["permisos_bajas"] != "todos") {
//    $accesos = explode(",", $_COOKIE["permisos_bajas"]);
//    if (!in_array($id,$accesos)) $permiso_bajas = false;
// }
// $permiso_cambios = $_COOKIE["permisos_cambios"] == null ? false : true;
// if ($_COOKIE["permisos_cambios"] != "todos") {
//    $accesos = explode(",", $_COOKIE["permisos_cambios"]);
//    if (!in_array($id,$accesos)) $permiso_cambios = false;
// }
// $permiso_especiales = $_COOKIE["permisos_especiales"] == null ? false : true;
// if ($_COOKIE["permisos_especiales"] != "todos") {
//    $accesos = explode(",", $_COOKIE["permisos_especiales"]);
//    if (!in_array($id,$accesos)) $permiso_especiales = false;
// }

$tiempo_coockies = '+30 minutes';
// setcookie("permiso_lectura",$acceso,strtotime($tiempo_coockies), "/");
// setcookie("permiso_altas",$permiso_altas,strtotime($tiempo_coockies), "/");
// setcookie("permiso_bajas",$permiso_bajas,strtotime($tiempo_coockies), "/");
// setcookie("permiso_cambios",$permiso_cambios,strtotime($tiempo_coockies), "/");
// setcookie("permiso_especiales",$permiso_especiales,strtotime($tiempo_coockies), "/");


// $bg_powerbi = "navbar-white navbar-light";
// $cookie_dark_mode = $_COOKIE["tema_oscuro"];
// $dark_mode = $cookie_dark_mode == "1" ? "dark-mode" : "";

?>