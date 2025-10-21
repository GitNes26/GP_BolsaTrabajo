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


class Disability extends Connection
{

   function index()
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT * FROM disabilities WHERE active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Discapacidades encontradas";
         $response["alert_text"] = "Discapacidades encontradas";
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

         $query = "SELECT id value, disability text FROM disabilities WHERE active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Discapacidades encontradas";
         $response["alert_text"] = "Discapacidades encontradas";
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

         $query = "SELECT * FROM disabilities WHERE id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Discapacidad encontrada";
         $response["alert_text"] = "Discapacidad encontrada";
         $response["data"] = $result;
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($disability, $description, $created_at)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($disability, null);

         $query = "INSERT INTO disabilities(disability, description, created_at) VALUES(?,?,?)";
         $this->ExecuteQuery($query, array($disability, $description, $created_at));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Discapacidad registrada";
         $response["alert_text"] = "Discapacidad registrada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($disability, $description, $updated_at, $id)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($disability, $id);

         $query = "UPDATE disabilities SET disability=?, description=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($disability, $description, $updated_at, $id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Discapacidad actualizado";
         $response["alert_text"] = "Discapacidad actualizado";
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

         $query = "UPDATE disabilities SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Discapacidad eliminada";
         $response["alert_text"] = "Discapacidad eliminada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($disability, $id)
   {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('disabilities', 'disability', $disability, 'El área', 'input_disability', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}