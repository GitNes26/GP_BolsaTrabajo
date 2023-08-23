<?php
include ('Vacancy.php');
$Vacancy = new Vacancy();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_vacancy'])) { $vacancy = $_POST['input_vacancy']; }
if (isset($_POST['input_description'])) { $description = $_POST['input_description']; } else $description = " "; 
if (isset($_POST['input_company_id'])) { $company_id = $_POST['input_company_id']; }
if (isset($_POST['input_area_id'])) { $area_id = $_POST['input_area_id']; } else $area_id=1;
if (isset($_POST['input_schedules'])) { $schedules = $_POST['input_schedules']; } else $schedules = " ";
if (isset($_POST['input_job_type'])) { $job_type = $_POST['input_job_type']; } else $job_type = " ";
if (isset($_POST['input_min_salary'])) { $min_salary = $_POST['input_min_salary']; }
if (isset($_POST['input_max_salary'])) { $max_salary = $_POST['input_max_salary']; }
if (isset($_POST['input_more_info'])) { $more_info = $_POST['input_more_info']; }
if (isset($_POST['input_tags_ids'])) { $tags_ids = $_POST['input_tags_ids']; } else { $tags_ids = ""; } 
if (isset($_POST['input_publication_date'])) { $publication_date = $_POST['input_publication_date']; }
if (isset($_POST['input_expiration_date'])) { $expiration_date = $_POST['input_expiration_date']; } else { $expiration_date = null; }
if (isset($_POST['input_publication_mode'])) { $publication_mode = $_POST['input_publication_mode']; } else $publication_mode=null; 

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }

if (isset($_POST['haveImg'])) { $haveImg = $_POST['haveImg']; } else { $haveImg = null; }
if (isset($_POST['deleteImg'])) { $deleteImg = $_POST['deleteImg']; } else { $deleteImg = null; }
if (isset($_FILES['input_img_path'])) {
  $path_files = "assets/img";
  $file = $_FILES['input_img_path'];
  // $type = explode(".",$file["name"]);
  // $type = strtoupper(trim(end($type)));
  $type = "PNG";

  $dir = "../../$path_files/vacancies";
  // $file_name = "$vacancy.$type";
  // $dest = "$dir/$file_name";

  if (!is_dir($dir)) {
    @mkdir($dir,0777,true);
    /**
    * 0755 => PERMISOS CRUD de los arvhicos
    * true => es para hacerlo recursivo,
    *         es decir todos los files de la ruta tienen
    *         los mismos permisos.
    */
  }


  $file_name = "$company_id-$vacancy";
  $permissions = 0777;
  if (file_exists("$dir/$file_name.PNG")) {
    // Establecer permisos
    if (chmod("$dir/$file_name.PNG", $permissions)) {
      if ($deleteImg == 1) @unlink("$dir/$file_name.PNG");
    }
    $type = "JPG";
  }
  elseif (file_exists("$dir/$file_name.JPG")) {
    // Establecer permisos
    if (chmod("$dir/$file_name.JPG", $permissions)) {
      if ($deleteImg == 1 ) @unlink("$dir/$file_name.JPG");
    }
    $type = "PNG";
  } else {
    // var_dump($_FILES["input_img_path"]["name"]);
    $img_path = null;      
  }
  
 
  $dest = "$dir/$file_name.$type";

  if (move_uploaded_file($_FILES["input_img_path"]["tmp_name"], $dest)) {
    $img_path = "vacancies/$file_name.$type";
  } else {
    $img_path = "";
    $type = "";
    print(error_get_last());
  }
 
} else {
  $img_path = "";
  $type = "";
}
if ($img_path == "" && $haveImg != null) $img_path = $haveImg;

#PETICIONES

if ($op == "index") $Vacancy->index();
if ($op == "indexByCompany") $Vacancy->indexByCompany($company_id);
if ($op == "indexJobBag") $Vacancy->indexJobBag();

elseif ($op == "show") $Vacancy->show($id);
elseif ($op == 'showSelect') $Vacancy->showSelect();

elseif ($op == "create") $Vacancy->create($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $publication_mode, $img_path, $created_at);

elseif ($op == "edit") $Vacancy->edit($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $publication_mode, $img_path, $updated_at, $id);

elseif ($op == "delete") $Vacancy->delete($deleted_at, $id);