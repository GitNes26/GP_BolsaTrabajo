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


class Company extends Connection
{

   function index()
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT * FROM vw_companies";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Empresas encontradas";
         $response["alert_text"] = "Empresas encontradas";
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

         $query = "SELECT c.id value, c.company text FROM companies c INNER JOIN users u ON c.user_id=u.id WHERE u.active=1;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
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

         $query = "SELECT * FROM vw_companies WHERE id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Empresa encontrada";
         $response["alert_text"] = "Empresa encontrada";
         $response["data"] = $result;
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($company, $description, $accept_inclusive, $logo_path, $contact_name, $contact_phone, $contact_email, $community_id, $state, $municipality, $business_line_id, $company_ranking_id, $user_id)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($company, null);

         #Creamos el registro en la tabla compañias
         $query = "INSERT INTO companies(company, description, accept_inclusive, logo_path, contact_name, contact_phone, contact_email, community_id, state, municipality, business_line_id, company_ranking_id, user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($company, $description, $accept_inclusive, $logo_path, $contact_name, $contact_phone, $contact_email, $community_id, $state, $municipality, $business_line_id, $company_ranking_id, $user_id));

         #Le asignamos el rol de compañia al usuario
         $query = "UPDATE users SET role_id=3 WHERE id=?";
         $this->ExecuteQuery($query, array($user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Empresa registrada";
         $response["alert_text"] = "Empresa registrada";
         $response["toast"] = false;
         $this->Close();

         include "../User/User.php";
         $User = new User();
         $User->setCookies($user_id);
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($company, $description, $accept_inclusive, $logo_path, $contact_name, $contact_phone, $contact_email, $community_id, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($company, $id);

         $query = "UPDATE companies SET company=?, description=?, accept_inclusive=?, logo_path=?, contact_name=?, contact_phone=?, contact_email=?, community_id=?, state=?, municipality=?, business_line_id=?, company_ranking_id=?, user_id=? WHERE id=?";
         $this->ExecuteQuery($query, array($company, $description, $accept_inclusive, $logo_path, $contact_name, $contact_phone, $contact_email, $community_id, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Empresa actualizada";
         $response["alert_text"] = "Empresa actualizada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }
   function editInfo($user_id, $company, $description, $accept_inclusive, $contact_name, $contact_phone, $contact_email, $community_id, $state, $municipality, $business_line_id, $company_ranking_id, $email, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->_getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $this->validateAvailableData($company, $id);

         $query = "UPDATE companies SET company=?, description=?, accept_inclusive=?, contact_name=?, contact_phone=?, contact_email=?, community_id=?, state=?, municipality=?, business_line_id=?, company_ranking_id=? WHERE id=?";
         $this->ExecuteQuery($query, array($company, $description, $accept_inclusive, $contact_name, $contact_phone, $contact_email, $community_id, $state, $municipality, $business_line_id, $company_ranking_id, $id));

         $query = "UPDATE users SET email=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($email, $updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Información actualizada";
         $response["alert_text"] = "Información actualizada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }
   function editLogo($user_id, $logo_path, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->_getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $query = "UPDATE companies SET logo_path=? WHERE id=?";
         $this->ExecuteQuery($query, array($logo_path, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Foto actualizada";
         $response["alert_text"] = "Foto actualizada";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function delete($deleted_at, $user_id)
   {
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
         $error_message = "Error: " . $e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($company, $id)
   {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('companies', 'company', $company, 'La compañia', 'input_company', $id, 'users');
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }

   function getIdByUserId($user_id)
   {
      $query = "SELECT id FROM companies WHERE user_id=$user_id;";
      $company = $this->Select($query, false);
      if (!$company) die(json_encode(array("data" => 0)));
      else die(json_encode(array("data" => $company["id"])));
   }



   private function _getIdByUserId($user_id)
   {
      $query = "SELECT id FROM companies WHERE user_id=$user_id;";
      $company = $this->Select($query, false);
      if (!$company) return 0;
      else return $company["id"];
   }
}