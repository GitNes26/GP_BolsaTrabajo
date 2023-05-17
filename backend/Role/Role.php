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

class Role extends Connection
{
   // private $response;
   // function __construct() {
   //    $this->response = $this->defaultResponse();
   // }

   function index() {
      try {
         $response = $this->defaultResponse();
         $query = "SELECT p.id as perfil_id, p.perfil as perfil_nombre
         FROM perfiles as p WHERE p.estatus=1 ORDER BY perfil_nombre ASC";
         $result = $this->Select($query, true);
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
         $result = $this->Select($query, true);
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

   function create($usuario,$correo,$contrasenia,$perfil_id,$creado, $objeto) {
      try {
         $respuesta = $this->respuestaDefault();

         // $duplicado = $this->verificarDatoDisponible('usuario',$usuario,'Rolename',$usuario);
         // if ($duplicado["Resultado"] == true) die(json_encode($duplicado));

         // $duplicado = $this->verificarDatoDisponible('correo',$correo,'E-mail',$correo);
         // if ($duplicado["Resultado"] == true) die(json_encode($duplicado));


         $contrasenia_hash = password_hash($contrasenia,PASSWORD_DEFAULT);
         $query = "INSERT INTO usuarios (usuario,correo,contrasenia,perfil_id,creado) VALUES (?,?,?,?,?)";
         $this->ExecuteQueryAndContinue($query, array($usuario,$correo,$contrasenia_hash,$perfil_id,$creado));
         $id_insertado = (int)$this->ObtenerIdInsertado();
         $objeto->_usuario_id = $id_insertado;
         // VINCULAR EL USUARIO A LA TABLA USUARIOS
         // $this->vincularUsuario($id_insertado);

         if ($perfil_id == 3) { // CONSULTOR
            // include ("../Consultor/Consultor.php");
            // $Consultor = new Consultor();
            // $Consultor->vincularUsuarioConsultor($id_insertado);
            // $query = "CALL SP_VincularConsultor(
            //    $objeto->_usuario_id,
            //    $objeto->_paquete_id,
            //    $objeto->_fecha_pago,
            //    $objeto->_pagado
            // )";
            $query = "CALL SP_VincularConsultor($id_insertado)";
            $this->Procedure($query);

         }
         else if ($perfil_id == 4) { // SUSCRIPTOR
            // $consultor_id = null;
            // if ($_COOKIE["dpnstash_perfil_id"] == "2") $consultor_id = (int)$_COOKIE["dpnstash_user_id"];

            // include ("../Cliente/Cliente.php");
            // $Cliente = new Cliente();
            // $Cliente->vincularUsuarioCliente($id_insertado,$consultor_id);
            // $query = "CALL SP_VincularSuscriptor(
            //    $objeto->_usuario_id,
            //    $objeto->_nombre_negocio,
            //    $objeto->_consultor_id,
            //    $objeto->_consultor_viewer,
            //    $objeto->_paquete_id,
            //    $objeto->_fecha_pago,
            //    $objeto->_pagado
            // )";
            $query = "CALL SP_VincularSuscriptor($id_insertado)";
            $this->Procedure($query);
         }
         else if ($perfil_id == 5) { // EMPLEADO
            $suscriptor_id = null;
            if ($_COOKIE["dpnstash_perfil_id"] == "3") $suscriptor_id = (int)$_COOKIE["dpnstash_user_id"];

            // include ("../Empleado/Empleado.php");
            // $Empleado = new Empleado();
            // $Empleado->vincularUsuarioEmpleado($id_insertado,$suscriptor_id);
            $query = "CALL SP_VincularEmpleado($id_insertado, $objeto)";
            $this->Procedure($query);
         }

         $respuesta = array(
            "Resultado" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'Role registered.',
         );

      } catch (Exception $e) {
         $error_message = "Error: ".$e->getMessage();
         $respuesta = $this->respuestaCatch($error_message);
      }
      die(json_encode($respuesta));

   }

   function edit($usuario,$correo,$contrasenia,$perfil_id,$actualizado,$cambio_contrasenia,$id){
      try {
        $respuesta = $this->respuestaDefault();

         if ($cambio_contrasenia) {
            $contrasenia_hash = password_hash($contrasenia,PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET usuario=?, correo=?, contrasenia=?, perfil_id=?, actualizado=? WHERE id=?";
            $this->ExecuteQueryAndContinue($query, array($usuario,$correo,$contrasenia_hash,$perfil_id,$actualizado,$id));
         } else {
            $query = "UPDATE usuarios SET usuario=?, correo=?, perfil_id=?, actualizado=? WHERE id=?";
            $this->ExecuteQueryAndContinue($query, array($usuario,$correo,$perfil_id,$actualizado,$id));
         }

         $id = $_COOKIE["dpnstash_user_id"];
         // $this->eliminarCookies();
         $this->establecerCookies($id);

         $this->CerrarConexion();

         $respuesta = array(
            "Resultado" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'Role updated.',
         );
      } catch (Exception $e) {
         $error_message = "Error: ".$e->getMessage();
         $respuesta = $this->respuestaCatch($error_message);
      }
      die(json_encode($respuesta));
   }

   function delete($eliminado,$id) {
      try {
        $respuesta = $this->respuestaDefault();

         $query = "UPDATE usuarios SET activo=0, eliminado=? WHERE id=?";
         $this->ExecuteQuery($query, array($eliminado,$id));

         $respuesta = array(
            "Resultado" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'Role deleted.',
         );
      } catch (Exception $e) {
         $error_message = "Error: ".$e->getMessage();
         $respuesta = $this->respuestaCatch($error_message);
      }
      die(json_encode($respuesta));
   }

   function showSelect() {
      $response = $this->defaultResponse();

      try {
         $query = "SELECT id 'value', role 'text'
         FROM roles
         WHERE active=1";
         $result = $this->Select($query, true);
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
}