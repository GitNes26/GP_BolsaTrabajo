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


class Company extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT c.*, bl.business_line, cr.company_ranking, cr.description cr_description, u.email, u.created_at
         FROM companies c 
         INNER JOIN users u ON c.user_id=u.id 
         INNER JOIN business_lines bl ON c.business_line_id=bl.id
         INNER JOIN company_rankings cr ON c.company_ranking_id=cr.id
         WHERE u.active=1 ORDER BY c.id DESC;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Empresas encontradas";
         $response["alert_text"] = "Empresas encontradas";
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
   
         $query = "SELECT c.*, bl.business_line, cr.company_ranking, cr.description cr_description
         FROM companies c 
         INNER JOIN users u ON c.user_id=u.id 
         INNER JOIN business_lines bl ON c.business_line_id=bl.id
         INNER JOIN company_rankings cr ON c.company_ranking_id=cr.id
         WHERE c.id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Empresa encontrada";
         $response["alert_text"] = "Empresa encontrada";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($company, $description, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($company, null);

         #Creamos el registro en la tabla compañias
         $query = "INSERT INTO companies(company, description, contact_name, contact_phone, contact_email, state, municipality, business_line_id, company_ranking_id, user_id) VALUES(?,?,?,?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($company, $description, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id));

         #Le asignamos el rol de compañia al usuario
         $query = "UPDATE users SET role_id=3 WHERE id=?";
         $this->ExecuteQuery($query, array($user_id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Empresa registrada";
         $response["alert_text"] = "Empresa registrada";
         $this->Close();

         include "../User/User.php";
         $User = new User();
         $User->setCookies($user_id);
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($company, $description, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id, $updated_at) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($company, $id);

         $query = "UPDATE companies SET company=?, description=?, contact_name=?, contact_phone=?, contact_email=?, state=?, municipality=?, business_line_id=?, company_ranking_id=?, user_id=? WHERE id=?";
         $this->ExecuteQuery($query, array($company, $description, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Empresa actualizada";
         $response["alert_text"] = "Empresa actualizada";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function delete($deleted_at, $user_id) {
      try {
        $response = $this->defaultResponse();

         $query = "UPDATE users SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $user_id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Empresa eliminada";
         $response["alert_text"] = "Empresa eliminada";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($company, $id) {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('companies', 'company', $company, 'La compañia', 'input_company', $id, 'users');
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}