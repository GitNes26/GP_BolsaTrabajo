<?php
include ('Vacancy.php');
$Vacancy = new Vacancy();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_vacancy'])) { $vacancy = $_POST['input_vacancy']; }
if (isset($_POST['input_description'])) { $description = $_POST['input_description']; }
if (isset($_POST['input_company_id'])) { $company_id = $_POST['input_company_id']; }
if (isset($_POST['input_area_id'])) { $area_id = $_POST['input_area_id']; }
if (isset($_POST['input_schedules'])) { $schedules = $_POST['input_schedules']; }
if (isset($_POST['input_job_type'])) { $job_type = $_POST['input_job_type']; }
if (isset($_POST['input_min_salary'])) { $min_salary = $_POST['input_min_salary']; }
if (isset($_POST['input_max_salary'])) { $max_salary = $_POST['input_max_salary']; }
if (isset($_POST['input_more_info'])) { $more_info = $_POST['input_more_info']; }
if (isset($_POST['input_tags_ids'])) { $tags_ids = $_POST['input_tags_ids']; } else { $tags_ids = ""; } 
if (isset($_POST['input_publication_date'])) { $publication_date = $_POST['input_publication_date']; }
if (isset($_POST['input_expiration_date'])) { $expiration_date = $_POST['input_expiration_date']; } else { $expiration_date = null; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Vacancy->index();
if ($op == "indexByCompany") $Vacancy->indexByCompany($company_id);
if ($op == "indexJobBag") $Vacancy->indexJobBag();

elseif ($op == "show") $Vacancy->show($id);
elseif ($op == 'showSelect') $Vacancy->showSelect();

elseif ($op == "create") $Vacancy->create($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $created_at);

elseif ($op == "edit") $Vacancy->edit($vacancy, $description, $company_id, $area_id, $schedules, $job_type, $min_salary, $max_salary, $more_info, $tags_ids, $publication_date, $expiration_date, $updated_at, $id);

elseif ($op == "delete") $Vacancy->delete($deleted_at, $id);


