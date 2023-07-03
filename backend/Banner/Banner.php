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


class Banner extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         // $query = "SELECT c.cli_id,iv.img_id,c.cli_nom_empresa,iv.img_fecha_ini,iv.img_fecha_fin,iv.img_ruta,iv.img_status, iv.img_order FROM imagen_vertical as iv INNER JOIN clientes as c ON c.cli_id=iv.cli_id ORDER BY iv.img_order ASC";         
         $query = "SELECT * FROM banners ORDER BY order ASC;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Banners encontrados";
         $response["alert_text"] = "Banners encontrados";
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
   
         $query = "SELECT id value, file_path text FROM banners WHERE active=1;";
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
   
         $query = "SELECT * FROM banners WHERE id=$id;";
         $result = $this->Select($query, false);

         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Banner encontrados";
         $response["alert_text"] = "Banner encontrados";
         $response["data"] = $result;
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function create($date_init, $date_end, $file_path, $type, $order, $created_at) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($file_path, null);

         $query = "INSERT INTO banners(date_init, date_end, file_path, type, order, created_at) VALUES(?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($date_init, $date_end, $file_path, $type, $order, $created_at));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Banner registrado";
         $response["alert_text"] = "Banner registrado";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($date_init, $date_end, $file_path, $type, $order, $updated_at, $id) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($file_path, $id);

         $query = "UPDATE banners SET date_init=?, date_end=?, file_path=?, type=?, order=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($date_init, $date_end, $file_path, $type, $order, $updated_at, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Banner actualizado";
         $response["alert_text"] = "Banner actualizado";
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

         $query = "UPDATE banners SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at, $id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Banner eliminado";
         $response["alert_text"] = "Banner eliminado";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }

   function editOrder($id, $order) {
      try {
         $response = $this->defaultResponse();

         $query = "UPDATE banners SET order=? WHERE img_id=?";
         $this->ExecuteQuery($query, array($order, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Orden actualizado";
         $response["alert_text"] = "Orden actualizado";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function validateAvailableData($file_path, $id) {
      // #VALIDACION DE DATOS REPETIDOS
      $duplicate = $this->checkAvailableData('banners', 'file_path', $file_path, 'El archivo', 'input_file_path', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }

   function contarRegistrosConLaMismaRuta($file_path) {
      try {
         $query = "SELECT COUNT(*) as duplicated FROM banners WHERE file_path='$file_path'";
         $result = $this->Select($query, false);
         return $result["duplicated"];
      } catch (Exception $e) {
         echo "Error: ".$e->getMessage();
      }
   }

}