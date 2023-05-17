<?php
include ('BusinessLine.php');
$BusinessLine = new BusinessLine();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_business_line'])) { $business_line = $_POST['input_business_line']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $BusinessLine->index();

elseif ($op == "show") $BusinessLine->show($id);
elseif ($op == 'showSelect') $BusinessLine->showSelect();

elseif ($op == "create") $BusinessLine->create($business_line, $created_at);

elseif ($op == "edit") $BusinessLine->edit($business_line, $id, $updated_at);

elseif ($op == "delete") $BusinessLine->delete($deleted_at, $id);