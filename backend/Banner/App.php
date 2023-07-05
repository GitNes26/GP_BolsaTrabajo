<?php
include ('Banner.php');
$Banner = new Banner();


if (isset($_POST['op'])) { $op = $_POST['op']; }

if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['input_date_init'])) { $date_init = $_POST['input_date_init']; }
if (isset($_POST['input_date_end'])) { $date_end = $_POST['input_date_end']; }
if (isset($_POST['input_link'])) { $link = $_POST['input_link']; }
if (isset($_POST['input_type_file'])) { $type_file = $_POST['input_type_file']; } else { $type_file = 'PNG'; }
if (isset($_POST['input_order_view'])) { $order_view = $_POST['input_order_view']; } else { $order_view = 0; }
if (isset($_POST['input_active'])) { $active = $_POST['input_active']; } else { $active  = "0"; }

if (isset($_POST['created_at'])) { $created_at = $_POST['created_at']; }
if (isset($_POST['updated_at'])) { $updated_at = $_POST['updated_at']; }
if (isset($_POST['deleted_at'])) { $deleted_at = $_POST['deleted_at']; }


if (isset($_POST['current_date'])) { $current_date = $_POST['current_date']; }
if (isset($_POST['haveImg'])) { $haveImg = $_POST['haveImg']; } else { $haveImg = null; }

if (isset($_FILES['input_file_path'])) {
   $path_files = "assets/img";
   $file = $_FILES['input_file_path'];
   $type_file = explode(".",$file["name"]);
   $type_file = strtoupper(trim(end($type_file)));
   // $type_file = "PNG";

   $dir = "../../$path_files/banners";
   $file_name = "$current_date.$type_file";

   if (!is_dir($dir)) {
      @mkdir($dir,0755,true);
      /**
       * 0755 => PERMISOS CRUD de los arvhicos
       * true => es para hacerlo recursivo,
       *         es decir todos los files de la ruta tienen
       *         los mismos permisos.
       */
   }

   // $file_name = explode(".",$file["name"])[0];
   // $permissions = 0777;
   // if (file_exists("$dir/$file_name.PNG")) {
   //    // Establecer permisos
   //    if (chmod("$dir/$file_name.PNG", $permissions)) {
   //       @unlink("$dir/$file_name.PNG");
   //    }
   //    $type_file = "JPG";
   // }
   // elseif (file_exists("$dir/$file_name.JPG")) {
   //    // Establecer permisos
   //    if (chmod("$dir/$file_name.JPG", $permissions)) {
   //       @unlink("$dir/$file_name.JPG");
   //    }
   //    $type_file = "PNG";
   // }

   $dest = "$dir/$file_name";

   if (move_uploaded_file($_FILES["input_file_path"]["tmp_name"], $dest)) {
      $file_path = "banners/$file_name";

   } else {
      $file_path = "";
      $type_file = "";
      print(error_get_last());
   }

} else {
  $file_path = "";
  $type_file = "";
}
if ($file_path == "" && $haveImg != null) $file_path = $haveImg;

if (isset($_POST['file_path'])) { $file_path = $_POST['file_path']; }



#PETICIONES

if ($op == "index") $Banner->index();

elseif ($op == "show") $Banner->show($id);
elseif ($op == 'fillBanners') $Banner->fillBanners($current_date);

elseif ($op == "create") $Banner->create($date_init, $date_end, $link, $file_path, $type_file, $order_view, $created_at);

elseif ($op == "edit") $Banner->edit($date_init, $date_end, $link, $file_path, $type_file, $updated_at, $id);
elseif ($op == "activeDesactive") $Banner->activeDesactive($active, $id);
elseif ($op == "editOrder") $Banner->editOrder($id, $order_view);

elseif ($op == "delete") $Banner->delete($id, $file_path);