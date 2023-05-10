<?php
// var_dump($_POST);
include ("./User.php");
$User = new User();

if(isset($_POST['op'])) $op = $_POST['op']; else $op = null;

//SECCION DE LOGIN
if (isset($_POST['email'])) { $email = $_POST['email']; }
if (isset($_POST['password'])) { $password = $_POST['password']; }
//FUNCIONES
if ($op == 'login') { $User->login($email,$password); }
if ($op == 'logout') { $User->logout(); }
//SECCION DE LOGIN


if(isset($_POST['id'])) $id = $_POST['id'];
if(isset($_POST['input_name'])) $name = $_POST['input_name'];
if(isset($_POST['input_last_name'])) $last_name = $_POST['input_last_name'];
if(isset($_POST['input_cellphone'])) $cellphone = $_POST['input_cellphone']; else $input_cellphone = 'null';
if(isset($_POST['input_email'])) $email = $_POST['input_email'];
if(isset($_POST['input_password'])) $password = $_POST['input_password'];
if(isset($_POST['input_new_password'])) $new_password = $_POST['input_new_password']; else $new_password = "";
if(isset($_POST['input_active'])) $active = $_POST['input_active'];
if(isset($_POST['input_role_id'])) $role_id = $_POST['input_role_id'];
if(isset($_POST['input_created_at'])) $created_at = $_POST['input_created_at'];
if(isset($_POST['created_at'])) $created_at = $_POST['created_at'];
if(isset($_POST['updated_at'])) $updated_at = $_POST['updated_at'];
if(isset($_POST['deleted_at'])) $deleted_at = $_POST['deleted_at'];

// #region PETICIONES
if ($op == 'index') $User->index();

elseif ($op == 'show') $User->show($id);

elseif ($op == 'create') $User->create($name,$last_name,$cellphone,$email,$password,$role_id,$created_at);

elseif ($op == 'edit') {
  $change_password = false;
  if ($new_password != "") {
    $password = $new_password;
    $change_password = true;
  }
  $User->edit($name,$last_name,$cellphone,$email,$password,$role_id,$updated_at,$change_password,$id);
}

elseif ($op == "delete") $User->delete($deleted_at,$id);
// #endregion PETICIONES

