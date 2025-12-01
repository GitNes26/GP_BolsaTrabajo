<?php
// Evitar acceso directo al archivo
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  die('Acceso denegado');
}

$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
  $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
      [$key, $value] = explode('=', $line, 2);
      putenv(trim($key) . '=' . trim($value));
    }
  }
}
// Usar entorno para determinar configuración
$ENVIRONMENT = getenv('APP_ENV') ?? "local"; #/empleos
// echo "config: getenv('APP_ENV') .->".getenv('APP_ENV');

#region CONSTANTES DE CONFIGURACION
$CONFIG = [
  'local' => [
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_USER' => 'root',
    'DB_PWD'  => '',
    'DB_NAME' => 'bd_bolsa_trabajo',
    'DEBUG'   => true
  ],
  'production' => [
    'DB_HOST' => getenv('DB_HOST') ?: 'localhost',
    'DB_PORT' => getenv('DB_PORT') ?: '3306',
    'DB_USER' => getenv('DB_USER'),
    'DB_PWD'  => getenv('DB_PWD'),
    'DB_NAME' => getenv('DB_NAME'),
    'DEBUG'   => false
  ]
];

$CONN_DB = $CONFIG[$ENVIRONMENT];
$VERSION = getenv('APP_VERSION');
#endregion CONSTANTES DE CONFIGURACION

#region CONSTANTES RUTAS
$ROOT = realpath($_SERVER["DOCUMENT_ROOT"]);

$URL_BASE = $ENVIRONMENT == "production" ? "/empleos" : ""; #/empleos
$PROTOCOL = ($_SERVER["HTTPS"] ?? '') === "on" ? "https" : "http";
$URL_MAIN = "$PROTOCOL://$_SERVER[HTTP_HOST]$URL_BASE";
$URL_BASE = $URL_MAIN;

$ICONO = "$URL_BASE/favicon.ico";
// $ICONO = "$URL_BASE/assets/img/logo_gomez_palacio.png"; #"https://www.ayuntamientogp.imagendigitalstudio.com/img/logo.png";
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