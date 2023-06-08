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


class Application extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT *, a.id a_id, v.id v_id, c.id c_id, ca.id ca_id
         FROM applications a
         INNER JOIN vacancies v ON a.vacancy_id=v.id
         INNER JOIN companies c ON v.company_id=c.id
         INNER JOIN candidates ca ON a.candidate_id=ca.id
         WHERE a.active=1 ORDER BY id DESC;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Solicitudes encontradas";
         $response["alert_text"] = "Solicitudes encontradas";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function myApplications($user_id) {
      try {
         // echo "el usuario: $user_id";
         $response = $this->defaultResponse();

         #OBTENER EL CANDIDATO SEGUN EL USUARIO
         $candidate_id = $this->getCandidateIdByUserId($user_id);
         if ($candidate_id > 0) {
            $query = "SELECT *, a.id a_id, v.id v_id, c.id c_id, ca.id ca_id
            FROM applications a
            INNER JOIN vacancies v ON a.vacancy_id=v.id
            INNER JOIN companies c ON v.company_id=c.id
            INNER JOIN candidates ca ON a.candidate_id=ca.id
            WHERE a.candidate_id=$candidate_id AND a.active=1 ORDER BY a.id DESC;";
            $result = $this->Select($query, true);
         }
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Solicitudes encontradas";
         $response["alert_text"] = "Solicitudes encontradas";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }
   function myApplicationsByCompany($user_id) {
      try {
         // echo "el usuario: $user_id";
         $response = $this->defaultResponse();

         #OBTENER EL CANDIDATO SEGUN EL USUARIO
         $company_id = $this->getCompanyIdByUserId($user_id);
         if ($company_id > 0) {
            $query = "SELECT *, a.id a_id, v.id v_id, c.id c_id, ca.id ca_id, ca.*, u.email
            FROM applications a
            INNER JOIN vacancies v ON a.vacancy_id=v.id
            INNER JOIN companies c ON v.company_id=c.id
            INNER JOIN candidates ca ON a.candidate_id=ca.id
            INNER JOIN users u ON ca.user_id=u.id
            WHERE c.id=$company_id AND a.active=1 ORDER BY a.id DESC;";
            $result = $this->Select($query, true);
         }
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Solicitudes encontradas";
         $response["alert_text"] = "Solicitudes encontradas";
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
   
         $query = "SELECT id value, area text FROM applications WHERE active=1;";
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
   
         $query = "SELECT *, a.id a_id, v.id v_id, c.id c_id, ca.id ca_id
         FROM applications a
         INNER JOIN vacancies v ON a.vacancy_id=v.id
         INNER JOIN companies c ON v.company_id=c.id
         INNER JOIN candidates ca ON a.candidate_id=ca.id
         WHERE a.id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro encontrado.";
         $response["alert_title"] = "Solicitud encontrada";
         $response["alert_text"] = "Solicitud encontrada";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function apply($vacancy_id, $user_id, $created_at) {
      try {
         $response = $this->defaultResponse();

         // $this->validateAvailableData($vacancy_id, $candidate_id, $status, null);

         #OBTENER EL CANDIDATO SEGUN EL USUARIO
         $candidate_id = $this->getCandidateIdByUserId($user_id);
         if ($candidate_id > 0) {
            $query = "INSERT INTO applications(vacancy_id, candidate_id, created_at) VALUES(?,?,?)";
            $this->ExecuteQuery($query, array($vacancy_id, $candidate_id, $created_at));
         }

         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Solicitud enviada";
         $response["alert_text"] = "Revisa el status de la postulación en la sección de 'Mis Solicitudes'";
         $response["toast"] = false;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function changeStatus($status, $updated_at, $id) {
      try {
         $response = $this->defaultResponse();

         // $this->validateAvailableData($id, $id);

         $query = "UPDATE applications SET status=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($status, $updated_at, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Solicitud $status";
         $response["alert_text"] = "Solicitud $status";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }


   function checkAlreadyApplied($vacancy_id, $user_id) {
      try {
         $response = $this->defaultResponse();

         #OBTENER EL CANDIDATO SEGUN EL USUARIO
         $candidate_id = $this->getCandidateIdByUserId($user_id);
         $data = [];
         if ($candidate_id > 0) {
            $query = "SELECT count(*) applied FROM applications WHERE vacancy_id=$vacancy_id AND candidate_id=$candidate_id;";
            $result = $this->Select($query, false);
            $data = array("applied" => (int)$result["applied"]);
         }

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro encontrado.";
         $response["alert_icon"] = "warning";
         $response["alert_title"] = "Ya te has postulado a esta vacante";
         $response["alert_text"] = "Ya te has postulado a esta vacante";
         $response["data"] = $data;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function getCandidateIdByUserId($user_id) {
      $query = "SELECT id FROM candidates WHERE user_id=$user_id;";
      $candidate = $this->Select($query, false);
      if (!$candidate) return 0;
      else return $candidate["id"]; 
   }
   function getCompanyIdByUserId($user_id) {
      $query = "SELECT id FROM companies WHERE user_id=$user_id;";
      $company = $this->Select($query, false);
      if (!$company) return 0;
      else return $company["id"]; 
   }

   function validateAvailableData($area, $id) {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('applications', 'area', $area, 'El área', 'input_area', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }

   // function edit($area, $id, $updated_at) {
   //    try {
   //       $response = $this->defaultResponse();

   //       $this->validateAvailableData($area, $id);

   //       $query = "UPDATE applications SET area=?, updated_at=? WHERE id=?";
   //       $this->ExecuteQuery($query, array($area, $updated_at, $id));
         
   //       $response = $this->CorrectResponse();
   //       $response["message"] = "Peticion satisfactoria | registro actualizado.";
   //       $response["alert_title"] = "Solicitud actualizado";
   //       $response["alert_text"] = "Solicitud actualizado";
   //       $this->Close();
   
   //    } catch (Exception $e) {
   //       $this->Close();
   //       $error_message = "Error: ".$e->getMessage();
   //       $response = $this->CatchResponse($error_message);
   //    }
   //    die(json_encode($response));
   // }

   // function delete($deleted_at, $id) {
   //    try {
   //      $response = $this->defaultResponse();

   //       $query = "UPDATE applications SET active=0, deleted_at=? WHERE id=?";
   //       $this->ExecuteQuery($query, array($deleted_at, $id));

   //       $response = $this->correctResponse();
   //       $response["message"] = "Peticion satisfactoria | registro eliminado.";
   //       $response["alert_title"] = "Solicitud eliminada";
   //       $response["alert_text"] = "Solicitud eliminada";
   //       $this->Close();

   //    } catch (Exception $e) {
   //       $this->Close();
   //       $error_message = "Error: ".$e->getMessage();
   //       $response = $this->catchResponse($error_message);
   //    }
   //    die(json_encode($response));
   // }


   
}