<?php
include('Level.php');
$Level = new Level();


if (isset($_POST['op'])) {
   $op = $_POST['op'];
}

if (isset($_POST['id'])) {
   $id = $_POST['id'];
}
if (isset($_POST['input_level'])) {
   $level = $_POST['input_level'];
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

if ($op == "index") $Level->index();

elseif ($op == "show") $Level->show($id);
elseif ($op == 'showSelect') $Level->showSelect();

elseif ($op == "create") $Level->create($level, $created_at);

elseif ($op == "edit") $Level->edit($level, $updated_at, $id);

elseif ($op == "delete") $Level->delete($deleted_at, $id);