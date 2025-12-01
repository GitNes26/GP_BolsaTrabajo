<?php
// Evitar acceso directo al archivo
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
   die('Acceso denegado');
}
include_once "../config.php";


// #VERIFICAR SESION ACTIVA
if (isset($_COOKIE["session"])) {
   if ($_COOKIE["session"] != "active") {
      header("location:$URL_BASE/");
      die();
   }
} else {
   header("location:$URL_BASE/");
   die();
}



// #VERIFICAR QUE SU MENSUALIDAD ESTE PAGADA
// if ($role_id == 3 || $role_id == 4) {
//    include("../Backend/User/User.php");
//    $ValidarPagoUser = new User();
//    $pago_vencido = $ValidarPagoUser->validarSuscripcionPagada($_COOKIE["user_id"])["pago_vencido"];
//    echo $pago_vencido;
//    // $pago_vencido = 1;
//    if ($pago_vencido) die(header("location:$SUBSCRIBE_PAGE"));
// }

$role = $_COOKIE["role"];


// #VALIDAR QUE TENGA access A ESTA PAGINA
$URL_SERVER =  $_SERVER['REQUEST_URI'];
$url_ptr = explode("/", $URL_SERVER);
$path = end($url_ptr);
include_once("../backend/Menu/Menu.php");
$menu = new Menu();
$menu_id = $menu->getIdForPath($path);
$id = 0;
$access = true;
// echo "todo bien hasta aqui";
if ($_COOKIE["role_id"] == "0") {
   header("location:$URL_BASE/registro-perfil.php");
}
if ($path != "perfil.php") {
   if (!$menu_id['result']) {
      header("location:$URL_BASE/");
      die();
   }
   // echo "el menu = ".print_r($menu_id['data']);
   if ($menu_id['data']) $id = $menu_id['data']['id'];
   else $id = $menu_id['data'];
   // echo "id_menu: $id<br>";
   // // $access = true;
   if ($_COOKIE["pages_read"] != "todas") {
      $access_to = explode(",", $_COOKIE["pages_read"]);
      // echo "=access: ".print_r($access)."<br>";

      if (!in_array($id, $access_to)) $access = false;
      // echo "access: ".print_r($access)."<br>";
      // echo "URL_SERVER: $URL_SERVER)<br>";
      // echo "ADMIN_PATH: ".print_r($ADMIN_PATH)."<br>";
   }
   $URL_BASE = $ENVIRONMENT == "production" ? "/empleos" : ""; #/empleos
   if (!$access) {
      if ($URL_SERVER == "$URL_BASE/pages") return;
      elseif ($URL_SERVER == "$URL_BASE/pages/") return;
      elseif ($URL_SERVER == "$URL_BASE/pages/index.php") return;
      elseif ($URL_SERVER == "$URL_BASE/perfil.php") return;
      // echo "ESTOY SIN access... CREO";
      header("location:$URL_BASE/");
      die();
   }
}


// #CONOCER PERMISOS
if (!isset($_COOKIE["pages_read"])) {
   include("../Backend/User/User.php");
   $UserPermissions = new User();
   $UserPermissions->setCookies($_COOKIE["user_id"]);
}

$permission_read = $_COOKIE["pages_read"] == null ? false : true;
if ($_COOKIE["pages_read"] != "todas") {
   $access_to = explode(",", $_COOKIE["pages_read"]);
   if (!in_array($id, $access_to)) $permission_read = false;
}
$permission_write = $_COOKIE["pages_write"] == null ? false : true;
if ($_COOKIE["pages_write"] != "todas") {
   $access_to = explode(",", $_COOKIE["pages_write"]);
   if (!in_array($id, $access_to)) $permission_write = false;
}
$permission_update = $_COOKIE["pages_update"] == null ? false : true;
if ($_COOKIE["pages_update"] != "todas") {
   $access_to = explode(",", $_COOKIE["pages_update"]);
   if (!in_array($id, $access_to)) $permission_update = false;
   // echo "la pagina: ".print_r($id)." -- accesos:".print_r($access);
}
$permission_delete = $_COOKIE["pages_delete"] == null ? false : true;
if ($_COOKIE["pages_delete"] != "todas") {
   $access_to = explode(",", $_COOKIE["pages_delete"]);
   if (!in_array($id, $access_to)) $permission_delete = false;
}


$cookies_time = '+1 months';
setcookie("permission_read", $permission_read, strtotime($cookies_time), "/");
setcookie("permission_write", $permission_write, strtotime($cookies_time), "/");
setcookie("permission_delete", $permission_delete, strtotime($cookies_time), "/");
setcookie("permission_update", $permission_update, strtotime($cookies_time), "/");


#Esta validacion es para cuando le dan "atras" y la pagina se sigue viendo
echo "
<!-- Cookies -->
<script src='$PLUGINS_PATH/js-cookie/js.cookie.min.js'></script>
<script>
   const validateNeedCookies = () => {
      let needCookies = true;
      if (location.pathname == '/') needCookies = false;
      else if (location.pathname == '/index.php') needCookies = false;
      else if (location.pathname == '/registro-perfil.php') needCookies = false;
      
      if (!Cookies.get('session') && needCookies) location.reload();
   };
   validateNeedCookies();
</script>
";

// $bg_powerbi = "navbar-white navbar-light";
// $cookie_dark_mode = $_COOKIE["tema_oscuro"];
// $dark_mode = $cookie_dark_mode == "1" ? "dark-mode" : "";