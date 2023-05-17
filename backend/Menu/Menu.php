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


class Menu extends Connection {
   
   function index() {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT m.*, pm.id parent_id, pm.menu parent_menu FROM menus m LEFT JOIN menus pm ON m.belongs_to=pm.id AND m.active=1 ORDER BY id;";
         $result = $this->Select($query, true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();

         // if (sizeof($resultado) > 0) {
         //    $response = $this->CorrectResponse();
         //    $response["message"] = "Peticion satisfactoria | registros encontrados.";
         //    $response["data"] = $result;
         //    $this->Close();
         // } else {
         //    $response = $this->CorrectResponse();
         // }
   
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
   
         #me traigo todos los menus que son padres
         $query = "SELECT id value, menu text FROM menus WHERE belongs_to=0 AND active=1;";
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
   
         $query = "SELECT m.*, pm.id parent_id, pm.menu parent_menu FROM menus m LEFT JOIN menus pm ON m.belongs_to=pm.id WHERE m.id=$id;";
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

   function create($menu, $tag, $belongs_to, $active, $file_path, $icon, $created_at) {
      try {
         $response = $this->defaultResponse();
         if($icon == "")
            $belongs_to == 0 ? $icon="fa-solid fa-folder-tree" : $icon="far fa-circle";
         // $belongs_to == 0 ? $tiene_hijos=true : $tiene_hijos=false;

         $query = "INSERT INTO menus(menu, tag, belongs_to, active, file_path, icon, created_at) VALUES(?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($menu,$tag,$belongs_to,$active,$file_path,$icon,$created_at));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Módulo registrado";
         $response["alert_text"] = "Módulo registrado";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   function edit($menu, $tag, $belongs_to, $active, $file_path, $icon, $id, $updated_at) {
      try {
         $response = $this->defaultResponse();

         if($icon == "")
            $belongs_to == 0 ? $icon="fa-solid fa-folder-tree" : $icon="far fa-circle";
         // $belongs_to == 0 ? $tiene_hijos=true : $tiene_hijos=false;

         $query = "UPDATE menus SET menu=?, tag=?, belongs_to=?, active=?, file_path=?, icon=?, updated_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($menu,$tag,$belongs_to,$active,$file_path,$icon,$updated_at, $id));
         
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Módulo actualizado";
         $response["alert_text"] = "Módulo actualizado";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }


   function showMyMenus($role_id) {
      try {
         $response = $this->defaultResponse();

         $permissions_query = "SELECT pages_read FROM roles WHERE id=$role_id";
         $permissions = $this->Select($permissions_query,false);
         // var_dupm($permissions);
         if (sizeof($permissions) > 0) {
            $pages_read = $permissions["pages_read"];
            $query = "SELECT m.* FROM roles r INNER JOIN menus m ON m.id WHERE m.active=1 AND r.id=$role_id;";
            if ($pages_read != "todas") {
               $menu_ids = $pages_read;
               $menu_ids = rtrim($menu_ids, ",");
               $query = "SELECT m.* FROM roles r INNER JOIN menus m ON m.id IN ($menu_ids) WHERE r.id=$role_id;";
            }
            $result = $this->Select($query, true);

            $response = $this->CorrectResponse();
            $response["message"] = "Peticion satisfactoria | registros encontrados.";
            $response["data"] = $result;
            $this->Close();
         }

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }

   // function mostrarMenusPadres() {
   //    try {
   //       $response = $this->defaultResponse();
   
   //       $query = "SELECT * FROM menus WHERE belongs_to=0 OR tiene_hijos=true AND active=1 ORDER BY orden ASC";
   //       $resultado = $this->SelectAndContinue($query);
   //       if (sizeof($resultado) > 0) {
   //         $response = array(
   //             "Resultado" => true,
   //             "Datos" => $resultado
   //         );
   //       } else {
   //          $response = array(
   //             "Resultado" => true,
   //             "Mensaje" => 'No registers.',
   //             // "Mensaje" => 'Sin registros.',
   //             "Datos" => array()
   //          );
   //       }
   
   //    } catch (Exception $e) {
   //       $error_message = "Error: ".$e->getMessage();
   //       $response = $this->catchResponse($error_message);
   //    }
   //    die(json_encode($response));
   
   // }

   // function mostrarMenusHijos($belongs_to) {
   //    try {
   //       $response = $this->defaultResponse();
   
   //       $query = "SELECT * FROM menus WHERE belongs_to=$belongs_to AND active=1 ORDER BY orden ASC";
   //       $resultado = $this->SelectAndContinue($query);
   //       if (sizeof($resultado) > 0) {
   //         $response = array(
   //             "Resultado" => true,
   //             "Datos" => $resultado
   //         );
   //       } else {
   //          $response = array(
   //             "Resultado" => true,
   //             "Mensaje" => 'No registers.',
   //             // "Mensaje" => 'Sin registros.',
   //             "Datos" => array()
   //          );
   //       }
   
   //    } catch (Exception $e) {
   //       $error_message = "Error: ".$e->getMessage();
   //       $response = $this->catchResponse($error_message);
   //    }
   //    die(json_encode($response));
   // }

   function activeDesactive($active,$id) {
      try {
         $status = $active ? "Habilitado" : "Deshabilitado";
         $response = $this->defaultResponse();
   
         $query = "UPDATE menus SET active=? WHERE id=?";

         $this->ExecuteQuery($query, array($active,$id));


         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registro modificado.";
         $response["alert_title"] = "Módulo $status";
         $response["alert_text"] = "Módulo $status";
         $this->Close();
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      die(json_encode($response));
   }


   function getIdForPath($path) {
      try {
         $response = $this->defaultResponse();
   
         $query = "SELECT id FROM menus WHERE file_path='$path'";
         $result = $this->Select($query,false);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | página encontrada.";
         $response["data"] = $result;
         $this->Close();

         // $resultado = $this->SelectOnlyOne($query);
         // if (!sizeof($resultado) > 0) {
         //    $response = array(
         //       "Resultado" => true,
         //       "Datos" => $resultado['id']
         //    );
         // } else {
         //    $response = array(
         //       "Resultado" => true,
         //       "Mensaje" => 'No registers.',
         //       // "Mensaje" => 'Sin registros.',
         //       "Datos" => array()
         //    );
         // }
   
      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($error_message);
      }
      return $response;
   }
}