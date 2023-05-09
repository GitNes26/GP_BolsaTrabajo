<?php
require_once("../Connection.php");

class User extends Connection {

   #region SECCION DE LOGIN
   function login($email,$password) {
      $response = $this->defaultResponse();
 
      try {
         $query = "SELECT u.id, u.name, u.last_name, u.cellphone, u.email, u.password, u.role_id
         FROM users as u WHERE u.email='$email' AND u.active=1 LIMIT 1";
         $user_found = $this->Select($query,false);
         // echo "el user_found:";
         // var_dump($user_found);

         if (sizeof($user_found) > 0) {
            if (password_verify($password, $user_found["password"])) {

               $this->setCookies($user_found["id"]);

               $response = $this->correctResponse();
               $response["message"] = "Peticion satisfactoria | registros encontrados.";
               $response["alert_title"] = "Bienvenido!";
               $response["alert_text"] = "$user_found[name]";
               $response["data"] = $user_found;

            } else {
               $response["alert_text"] = "Credenciales incorrectas, verifica tus values.";
            }
         }
         $this->Close();

       } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
       }
       die(json_encode($response));
   }

   function logout() {
      $this->unsetCookies();

      $response = $this->correctResponse();
      $response["message"] = "Cerrando sesión.";
      $response["alert_title"] = "Cerrando Sesión!";
      $response["alert_text"] = "Cerrando Sesión!";

      die(json_encode($response));
   }

   function setCookies($id) {
      try {
         $query = "SELECT u.id, u.name, u.email, u.password, u.role_id
         FROM users as u WHERE u.id=$id";

         $user_found = $this->Select($query,false);

         if (sizeof($user_found) > 0) {
            $cookie_time = '+30 days';
            // if ($user_found["role_id"] == 1)
            //   $cookie_time = '+1 day';

            setcookie("user_id",$user_found["id"], strtotime($cookie_time), "/");
            setcookie("name",$user_found["name"], strtotime($cookie_time), "/");
            setcookie("role_id",$user_found["role_id"], strtotime($cookie_time), "/");
            setcookie("session","active", strtotime($cookie_time), "/");
            setcookie("tema_oscuro",false, strtotime($cookie_time), "/");
            // setcookie("tema_oscuro",$user_found["tema_oscuro"], strtotime($cookie_time), "/");

            $permissions_query = "SELECT pages_read,pages_write,pages_delete,pages_update FROM roles WHERE id=$user_found[role_id]";
            $menus = "SELECT * FROM menus WHERE habilitado=1";
            $permisos = $this->Select($permissions_query,false);
            if (sizeof($user_found) > 0) {
               setcookie("pages_read",$permisos["pages_read"], strtotime($cookie_time), "/");
               setcookie("pages_write",$permisos["pages_write"], strtotime($cookie_time), "/");
               setcookie("pages_delete",$permisos["pages_delete"], strtotime($cookie_time), "/");
               setcookie("pages_update",$permisos["pages_update"], strtotime($cookie_time), "/");
            }
            $this->close();
         }
      } catch (Exception $e) {
         error_log("Error: ".$e->getMessage());
      }
   }
   function unsetCookies() {
      if (isset($_COOKIE)) {
         // $this->id = strpos($_COOKIE, 'user_id');
         foreach ($_COOKIE as $name=>$value) {
            unset($_COOKIE[$name]);
            setcookie($name, null, -1, "/");
         }
      }
   }
   #endregion SECCION DE LOGIN
   
   

   function index() {
      try {
         $response = $this->defaultResponse();
         $query = "SELECT *
         FROM users
         WHERE active=1";
         $result = $this->Select($query,true);
         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }

   function show($id) {
      $response = $this->defaultResponse();

      try {
         $query = "SELECT *
         FROM users
         WHERE active=1";
         $result = $this->Select($query,true);
         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   } 

   function create($name,$last_name,$cellphone,$email,$password,$role_id,$created_at) {
      try {
         $response = $this->defaultResponse();

         // VALIDACION DE DATOS REPETIDOS
         $duplicate = $this->checkAvailableData('users','name',$name,'El nombre',$name);
         if ($duplicate["result"] == true) die(json_encode($duplicate));

         // $duplicate = $this->checkAvailableData('email',$email,'E-mail',$email);
         // if ($duplicate["result"] == true) die(json_encode($duplicate));
         // VALIDACION DE DATOS REPETIDOS


         $password_hash = password_hash($password,PASSWORD_DEFAULT);
         $query = "INSERT INTO users (name,last_name,cellphone,email,password,role_id,created_at) VALUES (?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($name,$last_name,$cellphone,$email,$password_hash,$role_id,$created_at));
         $insert_id = (int)$this->getInsertId();
         $objeto->_name_id = $insert_id;

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["alert_title"] = "Usuario registrado.";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));

   }

   function edit($name,$email,$password,$role_id,$actualizado,$cambio_password,$id){
      try {
        $response = $this->defaultResponse();

         if ($cambio_password) {
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $query = "UPDATE users SET name=?, email=?, password=?, role_id=?, actualizado=? WHERE id=?";
            $this->ExecuteQuery($query,array($name,$email,$password_hash,$role_id,$actualizado,$id));
         } else {
            $query = "UPDATE users SET name=?, email=?, role_id=?, actualizado=? WHERE id=?";
            $this->ExecuteQuery($query,array($name,$email,$role_id,$actualizado,$id));
         }

         $id = $_COOKIE["user_id"];
         // $this->unsetCookies();
         $this->setCookies($id);

         $this->CerrarConexion();

         $response = array(
            "result" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'User updated.',
         );
      } catch (Exception $e) {
         $error_message = "Error: ".$e->getMessage();
         $response = $this->responseCatch($error_message);
      }
      die(json_encode($response));
   }

   function delete($eliminado,$id) {
      try {
        $response = $this->defaultResponse();

         $query = "UPDATE users SET active=0, eliminado=? WHERE id=?";
         $this->ExecuteQuery($query,array($eliminado,$id));

         $response = array(
            "result" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'User deleted.',
         );
      } catch (Exception $e) {
         $error_message = "Error: ".$e->getMessage();
         $response = $this->responseCatch($error_message);
      }
      die(json_encode($response));
   }



   function checkAvailableData($table,$column,$value,$propTitle,$propText){
     $query = "SELECT count(*) as duplicate FROM $table WHERE $column='$value' AND active=1";

     $consulta = $this->Select($query,false);
     if ($consulta["duplicate"] > 0) {
       $response = array(
          "result" => true,
          "alert_icon" => 'warning',
          "alert_title" => "$propTitle no disponible!",
          "alert_text" => "<b>$propText</b> ya existe, intenta con uno diferente.",
       );
     } else {
       $response = array(
         "result" => false,
        );
     }
     return $response;
   }
}