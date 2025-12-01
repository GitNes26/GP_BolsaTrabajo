<?php
// Evitar acceso directo al archivo

use function PHPSTORM_META\type;

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	die('Acceso denegado');
}
class Connection
{
	private $conn;
	// private $database;
	function __construct()
	{
		$ROOT = realpath($_SERVER["DOCUMENT_ROOT"]);
		// Usar entorno para determinar configuración
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
		$ENVIRONMENT = getenv('APP_ENV') ?? 'local';

		$URL_BASE = $ENVIRONMENT == "production" ? "/empleos" : ""; #/empleos

		include "$ROOT$URL_BASE/config.php";
		$CONN_OBJ = $CONN_DB;
		$this->conn = null;

		$connString = "mysql:host=$CONN_OBJ[DB_HOST];dbname=$CONN_OBJ[DB_NAME];charset=utf8mb4";
		// $connString = "sqlsrv:Server=$CONN_OBJ[DB_HOST];Database=$CONN_OBJ[DB_NAME];";
		$options = [
			PDO::ATTR_EMULATE_PREPARES   => false,
			PDO::ATTR_EMULATE_PREPARES => true,
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		];
		$this->conn = new PDO($connString, $CONN_OBJ["DB_USER"], $CONN_OBJ["DB_PWD"], $options);
		// $this->conn = new PDO($connString, $CONN_OBJ["DB_USER"], $CONN_OBJ["DB_PWD"], $options);
	}


	/*
    $query --> (string) consutla 
    $array --> (bool) true= si desea esperar más de un registro como respuesta || false = si solo espera un resultado (un objeto)
  */
	function Select($query, $array = true)
	{
		try {
			$sth = $this->conn->prepare($query);
			$sth->execute();
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			if ($array) $result = $sth->fetchAll();
			else $result = $sth->fetch();
			// $this->conn = null;
			return $result;
		} catch (PDOException $e) {
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
		}
	}


	function ExecuteQuery($query, $parametros)
	{
		try {
			$sth = $this->conn->prepare($query);
			$sth->execute($parametros);
			// $this->conn = null;
		} catch (PDOException $e) {
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
			return $e->getMessage();
		}
	}
	function GetInsertedId()
	{
		try {
			return $this->conn->lastInsertId();
		} catch (PDOException $e) {
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
			return $e->getMessage();
		}
	}

	function Procedure($query)
	{
		try {
			$res = $this->conn->prepare($query);
			$res->execute();
			$array = array();
			while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
				$array[] = $row;
			}
			return $array;
		} catch (\Exception $e) {
			error_log($e);
		}
	}

	function defaultResponse()
	{
		$response = array(
			"result" => null,
			"message" => "mensaje para mostrar en consola, solo informativo",
			"toast" => true,
			"alert_icon" => 'warning',
			"alert_title" => 'Oh oh',
			"alert_text" => 'No se encontraron registros.',
			// "alert_text" => 'No registers found.',
			"data" => [],
		);
		return $response;
	}
	function correctResponse()
	{
		$response = array(
			"result" => true,
			"message" => "mensaje para mostrar en consola, solo informativo",
			"toast" => true,
			"alert_icon" => 'success',
			"alert_title" => 'Exito',
			"alert_text" => 'Registros cargados.',
			// "alert_text" => 'No registers found.',
			"data" => [],
		);
		return $response;
	}
	function catchResponse($error_message)
	{
		error_log($error_message, "./error_log.log");
		$response = array(
			"result" => false,
			"message" => "Peticion fallida | $error_message",
			"toast" => false,
			"alert_icon" => 'error',
			"alert_title" => 'Opps...!',
			"alert_text" => "Ha ocurrido un error, verifica tus datos.\n $error_message",
			// "alert_text" => "An error has occurred, please verify your info.\n $error_message",
			"data" => [],
		);
		return $response;
	}

	function checkAvailableData($table, $column, $value, $propTitle, $input, $id, $secondTable = null)
	{

		if ($secondTable) {
			$query = "SELECT count(*) as duplicate FROM $table INNER JOIN $secondTable ON user_id=users.id WHERE $column='$value' AND active=1;";
			if ($id != null) $query = "SELECT count(*) as duplicate FROM $table t INNER JOIN $secondTable ON t.user_id=users.id WHERE t.$column='$value' AND active=1 AND t.id!=$id";
		} else {
			$query = "SELECT count(*) as duplicate FROM $table WHERE $column='$value' AND active=1";


			if ($id != null) $query = "SELECT count(*) as duplicate FROM $table WHERE $column='$value' AND active=1 AND id!=$id";
		}

		$consulta = $this->Select($query, false);
		if ($consulta["duplicate"] > 0) {
			$response = array(
				"result" => true,
				"alert_icon" => 'warning',
				"alert_title" => "$propTitle no esta disponible!",
				"alert_text" => "<b>$value</b> ya existe, intenta con uno diferente.",
				"message" => "duplicado",
				"input" => $input
			);
			// $response = $this->duplicateResponse($propTitle, $value, $input);
		} else {
			$response = array(
				"result" => false,
			);
		}
		return $response;
	}


	function Close()
	{
		$this->conn = null;
	}
}
