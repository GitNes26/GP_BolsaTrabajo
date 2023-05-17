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

class User extends Connection {

   #region SECCION DE LOGIN
   function login($email,$password) {
      $response = $this->defaultResponse();
      $response["alert_text"] = "Credenciales incorrectas, verifica tú información.";
      
      try {
         $query = "SELECT u.id, u.name, u.last_name, u.cellphone, u.email, u.password, u.role_id
         FROM users as u WHERE u.email='$email' AND u.active=1 LIMIT 1";
         $user_found = $this->Select($query,false);
         // echo "el user_found:";
         // var_dump($user_found);

         if ($user_found != false) {
            if (password_verify($password, $user_found["password"])) {

               $this->setCookies($user_found["id"]);

               $response = $this->correctResponse();
               $response["message"] = "Peticion satisfactoria | sesion inciada.";
               $response["alert_title"] = "Bienvenido!";
               $response["alert_text"] = "$user_found[name]";
               $response["data"] = $user_found;

            } else {
               $response["alert_text"] = "Credenciales incorrectas, verifica tú información.";
            }
         }
         $this->Close();

       } catch (Exception $e) {
         echo "el catch";
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
         $response["alert_title"] = "sadasdsa!";
      }
       die(json_encode($response));
   }

   function logout() {
      $this->unsetCookies();

      $response = $this->correctResponse();
      $response["message"] = "Peticion satisfactoria | Cerrando sesión.";
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
            $cookie_time = '+1 months';
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
            // echo "la coockie: $name";
            setcookie($name, "", -1, "/");
         }
      }
   }
   #endregion SECCION DE LOGIN
   
   

   function index() {
      try {
         $response = $this->defaultResponse();
         $query = "SELECT u.*, r.role
         FROM users u INNER JOIN roles r ON u.role_id=r.id 
         WHERE u.active=1";
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
         $query = "SELECT u.*, r.id role_id, r.role
         FROM users u INNER JOIN roles r ON u.role_id=r.id 
         WHERE u.active=1 and u.id=$id";
         $result = $this->Select($query,false);
         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro encontrado.";
         $response["alert_title"] = "Usuario encontrado";
         $response["alert_text"] = "Usuario encontrado";
         $response["data"] = $result;
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   } 

   function create($name, $last_name, $cellphone, $email, $password, $role_id, $created_at) {
      try {
         $response = $this->defaultResponse();

         // #VALIDACION DE DATOS REPETIDOS
         $this->validateAvailableData($cellphone, $email, null);

         $password_hash = password_hash($password,PASSWORD_DEFAULT);
         $query = "INSERT INTO users (name,last_name,cellphone,email,password,role_id,created_at) VALUES (?,?,?,?,?,?,?)";
         $this->ExecuteQuery($query, array($name, $last_name, $cellphone, $email, $password_hash, $role_id, $created_at) );
         // $insert_id = (int)$this->getInsertId();
         // $objeto->_name_id = $insert_id;

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro creado.";
         $response["alert_title"] = "Usuario registrado";
         $response["alert_text"] = "Usuario registrado";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));

   }

   function edit($name, $last_name, $cellphone, $email, $password, $role_id, $updated_at, $change_password, $id) {
      // function edit($name,$email,$password,$role_id,$updated_at,$change_password,$id){
      try {         
         $response = $this->defaultResponse();

         // #VALIDACION DE DATOS REPETIDOS
         $this->validateAvailableData($cellphone, $email, $id);

         if ($change_password) {
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $query = "UPDATE users SET name=?, last_name=?, cellphone=?, email=?, password=?, role_id=?, updated_at=? WHERE id=?";
            $this->ExecuteQuery($query, array($name, $last_name, $cellphone, $email, $password_hash, $role_id, $updated_at, $id));
         } else {
            $query = "UPDATE users SET name=?, last_name=?, cellphone=?, email=?, role_id=?, updated_at=? WHERE id=?";
            $this->ExecuteQuery($query, array($name, $last_name, $cellphone, $email, $role_id, $updated_at, $id));
         }

         $id = $_COOKIE["user_id"];
         // $this->unsetCookies();
         $this->setCookies($id);

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro actualizado.";
         $response["alert_title"] = "Usuario actualizado";
         $response["alert_text"] = "Usuario actualizado";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }

   function delete($deleted_at,$id) {
      try {
        $response = $this->defaultResponse();

         $query = "UPDATE users SET active=0, deleted_at=? WHERE id=?";
         $this->ExecuteQuery($query, array($deleted_at,$id));

         $response = $this->correctResponse();
         $response["message"] = "Peticion satisfactoria | registro eliminado.";
         $response["alert_title"] = "Usuario eliminado";
         $response["alert_text"] = "Usuario eliminado";
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $error_message = "Error: ".$e->getMessage();
         $response = $this->catchResponse($error_message);
      }
      die(json_encode($response));
   }

   function validateAvailableData($cellphone, $email, $id) {
      $duplicate = $this->checkAvailableData('users', 'cellphone', $cellphone, 'El número celular', 'input_cellphone', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));

      $duplicate = $this->checkAvailableData('users', 'email', $email, 'El correo', 'input_email', $id);
      if ($duplicate["result"] == true) die(json_encode($duplicate));
   }
}