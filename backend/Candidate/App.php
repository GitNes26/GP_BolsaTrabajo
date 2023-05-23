<?php
include ('Candidate.php');
$Candidate = new Candidate();


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

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


#PETICIONES

if ($op == "index") $Candidate->index();

elseif ($op == "show") $Candidate->show($id);
elseif ($op == 'showSelect') $Candidate->showSelect();

elseif ($op == "create") $Candidate->create($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id);

elseif ($op == "edit") $Candidate->edit($company, $description, $logo_path, $contact_name, $contact_phone, $contact_email, $state, $municipality, $business_line_id, $company_ranking_id, $user_id, $id, $updated_at);

elseif ($op == "delete") $Candidate->delete($deleted_at, $id);