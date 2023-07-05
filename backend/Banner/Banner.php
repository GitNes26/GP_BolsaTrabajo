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
           
         $query = "SELECT * FROM banners ORDER BY order_view ASC;";
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

   function fillBanners($current_date) {
      try {
         $response = $this->defaultResponse();

         $query = "SELECT * FROM banners WHERE active=1 AND date_init <= '$current_date' AND date_end >= '$current_date' ORDER BY order_view ASC;";
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

   function create($date_init, $date_end, $link, $file_path, $type_file, $order_view, $created_at) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($file_path, null);

         if ($order_view == 0) $order_view = (int)$this->countRegisters() + 1;

         // echo "$date_init  |  $date_end  |  $file_path  |  $type_file  |  $order_view  |  $created_at";

         $query = "INSERT INTO banners(date_init, date_end, link, file_path, type_file, order_view,  created_at) VALUES(?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($date_init, $date_end, $link, $file_path, $type_file, $order_view, $created_at));
         
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

   function edit($date_init, $date_end, $link, $file_path, $type_file, $updated_at, $id) {
      try {
         $response = $this->defaultResponse();

         $this->validateAvailableData($file_path, $id);
         // echo "$date_init | $date_end | $link | $file_path | $type_file | $updated_at | $id";

         $query = "UPDATE banners SET date_init=?, date_end=?, link=?, file_path=?, type_file=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($date_init, $date_end, $link, $file_path, $type_file, $updated_at, $id));
         
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

   function delete($id, $file_path) {
      try {
        $response = $this->defaultResponse();

         $query = "DELETE FROM banners WHERE id=?";
         $this->ExecuteQuery($query, array($id));

         if (file_exists("../../assets/img/$file_path")) {
            // Establecer permisos
            $permissions = 0777;
            if (chmod("../../assets/img/$file_path", $permissions))
               unlink("../../assets/img/$file_path");
         }

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

   function activeDesactive($active, $id) {
      try {
         $response = $this->defaultResponse();

         $query = "UPDATE banners SET active=? WHERE id=?";
         $this->ExecuteQuery($query, array($active, $id));

         $status = $active == "1" ? "Activado" : "Desactivado";
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Banner $status";
         $response["alert_text"] = "Banner $status";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function editOrder($id, $order_view) {
      try {
         $response = $this->defaultResponse();

         $query = "UPDATE banners SET order_view=? WHERE img_id=?";
         $this->ExecuteQuery($query, array($order_view, $id));
         
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

   function countRegisters() {
      try {
         $query = "SELECT COUNT(*) as register FROM banners WHERE active=1";
         $result = $this->Select($query, false);
         return $result["register"];
      } catch (Exception $e) {
         echo "Error: ".$e->getMessage();
      }
   }

}