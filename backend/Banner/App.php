<?php
include ('Banner.php');
$Banner = new Banner();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_date_init'])) { $date_init = $_POST['input_date_init']; }
if (isset($_POST['input_date_end'])) { $date_end = $_POST['input_date_end']; }
if (isset($_POST['input_file_path'])) { $file_path = $_POST['input_file_path']; }
if (isset($_POST['input_type'])) { $type = $_POST['input_type']; } else { $type = 'PNG'; }
if (isset($_POST['input_order'])) { $order = $_POST['input_order']; }
if (isset($_POST['input_active'])) { $active = $_POST['input_active']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Banner->index();

elseif ($op == "show") $Banner->show($id);
elseif ($op == 'showSelect') $Banner->showSelect();

elseif ($op == "create") $Banner->create($date_init, $date_end, $file_path, $type, $order, $created_at);

elseif ($op == "edit") $Banner->edit($date_init, $date_end, $file_path, $type, $order, $updated_at, $id);
elseif ($op == "editOrder") $Banner->editOrder($id, $order);

elseif ($op == "delete") $Banner->delete($deleted_at, $id);