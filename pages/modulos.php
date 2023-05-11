<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Módulos";

?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-solid fa-kaaba"></i>&nbsp; <?php echo $current_page ?>
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de menús</em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; <?php echo $role ?? "" ?></a></li>
                  <li class="breadcrumb-item">Administración</li>
                  <li class="breadcrumb-item active"><?php echo $current_page ?></li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">

      <div class="row">
         <div class="col-md-4">
            <!-- card Formulario-->
            <form id="form" enctype="multipart/form-data" class="card card-outline card-dark shadow sticky-top">
               <div class="card-header">
                  <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-light fa-circle-info"></i>&nbsp; INFO DEL MÓDULO</h5>
               </div>
               <div class="card-body">
                  <input type="hidden" id="op" name="op" value="" class="not_validate">
                  <input type="hidden" id="id" name="id" value='' class="not_validate">
                  <div class="mb-3">
                     <label for="input_menu" class="form-label">Nombre del menú: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_menu" name="input_menu" data-nombre-campo="MODULE NAME">
                  </div>
                  <div class="mb-3">
                     <label for="input_tag" class="form-label">Tag: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_tag" name="input_tag" data-nombre-campo="TAG">
                  </div>
                  <div class="mb-3">
                     <label for="input_belongs_to" class="form-label">Pertence a: <span class="obligatory"></span></label>
                     <select class="select2 form-control" style="width:100%" id="input_belongs_to" name="input_belongs_to" data-nombre-campo="PERTENECE A">
                        <option value="-1">Selecciona una opción...</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="input_file_path" class="form-label">Archivo (php): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_file_path" name="input_file_path" data-nombre-campo="ARCHIVO">
                  </div>
                  <div class="mb-3">
                     <label for="input_icon" class="form-label">Ícono:</label>
                     <input type="text" class="form-control not_validate" id="input_icon" name="input_icon" data-nombre-campo="ICON">
                  </div>
                  <!-- <div class="mb-3">
                     <label for="input_order" class="form-label">Orden: <span class="obligatory"></span></label>
                     <input type="number" step="1" class="form-control" id="input_order" name="input_order" data-nombre-campo="ORDEN">
                  </div> -->
                  <div class="form-group">
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="input_active" name="input_active" checked>
                        <label class="custom-control-label" id="label_modulo_habilitado" for="input_active">Activo</label>
                     </div>
                  </div>
                </div>
                <div class="card-footer">
                   <button type="reset" id="btn_cancel" class="btn btn-danger fw-bold float-start">CANCELAR</button>
                   <button type="reset" id="btn_reset" class="btn btn-secondary float-end ml-2">LIMPIAR</button>
                  <?php if ($permission_write ?? false): ?>
                     <button type="submit" id="btn_submit" class="btn btn-success fw-bold float-end">AGREGAR</button>
                  <?php endif ?>

               </div>
            </form>
            <!-- /.card -->
         </div>
         <div class="col-md-8">
            <!-- card Tabla-->
            <div class="card card-outline card-dark shadow">
               <div class="card-body">
                  <!-- tabla -->
                  <div class="table-responsive">
                  <table id="table" class="table table-hover text-center" style="width:100%">
                     <thead class="thead-dark">
                        <tr>
                           <th scope="col">Ícono</th>
                           <th scope="col">Módulo</th>
                           <th scope="col">Info</th>
                           <th scope="col">Active</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr class="thead-dark">
                           <th scope="col">Ícono</th>
                           <th scope="col">Módulp</th>
                           <th scope="col">Info</th>
                           <th scope="col">Active</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </tfoot>
                  </table>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
      </div>

   </section>
   <!-- /.content -->

   <!-- Modal Usuario -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-user-plus"></i>&nbsp; REGISTRAR USUARIO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="op" name="op" value="" class="not_validate">
               <input type="hidden" id="id" name="id" value='' class="not_validate">
               <div class="row">
                  <div class="mb-3 col-md-6">
                     <label for="input_name" class="form-label">Nombre(s): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_name" name="input_name" data-input-name="NOMBRES">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label for="input_last_name" class="form-label">Apellido(s): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
                  </div>
               </div>
               <div class="row">
                  <div class="mb-3 col-md-6">
                     <label for="input_cellphone" class="form-label">Celular: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR">
                  </div>
                  <div class="mb-3 col-md-6">
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
                     <option selected value="-1">Selecciona una opción....</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="btn_submit" class="btn btn-success fw-bold">AGREGAR</button>
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
<script src="<?php echo($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>