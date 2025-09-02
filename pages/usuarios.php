<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Usuarios";

?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-solid fa-users"></i>&nbsp; <?php echo $current_page ?>
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de usuarios</em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; <?php echo $role ?? "" ?></a></li>
                  <!-- <li class="breadcrumb-item">Administración</li> -->
                  <li class="breadcrumb-item active"><?php echo $current_page ?></li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">

      <!-- card -->
      <div class="card card-outline card-dark shadow">
         <?php if ($permission_write ?? false): ?>
            <div class="container-fluid mt-2">
               <button id="btn_modal_form" class="float-end btn btn-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-circle-plus"></i>&nbsp; AGREGAR USUARIO</button>
            </div>
         <?php endif ?>
         <div class="card-body">
            <!-- tabla -->
            <div class="table-responsive">
               <table id="table" class="table table-hover text-center" style="width:100%">
                  <thead class="thead-dark">
                     <tr>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Miembro desde</th>
                        <th scope="col">Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                     <tr class="thead-dark">
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Miembro desde</th>
                        <th>Acciones</th>
                     </tr>
                  </tfoot>

               </table>
            </div>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->

   </section>
   <!-- /.content -->

   <!-- Modal -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-user-plus"></i>&nbsp; REGISTRAR USUARIO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="op" name="op" value="" class="not_validate">
               <input type="hidden" id="id" name="id" value='' class="not_validate">
               <!-- <div class="row">
                  <div class="mb-3 col-md-6">
                     <label for="input_name" class="form-label">Nombre(s): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_name" name="input_name" data-input-name="NOMBRES">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label for="input_last_name" class="form-label">Apellido(s): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
                  </div>
               </div> -->
               <div class="row">
                  <!-- <div class="mb-3 col-md-6">
                     <label for="input_cellphone" class="form-label">Celular: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR">
                  </div> -->
                  <div class="mb-3 col">
                     <label for="input_email" class="form-label">Correo: <span class="obligatory"></span></label>
                     <input type="email" class="form-control" id="input_email" name="input_email" data-input-name="CORREO">
                  </div>
               </div>
               <div class="mb-3 row" id="div_password">
                  <div class="col">
                     <label for="input_password" class="form-label">Contraseña: <span class="obligatory"></span></label>
                     <div class="input-icon">
                        <input type="password" class="form-control" id="input_password" name="input_password" data-input-name="CONTRASEÑA">
                        <i class="fa-duotone fa-eye-slash eye_icon" data-input="input_password"></i>
                     </div>
                  </div>
                  <div class="col">
                     <label for="input_confirm_password" class="form-label">Confirmar Contraseña: <span class="obligatory"></span></label>
                     <div class="input-icon">
                        <input type="password" class="form-control" id="input_confirm_password" name="input_confirm_password" data-input-name="CONFIRMAR CONTRASEÑA">
                        <i class="fa-duotone fa-eye-slash eye_icon" data-input="input_confirm_password"></i>
                     </div>
                     <span class="fst-italic" id="feedback_password"></span>
                  </div>
               </div>
               <div class="mb-3" id="div_new_password">
                  <label for="input_new_password" class="form-label">Nueva Contraseña:</label>
                  <div class="input-icon">
                     <input type="password" class="form-control" id="input_new_password" name="input_new_password">
                     <i class="fa-duotone fa-eye-slash eye_icon" data-input="input_new_password"></i>
                  </div>
                  <span class="custom-control custom-switch">
                     <input type="checkbox" class="custom-control-input" id="switch_new_password" data-input-name="NUEVA CONTRASEÑA">
                     <label class="custom-control-label text-sm" for="switch_new_password">Habilitar cambio de contraseña</label>
                  </span>
               </div>
               <div class="mb-3">
                  <label for="input_role_id" class="form-label">Rol: <span class="obligatory"></span></label>
                  <select class="select2 form-control" style="width:100%" aria-label="Default select example" id="input_role_id" name="input_role_id" data-input-name="ROL">
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="btn_submit" class="btn btn-dark fw-bold">AGREGAR</button>
               <button type="reset" id="btn_reset" class="btn btn-secondary">LIMPIAR</button>
            </div>
         </form>
      </div>
   </div>

</div>
<!-- /.content-wrapper -->


</div>
<!-- ./wrapper (este se abre en el Template-header) -->

<?php
include "../templates/footer.php";
?>
<script src="<?php echo ($SCRIPTS_PATH) ?>/<?= substr($path, 0, -4) ?>.js"></script>