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


class Tag extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT * FROM tags WHERE active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function showSelect() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT id value, tag text FROM tags WHERE active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function show($id) {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT * FROM tags WHERE id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($tag, $created_at) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($tag, null);

         $query = "INSERT INTO tags(tag, created_at) VALUES(?,?)";
         $this->ExecuteQuery($query, array($tag, $created_at));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Etiqueta registrada";
         $response["alert_text"] = "Etiqueta registrada";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($tag, $id, $updated_at) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($tag, $id);

         $query = "UPDATE tags SET tag=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($tag, $updated_at, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Etiqueta actualizado";
         $response["alert_text"] = "Etiqueta actualizado";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function delete($deleted_at, $id) {
      try {
        $response = $this->defaultResponse();

         $query = "UPDATE tags SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Etiqueta eliminada";
         $response["alert_text"] = "Etiqueta eliminada";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($tag, $id) {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('tags', 'tag', $tag, 'La etiqueta', 'input_tag', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}