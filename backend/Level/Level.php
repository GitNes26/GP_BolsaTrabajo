<?php
if (file_exists("../backend/Connection.php")) {
   require_once("../backend/Connection.php");
} else {
   if (file_exists("./backend/Connection.php")) {
      require_once("./backend/Connection.php");
   } else if (file_exists("../backend/Connection.php")) {
      require_once("../backend/Connection.php");
   } else if (file_exists("../../backend/Connection.php")) {
      require_once("../../backend/Connection.php");
   }
}


class Level extends Connection
{

   function index()
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT * FROM levels WHERE active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Niveles de Estudio encontradas";
         $response["alert_text"] = "Niveles de Estudio encontradas";
         $response["data"] = $result;
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function showSelect()
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT id value, level text FROM levels WHERE active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Niveles de Estudio encontradas";
         $response["alert_text"] = "Niveles de Estudio encontradas";
         $response["data"] = $result;
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function show($id)
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT * FROM levels WHERE id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Nivel de Estudio encontrada";
         $response["alert_text"] = "Nivel de Estudio encontrada";
         $response["data"] = $result;
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($level, $created_at)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($level, null);

         $query = "INSERT INTO levels(level, created_at) VALUES(?,?)";
         $this->ExecuteQuery($query, array($level, $created_at));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Nivel de Estudio registrada";
         $response["alert_text"] = "Nivel de Estudio registrada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($level, $updated_at, $id)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($level, $id);

         $query = "UPDATE levels SET level=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($level, $updated_at, $id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Nivel de Estudio actualizado";
         $response["alert_text"] = "Nivel de Estudio actualizado";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function delete($deleted_at, $id)
   {
      try {
         $response = $this->defaultResponse();

         $query = "UPDATE levels SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Nivel de Estudio eliminada";
         $response["alert_text"] = "Nivel de Estudio eliminada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($level, $id)
   {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('levels', 'level', $level, 'El área', 'input_level', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}