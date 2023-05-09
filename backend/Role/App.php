<?php
include ('Role.php');
$Role = new Role();

if (isset($_POST['op'])) { $op = $_POST['op']; }
if (isset($_POST['op_pages'])) { $op = $_POST['op_pages']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['role_id'])) { $id = $_POST['role_id']; }
if (isset($_POST['role_id_pages'])) { $id = $_POST['role_id_pages']; }

if (isset($_POST['input_role'])) { $role = $_POST['input_role']; }
if (isset($_POST['pages_read'])) { $pages_read = $_POST['pages_read']; }
if (isset($_POST['pages_write'])) { $pages_write = $_POST['pages_write']; }
if (isset($_POST['pages_delete'])) { $pages_delete = $_POST['pages_delete']; }
if (isset($_POST['pages_update'])) { $pages_update = $_POST['pages_update']; }
// if (isset($_POST['role_menus'])) { $menus = $_POST['role_menus']; }


//PETICIONES
if ($op == 'index') $Role->index();

elseif ($op == 'showSelect') $Role->showSelect();
elseif ($op == 'show') $Role->show($id);
elseif ($op == 'showForRole') $Role->showForRole($id);

elseif ($op == 'create') $Role->create($role);

elseif ($op == 'editName') $Role->editName($role,$id);
elseif ($op == 'editForRole') $Role->editForRol($pages_read,$pages_write,$pages_delete,$pages_update,$id);

elseif ($op == "delete") $Role->delete($id);


//FUNCIONES