<?php
// var_dump($_POST);
include '../../config.php';
include ("./User.php");

if(isset($_POST['op'])) $op = $_POST['op']; else $op = null;
if(isset($_POST['input_db'])) $input_db = $_POST['input_db']; else $input_db = null;
if(isset($_POST['input_ejercicio'])) $ejercicio = $_POST['input_ejercicio']; else $ejercicio = date("Y");
if(isset($_POST['data'])) $data = $_POST['data']; else $data = null;

// #region PETICIONES
if ($op == "Index") {
  $User = new User($CONN_COMPAQ_CON);
  $User->Index($ejercicio);
}
elseif ($op == "LoadInfo") {
  if ($input_db == null) $User = new User($CONN_COMPAQ_CON);
  elseif ($input_db == "ctPRES_CON") $User = new User($CONN_COMPAQ_CON);
  elseif ($input_db == "ctPRES_SIN") $User = new User($CONN_COMPAQ_SIN);
  $User->Index($ejercicio);
}
elseif ($op == "SyncInfo") {
  $User = new User($CONN_INFO);
  $data = json_decode($data,true);
  $User->SyncInfo($CONN_INFO,$data);
}
// #endregion PETICIONES

