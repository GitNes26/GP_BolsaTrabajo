<?php
require_once("../Connection.php");

class User extends Connection
{
   // private $response;
   // function __construct() {
   //    $this->response = $this->DefaultResponse();
   // }

   function Index() {
      $response = $this->DefaultResponse();

      try {
         $query = "SELECT *
         FROM users
         WHERE active=1";
         $result = $this->Select($query,true);
         $response = $this->CorrectResponse();
         $response["message"] = "Peticion satisfactoria | registros encontrados.";
         $response["data"] = $result;
         $this->Close();

      } catch (Exception $e) {
         $this->Close();
         $mensaje_error = "Error: ".$e->getMessage();
         $response = $this->CatchResponse($mensaje_error);
      }
      die(json_encode($response));
   } 


   function Create($usuario,$correo,$contrasenia,$perfil_id,$creado, $objeto) {
      try {
         $respuesta = $this->respuestaDefault();

         $duplicado = $this->verificarDatoDisponible('usuario',$usuario,'Username',$usuario);
         if ($duplicado["Resultado"] == true) die(json_encode($duplicado));

         $duplicado = $this->verificarDatoDisponible('correo',$correo,'E-mail',$correo);
         if ($duplicado["Resultado"] == true) die(json_encode($duplicado));


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
            // if ($_COOKIE["dpnstash_perfil_id"] == "2") $consultor_id = (int)$_COOKIE["dpnstash_id_usuario"];

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
            if ($_COOKIE["dpnstash_perfil_id"] == "3") $suscriptor_id = (int)$_COOKIE["dpnstash_id_usuario"];

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
            "Texto_alerta" => 'User registered.',
         );

      } catch (Exception $e) {
         $mensaje_error = "Error: ".$e->getMessage();
         $respuesta = $this->respuestaCatch($mensaje_error);
      }
      die(json_encode($respuesta));

   }

   function Edit($usuario,$correo,$contrasenia,$perfil_id,$actualizado,$cambio_contrasenia,$id){
      try {
        $respuesta = $this->respuestaDefault();

         if ($cambio_contrasenia) {
            $contrasenia_hash = password_hash($contrasenia,PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET usuario=?, correo=?, contrasenia=?, perfil_id=?, actualizado=? WHERE id=?";
            $this->ExecuteQueryAndContinue($query,array($usuario,$correo,$contrasenia_hash,$perfil_id,$actualizado,$id));
         } else {
            $query = "UPDATE usuarios SET usuario=?, correo=?, perfil_id=?, actualizado=? WHERE id=?";
            $this->ExecuteQueryAndContinue($query,array($usuario,$correo,$perfil_id,$actualizado,$id));
         }

         $id = $_COOKIE["dpnstash_id_usuario"];
         // $this->eliminarCookies();
         $this->establecerCookies($id);

         $this->CerrarConexion();

         $respuesta = array(
            "Resultado" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'User updated.',
         );
      } catch (Exception $e) {
         $mensaje_error = "Error: ".$e->getMessage();
         $respuesta = $this->respuestaCatch($mensaje_error);
      }
      die(json_encode($respuesta));
   }

   function Delete($eliminado,$id) {
      try {
        $respuesta = $this->respuestaDefault();

         $query = "UPDATE usuarios SET activo=0, eliminado=? WHERE id=?";
         $this->ExecuteQuery($query,array($eliminado,$id));

         $respuesta = array(
            "Resultado" => true,
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'SUCCESS',
            "Texto_alerta" => 'User deleted.',
         );
      } catch (Exception $e) {
         $mensaje_error = "Error: ".$e->getMessage();
         $respuesta = $this->respuestaCatch($mensaje_error);
      }
      die(json_encode($respuesta));
   }



   function CheckAvailableData($table,$campo,$dato,$propiedadTitulo,$propiedadTexto){
     $query = "SELECT count(*) as duplicado FROM $table WHERE $campo='$dato' AND activo=1";

     $consulta = $this->SelectOneAndContinue($query);
     if ($consulta["duplicado"] > 0) {
       $respuesta = array(
          "Resultado" => true,
          "Icono_alerta" => 'warning',
          "Titulo_alerta" => "$propiedadTitulo unavailable!",
          "Texto_alerta" => "<b>$propiedadTexto</b> already exists, try a different one.",
       );
     } else {
       $respuesta = array(
         "Resultado" => false,
        );
     }
     return $respuesta;
   }
}