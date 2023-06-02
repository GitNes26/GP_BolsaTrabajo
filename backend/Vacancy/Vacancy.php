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


class Vacancy extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT v.*, c.company, a.area FROM vacancies v INNER JOIN companies c ON v.company_id=c.id INNER JOIN areas a ON v.area_id=a.id WHERE v.active=1;";
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
   
         $query = "SELECT id value, vacancy text FROM vacancies WHERE active=1;";
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
   
         $query = "SELECT * FROM vacancies WHERE id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro encontrado.";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $created_at) {
      try {
         $response = $this->defaultResponse();

         // $this->validateAvailableData(, null);

         $query = "INSERT INTO vacancies(vacancy, description, company_id, area_id, schedules, job_type, min_salary, max_salary, more_info, tags_ids, publication_date, expiration_date, created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $created_at));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Vacante registrada";
         $response["alert_text"] = "Vacante registrada";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $updated_at, $id) {
      try {
         $response = $this->defaultResponse();

         // $this->validateAvailableData($area, $id);

         $query = "UPDATE vacancies SET vacancy=?, description=?, company_id=?, area_id=?, schedules=?, job_type=?, min_salary=?, max_salary=?, more_info=?, tags_ids=?, publication_date=?, expiration_date=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $updated_at, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Vacante actualizada";
         $response["alert_text"] = "Vacante actualizada";
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

         $query = "UPDATE vacancies SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Vacante eliminada";
         $response["alert_text"] = "Vacante eliminada";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($area, $id) {
      // #VALIDACION DE DATOS REPETIDOS
      // $duplicate = $this->checkAvailableData('vacancies', 'area', $area, 'El área', 'input_area', $id);
      // if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}