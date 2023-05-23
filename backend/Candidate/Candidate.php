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


class Candidate extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT c.* FROM companies c INNER JOIN users u ON c.user_id=u.id WHERE u.active=1;";
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
   
         $query = "SELECT c.id value, c.company text FROM companies c INNER JOIN users u ON c.user_id=u.id WHERE u.active=1;";
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
   
         $query = "SELECT c.* FROM companies c WHERE c.id=$id;";
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

   function create($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($company, null);

         $query = "INSERT INTO companies(company, description, logo_path, contact_name, contact_phone, contact_email, state, municipality, business_line_id, company_ranking_id, user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Candidato registrada";
         $response["alert_text"] = "Candidato registrada";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id, $updated_at) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($c.company, $id);

         $query = "UPDATE companies c INNER JOIN users u ON c.user_id=u.id SET u.c.company=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($c.company, $updated_at, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Candidato actualizado";
         $response["alert_text"] = "Candidato actualizado";
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

         $query = "UPDATE companies c INNER JOIN users u ON c.user_id=u.id SET u.active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Candidato eliminada";
         $response["alert_text"] = "Candidato eliminada";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($c.company, $id) {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('companies c INNER JOIN users u ON c.user_id=u.id', 'u.c.company', $c.company, 'El área', 'input_c.company', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}