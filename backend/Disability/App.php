<?php
include('Disability.php');
$Disability = new Disability();


if (isset($_POST['op'])) {
   $op = $_POST['op'];
}

if (isset($_POST['id'])) {
   $id = $_POST['id'];
}
if (isset($_POST['input_disability'])) {
   $disability = $_POST['input_disability'];
}
if (isset($_POST['input_description'])) {
   $description = $_POST['input_description'];
}

if (isset($_POST['created_at'])) {
   $created_at = $_POST['created_at'];
}
if (isset($_POST['updated_at'])) {
   $updated_at = $_POST['updated_at'];
}
if (isset($_POST['deleted_at'])) {
   $deleted_at = $_POST['deleted_at'];
}


#PETICIONES

if ($op == "index") $Disability->index();

elseif ($op == "show") $Disability->show($id);
elseif ($op == 'showSelect') $Disability->showSelect();

elseif ($op == "create") $Disability->create($disability, $description, $created_at);

elseif ($op == "edit") $Disability->edit($disability, $description, $updated_at, $id);

elseif ($op == "delete") $Disability->delete($deleted_at, $id);