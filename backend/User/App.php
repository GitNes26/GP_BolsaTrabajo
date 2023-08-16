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
if(isset($_POST['input_email'])) $email = $_POST['input_email'];
if(isset($_POST['input_password'])) $password = $_POST['input_password'];
if(isset($_POST['input_new_password'])) $new_password = $_POST['input_new_password']; else $new_password = "";
if(isset($_POST['input_active'])) $active = $_POST['input_active'];
if(isset($_POST['input_role_id'])) $role_id = $_POST['input_role_id'];
if(isset($_POST['input_created_at'])) $created_at = $_POST['input_created_at'];
if(isset($_POST['created_at'])) $created_at = $_POST['created_at'];
if(isset($_POST['updated_at'])) $updated_at = $_POST['updated_at'];
if(isset($_POST['deleted_at'])) $deleted_at = $_POST['deleted_at'];

if(isset($_POST['role'])) $role = $_POST['role'];


// #region PETICIONES
if ($op == 'index') $User->index();

elseif ($op == 'show') $User->show($id);
elseif ($op == 'showInfo') $User->showInfo($id, $role_id);
elseif ($op == 'showSelect') $User->showSelect($role);

elseif ($op == 'register') $User->register($email,$password,$created_at);
elseif ($op == 'create') $User->create($email,$password,$role_id,$created_at);

elseif ($op == 'edit') {
  $change_password = false;
  if ($new_password != "") {
    $password = $new_password;
    $change_password = true;
  }
  $User->edit($email,$password,$role_id,$updated_at,$change_password,$id);
}
elseif ($op == 'changePassword') $User->changePassword($password, $updated_at, $id);

elseif ($op == "delete") $User->delete($deleted_at, $id);
// #endregion PETICIONES