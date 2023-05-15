<?php
include ('Giro.php');
$Giro = new Giro();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_business_line'])) { $business_line = $_POST['input_business_line']; }
if (isset($_POST['input_active'])) { $active = $_POST['input_active'] == 'on' ? "1"  : $_POST['input_active']; } else { $active = "0"; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


if (isset($_POST['role_id'])) { $role_id = $_POST['role_id']; }


#PETICIONES

elseif ($op == "index") $Giro->index();

elseif ($op == "show") $Giro->show($id);
elseif ($op == 'showSelect') $Giro->showSelect();

elseif ($op == "create") $Giro->create($business_line, $tag, $belongs_to, $active, $file_path, $icon, $created_at);

elseif ($op == "edit") $Giro->edit($business_line, $tag, $belongs_to, $active, $file_path, $icon, $id, $updated_at);

elseif ($op == "activeDesactive") $Giro->activeDesactive($active,$id);

// elseif ($op == "delete") {
//    $Giro->delete($id);
// }

elseif ($op == "showParentGiros") $Giro->showParentGiros();
elseif ($op == "showChildrenGiros") $Giro->showChildrenGiros();