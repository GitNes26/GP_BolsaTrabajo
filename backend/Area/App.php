<?php
include ('Area.php');
$Area = new Area();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_area'])) { $area = $_POST['input_area']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Area->index();

elseif ($op == "show") $Area->show($id);
elseif ($op == 'showSelect') $Area->showSelect();

elseif ($op == "create") $Area->create($area, $created_at);

elseif ($op == "edit") $Area->edit($area, $id, $updated_at);

elseif ($op == "delete") $Area->delete($deleted_at, $id);