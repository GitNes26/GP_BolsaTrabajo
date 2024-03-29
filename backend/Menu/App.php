<?php
include('Menu.php');
$Menu = new Menu();


if (isset($_POST['op'])) {
   $op = $_POST['op'];
}

if (isset($_POST['id'])) {
   $id = $_POST['id'];
}
if (isset($_POST['input_menu'])) {
   $menu = $_POST['input_menu'];
}
// if (isset($_POST['input_description'])) { $description = $_POST['input_description']; }
if (isset($_POST['input_tag'])) {
   $tag = $_POST['input_tag'];
}
if (isset($_POST['input_belongs_to'])) {
   $belongs_to = $_POST['input_belongs_to'];
}
if (isset($_POST['input_file_path'])) {
   $file_path = $_POST['input_file_path'];
}
if (isset($_POST['input_icon'])) {
   $icon = $_POST['input_icon'];
}
if (isset($_POST['input_order'])) {
   $order = $_POST['input_order'];
}
if (isset($_POST['input_active'])) {
   $active = $_POST['input_active'] == 'on' ? "1"  : $_POST['input_active'];
} else {
   $active = "0";
}
if (isset($_POST['input_show_counter'])) {
   $show_counter = $_POST['input_show_counter'] == 'on' ? "1"  : $_POST['input_show_counter'];
} else {
   $show_counter = "0";
}
if (isset($_POST['switch_active'])) {
   $active = $_POST['switch_active'];
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

// if (isset($_POST['input_have_children'])) { $have_children = $_POST['input_have_children']; }

if (isset($_POST['role_id'])) {
   $role_id = $_POST['role_id'];
}

if (isset($_POST['menu'])) {
   $menu = $_POST['menu'];
}


#PETICIONES

if ($op == "index") $Menu->index();

elseif ($op == "showMyMenus") $Menu->showMyMenus($role_id);
elseif ($op == 'showSelect') $Menu->showSelect();
elseif ($op == "show") $Menu->show($id);

elseif ($op == "create") $Menu->create($menu, $tag, $belongs_to, $active, $show_counter, $file_path, $icon, $created_at);

elseif ($op == "edit") $Menu->edit($menu, $tag, $belongs_to, $active, $show_counter, $file_path, $icon, $id, $updated_at);

elseif ($op == "activeDesactive") $Menu->activeDesactive($active, $id);

// elseif ($op == "delete") {
//    $Menu->delete($id);
// }

// elseif ($op == "showParentMenus") $Menu->showParentMenus();
// elseif ($op == "showChildrenMenus") $Menu->showChildrenMenus();