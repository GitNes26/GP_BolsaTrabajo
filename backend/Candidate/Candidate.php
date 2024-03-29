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


class Candidate extends Connection
{

   function index()
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT * FROM vw_candidates";
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

   function showSelect()
   {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT c.id value, c.name text FROM candidates c INNER JOIN users u ON c.user_id=u.id WHERE u.active=1;";
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

         $query = "SELECT * FROM vw_candidates WHERE id=$id;";
         $result = $this->Select($query, false);

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

   function create($name, $last_name, $cellphone, $birthdate, $professional_info, $photo_path, $cv_path, $languages, $profession_id, $interest_tags_ids, $user_id)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($cellphone, null);

         #Creamos el registro en la tabla candidatos
         $query = "INSERT INTO candidates(name, last_name, cellphone, birthdate, professional_info, photo_path, cv_path, languages, profession_id, interest_tags_ids, user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($name, $last_name, $cellphone, $birthdate, $professional_info, $photo_path, $cv_path, $languages, $profession_id, $interest_tags_ids, $user_id));

         #Le asignamos el rol de compañia al usuario
         $query = "UPDATE users SET role_id=4 WHERE id=?";
         $this->ExecuteQuery($query, array($user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Candidato registrado";
         $response["alert_text"] = "Bienvenido $name";
         $response["toast"] = false;
         $this->Close();

         require_once "../User/User.php";
         $User = new User();
         $User->setCookies($user_id);
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($name, $last_name, $cellphone, $birthdate, $professional_info, $photo_path, $cv_path, $languages, $profession_id, $interest_tags_ids, $user_id, $updated_at, $id)
   {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($cellphone, $id);

         $query = "UPDATE candidates SET name=?, last_name=?, cellphone=?, birthdate=?, professional_info=?, photo_path=?, cv_path=?, languages=?, profession_id=?, interest_tags_ids=?, user_id=? WHERE id=?";
         $this->ExecuteQuery($query, array($name, $last_name, $cellphone, $birthdate, $professional_info, $photo_path, $cv_path, $languages, $profession_id, $interest_tags_ids, $user_id, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Candidato actualizado";
         $response["alert_text"] = "Candidato actualizado";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }
   function editInfo($user_id, $name, $last_name, $cellphone, $professional_info, $languages, $profession_id, $email, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $this->validateAvailableData($cellphone, $id);

         $query = "UPDATE candidates SET name=?, last_name=?, cellphone=?, professional_info=?, languages=?, profession_id=? WHERE id=?";
         $this->ExecuteQuery($query, array($name, $last_name, $cellphone, $professional_info, $languages, $profession_id, $id));

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
   function editPhoto($user_id, $photo_path, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $query = "UPDATE candidates SET photo_path=? WHERE id=?";
         $this->ExecuteQuery($query, array($photo_path, $id));

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
   function editCv($user_id, $cv_path, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $query = "UPDATE candidates SET cv_path=? WHERE id=?";
         $this->ExecuteQuery($query, array($cv_path, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Curriculum actualizado";
         $response["alert_text"] = "Curriculum actualizado";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }
   function editName($user_id, $name, $last_name, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $query = "UPDATE candidates SET name=?, last_name=? WHERE id=?";
         $this->ExecuteQuery($query, array($name, $last_name, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Nombre actualizado";
         $response["alert_text"] = "Nombre actualizado";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }
   function changeEnable($user_id, $enable, $updated_at)
   {
      try {
         $response = $this->defaultResponse();

         $id = $this->getIdByUserId($user_id);
         if ($id == 0) die(json_encode($response));

         $query = "UPDATE candidates SET enable=? WHERE id=?";
         $this->ExecuteQuery($query, array($enable, $id));

         $query = "UPDATE users SET updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($updated_at, $user_id));

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Disponibilidad actualizada";
         $response["alert_text"] = "Disponibilidad actualizada";
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
         $response["alert_title"] = "Candidato eliminado";
         $response["alert_text"] = "Candidato eliminado";
         $this->Close();
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: " . $e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }


   function validateAvailableData($cellphone, $id)
   {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('candidates', 'cellphone', $cellphone, 'El número celular', 'input_cellphone', $id, 'users');
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }

   function getIdByUserId($user_id, $private = true)
   {
      $query = "SELECT id FROM candidates WHERE user_id=$user_id;";
      $candidate = $this->Select($query, false);
      if ($private) {
         if (!$candidate) return 0;
         else return $candidate["id"];
      } else {
         if (!$candidate) die(json_encode(array("data" => 0)));
         else die(json_encode(array("data" => $candidate["id"])));
      }
   }
}
