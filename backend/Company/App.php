<?php
include ('Company.php');
$Company = new Company();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_company'])) { $company = $_POST['input_company']; }
if (isset($_POST['input_description'])) { $description = $_POST['input_description']; }
if (isset($_POST['input_logo_path'])) { $logo_path = $_POST['input_logo_path']; }
if (isset($_POST['input_contact_name'])) { $contact_name = $_POST['input_contact_name']; }
if (isset($_POST['input_contact_phone'])) { $contact_phone = $_POST['input_contact_phone']; }
if (isset($_POST['input_contact_email'])) { $contact_email = $_POST['input_contact_email']; }
if (isset($_POST['input_state'])) { $state = $_POST['input_state']; }
if (isset($_POST['input_municipality'])) { $municipality = $_POST['input_municipality']; }
if (isset($_POST['input_business_line_id'])) { $business_line_id = $_POST['input_business_line_id']; }
if (isset($_POST['input_company_ranking_id'])) { $company_ranking_id = $_POST['input_company_ranking_id']; }
if (isset($_POST['input_user_id'])) { $user_id = $_POST['input_user_id']; }
if (isset($_POST['user_id'])) { $user_id = $_POST['user_id']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }

if (isset($_POST['haveImg'])) { $haveImg = $_POST['haveImg']; } else { $haveImg = null; }

if (isset($_FILES['input_logo_path'])) {
  $path_files = "assets/img";
  $file = $_FILES['input_logo_path'];
  $type = explode(".",$file["name"]);
  $type = strtoupper(trim(end($type)));
  $type = "PNG";

  $dir = "../../$path_files/companies";
  $file_name = "$company.$type";
  $dest = "$dir/$file_name";

  if (!is_dir($dir)) {
     @mkdir($dir,0755,true);
     /**
     * 0755 => PERMISOS CRUD de los arvhicos
     * true => es para hacerlo recursivo,
     *         es decir todos los files de la ruta tienen
     *         los mismos permisos.
     */
  }
  if (move_uploaded_file($_FILES["input_logo_path"]["tmp_name"], $dest)) {
     $logo_path = "companies/$file_name";
  } else {
     $logo_path = "";
     $type = "";
     print(error_get_last());
  }
} else {
  $logo_path = "";
  $type = "";
}
if ($haveImg != null) $logo_path = $haveImg;


#PETICIONES

if ($op == "index") $Company->index();

elseif ($op == "show") $Company->show($id);
elseif ($op == 'showSelect') $Company->showSelect();

elseif ($op == "create") $Company->create($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id);

elseif ($op == "edit") $Company->edit($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id, $updated_at);

elseif ($op == "delete") $Company->delete($deleted_at, $user_id);

elseif ($op == "getIdByUserId") $Company->getIdByUserId($user_id);
