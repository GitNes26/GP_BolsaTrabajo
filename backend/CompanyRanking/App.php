<?php
include ('CompanyRanking.php');
$CompanyRanking = new CompanyRanking();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_company_ranking'])) { $company_ranking = $_POST['input_company_ranking']; }
if (isset($_POST['input_description'])) { $description = $_POST['input_description']; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $CompanyRanking->index();

elseif ($op == "show") $CompanyRanking->show($id);
elseif ($op == 'showSelect') $CompanyRanking->showSelect();

elseif ($op == "create") $CompanyRanking->create($company_ranking, $description, $created_at);

elseif ($op == "edit") $CompanyRanking->edit($company_ranking, $description, $id, $updated_at);

elseif ($op == "delete") $CompanyRanking->delete($deleted_at, $id);