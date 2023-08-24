<?php
include ('Application.php');
$Application = new Application();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_vacancy_id'])) { $vacancy_id = $_POST['input_vacancy_id']; }
if (isset($_POST['input_candidate_id'])) { $candidate_id = $_POST['input_candidate_id']; }
if (isset($_POST['input_status'])) { $status = $_POST['input_status']; }
if (isset($_POST['input_active'])) { $active = $_POST['input_active']; }

if (isset($_POST['user_id'])) { $user_id = $_POST['user_id']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Application->index();
if ($op == "myApplications") $Application->myApplications($user_id);
if ($op == "myApplicationsByCompany") $Application->myApplicationsByCompany($user_id);

elseif ($op == "show") $Application->show($id);
// elseif ($op == 'showSelect') $Application->showSelect();

elseif ($op == "apply") $Application->apply($vacancy_id, $user_id, $created_at);
elseif ($op == "checkAlreadyApplied") $Application->checkAlreadyApplied($vacancy_id, $user_id);
elseif ($op == "getVacanciesAppliedByCandidate") $Application->getVacanciesAppliedByCandidate($user_id);  // solo para candidatos

// elseif ($op == "edit") $Application->edit($vacancy_id, $id, $updated_at);
elseif ($op == "changeStatus") $Application->changeStatus($status, $updated_at, $id);

// elseif ($op == "delete") $Application->delete($deleted_at, $id);