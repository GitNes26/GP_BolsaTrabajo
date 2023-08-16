<?php
#region CONSTANTES DE CONFIGURACION
$CONN_DB_LOCAL = array(
  "HOST_NAME" => "127.0.0.1",
  "DB_PORT" => "3306",
  "DB_USER" => "root",
  "DB_PWD" => "",
  "DB_NAME" => "bd_bolsa_trabajo",
);
$CONN_DB_WEB = array(
  "HOST_NAME" => "132.148.76.141",
  "DB_PORT" => "3306",
  "DB_USER" => "usr_bolsatrabajo_gp",
  "DB_PWD" => "Sxm4r31~1",
  "DB_NAME" => "bd_bolsa_trabajo",
);
$CONN_DB = $CONN_DB_WEB;
#endregion CONSTANTES DE CONFIGURACION

#region CONSTANTES RUTAS
$ROOT = realpath($_SERVER["DOCUMENT_ROOT"]);

$URL_BASE = "/empleos";
// $PROTOCOL = $_SERVER["HTTPS"] == "on" ? "https" : "http";
$URL_MAIN = "http://$_SERVER[HTTP_HOST]$URL_BASE";
// $ICONO = "$URL_BASE/favicon.ico";
$ICONO = "$URL_BASE/assets/img/logo_gomez_palacio.png"; #"https://www.ayuntamientogp.imagendigitalstudio.com/img/logo.png";
// $LOGO = "$URL_BASE/logo.ico";
$LOGO = "$URL_BASE/assets/img/logo_gomez_palacio.png";
// $LOGO = "https://www.ayuntamientogp.imagendigitalstudio.com/img/logo.png";

$TEMPLATES_PATH = "$URL_BASE/templates";
$PAGES_PATH = "$URL_BASE/pages";
$SCRIPTS_PATH = "$URL_BASE/scripts";
$BACKEND_PATH = "$URL_BASE/backend";
$PLUGINS_PATH = "$URL_BASE/plugins";
$STYLES_PATH = "$URL_BASE/styles";
$ADMINLTE_PATH = "$URL_BASE/plugins/AdminLTE-3.2.0";
$ASSETS_PATH = "$URL_BASE/assets";
$IMG_PATH = "$ASSETS_PATH/img";
#endregion CONSTANTES RUTAS


// #region CONSTANTES DE CONFIGURACION
// define(HOST_NAME, "192.168.253.36\\compac");
// define(DB_PORT, "61256");
// define(DB_USER, "sa");
// define(DB_PWD, "COMPAC08");
// define(DB_ctPRES_CON, "ctPRES_CON");
// define(DB_ctPRES_SIN, "ctPRES_SIN");
// #endregion CONSTANTES DE CONFIGURACION

// #region CONSTANTES RUTAS
// define(URL_BASE, "/");
// define(PROTOCOL, $_SERVER["HTTPS"] == "on" ? "https" : "http");
// define(URL_MAIN, "$protocolo://$_SERVER[HTTP_HOST]$URL_BASE");
// define(ICONO, "$URL_BASE/favicon.ico");
// define(LOGO, "$URL_BASE/logo.ico");
// define(TEMPLATES_PATH, "$URL_BASE/Templates");
// define(PAGES_PATH, "$URL_BASE/Views");
// define(SCRIPTS_PATH, "$URL_BASE/Scripts");
// define(BACKEND_PATH, "$URL_BASE/Backend");
// #endregion CONSTANTES RUTAS