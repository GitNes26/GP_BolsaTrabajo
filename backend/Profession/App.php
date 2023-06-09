<?php
include ('Profession.php');
$Profession = new Profession();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_profession'])) { $profession = $_POST['input_profession']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Profession->index();

elseif ($op == "show") $Profession->show($id);
elseif ($op == 'showSelect') $Profession->showSelect();

elseif ($op == "create") $Profession->create($profession, $created_at);

elseif ($op == "edit") $Profession->edit($profession, $updated_at, $id);

elseif ($op == "delete") $Profession->delete($deleted_at, $id);