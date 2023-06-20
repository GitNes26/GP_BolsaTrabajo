<?php
include ('Candidate.php');
$Candidate = new Candidate();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if(isset($_POST['input_name'])) $name = $_POST['input_name'];
if(isset($_POST['input_last_name'])) $last_name = $_POST['input_last_name'];
if(isset($_POST['input_cellphone'])) $cellphone = $_POST['input_cellphone']; else $input_cellphone = '';
if (isset($_POST['input_age'])) { $age = $_POST['input_age']; }
if (isset($_POST['input_professional_info'])) { $professional_info = $_POST['input_professional_info']; }
// if (isset($_POST['input_cv_path'])) { $cv_path = $_POST['input_cv_path']; }
if (isset($_POST['input_languages'])) { $languages = $_POST['input_languages']; }
if (isset($_POST['input_profession_id'])) { $profession_id = $_POST['input_profession_id']; } else $profession_id = '0';
if (isset($_POST['input_interest_tags_ids'])) { $interest_tags_ids = $_POST['input_interest_tags_ids']; } else $interest_tags_ids = '';
if (isset($_POST['input_user_id'])) { $user_id = $_POST['input_user_id']; }
if (isset($_POST['user_id'])) { $user_id = $_POST['user_id']; }

// if (isset($_POST['input_state'])) { $state = $_POST['input_state']; }
// if (isset($_POST['input_municipality'])) { $municipality = $_POST['input_municipality']; }

// if (isset($_POST['input_experiencies_ids'])) { $experiencies_ids = $_POST['input_experiencies_ids']; }
// if (isset($_POST['input_skills'])) { $skills = $_POST['input_skills']; }
// if (isset($_POST['input_abilities'])) { $input_abilities = $_POST['input_abilities']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }

if (isset($_POST['haveImg'])) { $haveImg = $_POST['haveImg']; } else { $haveImg = null; }
if (isset($_POST['haveCv'])) { $haveCv = $_POST['haveCv']; } else { $haveCv = null; }

if (isset($_FILES['input_photo_path'])) {
  $path_files = "assets/img";
  $file = $_FILES['input_photo_path'];
  $type = explode(".",$file["name"]);
  $type = strtoupper(trim(end($type)));

  $dir = "../../$path_files/candidates";
  $file_name = "$user_id-$name.$type";
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
  if (move_uploaded_file($_FILES["input_photo_path"]["tmp_name"], $dest)) {
     $photo_path = "candidates/$file_name";
  } else {
     $photo_path = "";
     $type = "";
     print(error_get_last());
  }
} else {
  $photo_path = "";
  $type = "";
}
if ($photo_path == "" && $haveImg != null) $photo_path = $haveImg;


if (isset($_FILES['input_cv_path'])) {
   $path_files = "assets/img";
   $file = $_FILES['input_cv_path'];
   $type = explode(".",$file["name"]);
   $type = strtoupper(trim(end($type)));
 
   $dir = "../../$path_files/candidates";
   $file_name = "$user_id-$name"."-cv."."$type";
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
   if (move_uploaded_file($_FILES["input_cv_path"]["tmp_name"], $dest)) {
      $cv_path = "candidates/$file_name";
   } else {
      $cv_path = "";
      $type = "";
      print(error_get_last());
   }
} else {
   $cv_path = "";
   $type = "";
}
if ($cv_path == "" && $haveCv != null) $cv_path = $haveCv;

#PETICIONES

if ($op == "index") $Candidate->index();

elseif ($op == "show") $Candidate->show($id);
elseif ($op == 'showSelect') $Candidate->showSelect();

elseif ($op == "create") $Candidate->create($name, $last_name, $cellphone, $age, $professional_info, $photo_path, $cv_path, $languages, $profession_id, $interest_tags_ids, $user_id);

elseif ($op == "edit") $Candidate->edit($name, $last_name, $cellphone, $age, $professional_info, $photo_path, $cv_path, $languages, $profession_id, $interest_tags_ids, $user_id, $updated_at, $id);
elseif ($op == "editName") $Candidate->editName($user_id, $name, $last_name, $updated_at);


elseif ($op == "delete") $Candidate->delete($deleted_at, $user_id);

elseif ($op == "getIdByUserId") $Candidate->getIdByUserId($user_id);