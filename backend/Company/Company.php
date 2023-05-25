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

         // $this->validateAvailableData($company, null);

         #Creamos el registro en la tabla compañias
         $query = "INSERT INTO companies(company, description, logo_path, contact_name, contact_phone, contact_email, state, municipality, business_line_id, company_ranking_id, user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id));

         #Le asignamos el rol de compañia al usuario
         $query = "UPDATE users SET role_id=3 WHERE id=?";
         $this->ExecuteQuery($query, array($user_id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Empresa registrada";
         $response["alert_text"] = "Empresa registrada";
         $this->Close();

         $this->setCookies($user_id);
   
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

         $this->validateAvailableData($company, $id);

         $query = "UPDATE companies SET company=?, description=?, logo_path=?, contact_name=?, contact_phone=?, contact_email=?, state=?, municipality=?, business_line_id=?, company_ranking_id=?, user_id=? WHERE id=?";
         $this->ExecuteQuery($query, array($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Empresa actualizado";
         $response["alert_text"] = "Empresa actualizado";
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
      $duplicate = $this->checkAvailableData('companies', 'company', $company, 'La compañia', 'input_company', $id);
      
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }


   function setCookies($id) {
      try {
         $query = "SELECT u.id, u.name, u.email, u.password, u.role_id
         FROM users as u WHERE u.id=$id";

         $user_found = $this->Select($query,false);

         if (sizeof($user_found) > 0) {
            $cookie_time = '+1 months';
            // if ($user_found["role_id"] == 1)
            //   $cookie_time = '+1 day';

            setcookie("user_id",$user_found["id"], strtotime($cookie_time), "/");
            setcookie("name",$user_found["name"], strtotime($cookie_time), "/");
            setcookie("role_id",$user_found["role_id"] ?? '0', strtotime($cookie_time), "/");
            setcookie("session","active", strtotime($cookie_time), "/");
            setcookie("tema_oscuro",false, strtotime($cookie_time), "/");
            // setcookie("tema_oscuro",$user_found["tema_oscuro"], strtotime($cookie_time), "/");

            if ($user_found["role_id"] != ""){
               $permissions_query = "SELECT pages_read,pages_write,pages_delete,pages_update FROM roles WHERE id=$user_found[role_id]";
               // echo $permissions_query;
               $menus = "SELECT * FROM menus WHERE habilitado=1";
               $permisos = $this->Select($permissions_query,false);
               // if (sizeof($user_found) > 0) {
                  setcookie("pages_read",$permisos["pages_read"], strtotime($cookie_time), "/");
                  setcookie("pages_write",$permisos["pages_write"], strtotime($cookie_time), "/");
                  setcookie("pages_delete",$permisos["pages_delete"], strtotime($cookie_time), "/");
                  setcookie("pages_update",$permisos["pages_update"], strtotime($cookie_time), "/");
               // }
            }
            $this->close();
         }
      } catch (Exception $e) {
         error_log("Error: ".$e->getMessage());
      }
   }
}