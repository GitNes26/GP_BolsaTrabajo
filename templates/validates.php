<?php
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


// #VERIFICAR QUE NO SEA UN USUARIO TIPO CLIENTE
$role_id = 0; //$_COOKIE["role_id"];
// if ($role_id == 2) {
//   header("location:$URL_BASE/");
//   die();
// }


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
// if (isset($Role)) {
//    if ($Role == null) {
//       $role = "Admin";
//    }
// } else {
//    $role = "Admin";
// }

// if ($role_id == 1) $role = "SuperAdmin";
// else if ($role_id == 2) $role = "Admin";
// else if ($role_id == 3) $role = "Empresa";
// else if ($role_id == 4) $role = "User";
// else $role = "SuperAdmin";
// echo "perfil: $role_id - $role ";


// #VALIDAR QUE TENGA access A ESTA PAGINA
$URL_SERVER =  $_SERVER['REQUEST_URI'];
$url_ptr = explode("/", $URL_SERVER);
$path = end($url_ptr);
include_once ("../backend/Menu/Menu.php");
$menu = new Menu();
$menu_id = $menu->getIdForPath($path);
$id=0;
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
   $id = $menu_id['data'];
   // echo "id_menu: $id<br>";
   // $access = true;
   if ($_COOKIE["pages_read"] != "todas") {
      $access = explode(",", $_COOKIE["pages_read"]);
      // echo "access: ".print_r($access)."<br>";

      if (!in_array($id,$access)) $access = false;
      // echo "access: $access<br>";
   }
   if (!$access && $URL_SERVER != "$ADMIN_PATH/") {
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

$permission_write = $_COOKIE["pages_write"] == null ? false : true;
if ($_COOKIE["pages_write"] != "todas") {
   $access = explode(",", $_COOKIE["pages_write"]);
   if (!in_array($id,$access)) $permission_write = false;
}
$permission_delete = $_COOKIE["pages_delete"] == null ? false : true;
if ($_COOKIE["pages_delete"] != "todas") {
   $access = explode(",", $_COOKIE["pages_delete"]);
   if (!in_array($id,$access)) $permission_delete = false;
}
$permission_update = $_COOKIE["pages_update"] == null ? false : true;
if ($_COOKIE["pages_update"] != "todas") {
   $access = explode(",", $_COOKIE["pages_update"]);
   if (!in_array($id,$access)) $permission_update = false;
}


$tiempo_coockies = '+1 months';
setcookie("permission_read",$access,strtotime($tiempo_coockies), "/");
setcookie("permission_write",$permission_write,strtotime($tiempo_coockies), "/");
setcookie("permission_delete",$permission_delete,strtotime($tiempo_coockies), "/");
setcookie("permission_update",$permission_update,strtotime($tiempo_coockies), "/");


// $bg_powerbi = "navbar-white navbar-light";
// $cookie_dark_mode = $_COOKIE["tema_oscuro"];
// $dark_mode = $cookie_dark_mode == "1" ? "dark-mode" : "";

?>