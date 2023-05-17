<?php
include ('Tag.php');
$Tag = new Tag();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_tag'])) { $tag = $_POST['input_tag']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Tag->index();

elseif ($op == "show") $Tag->show($id);
elseif ($op == 'showSelect') $Tag->showSelect();

elseif ($op == "create") $Tag->create($tag, $created_at);

elseif ($op == "edit") $Tag->edit($tag, $id, $updated_at);

elseif ($op == "delete") $Tag->delete($deleted_at, $id);