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
                  <i class="fa-solid fa-kaaba"></i>&nbsp; <?= $current_page ?>
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de menús</em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; <?= $role ?? "" ?></a></li>
                  <!-- <li class="breadcrumb-item">Administración</li> -->
                  <li class="breadcrumb-item active"><?= $current_page ?></li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">

      <div class="row">
         <div class="col-md-3">
            <!-- card Formulario-->
            <form id="form" enctype="multipart/form-data" class="card card-outline card-success shadow sticky-top">
               <div class="card-header">
                  <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-light fa-circle-info"></i>&nbsp; INFO DEL MÓDULO</span>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                     <i class="fas fa-minus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <input type="hidden" id="op" name="op" value="" class="not_validate">
                  <input type="hidden" id="id" name="id" value="" class="not_validate">
                  <div class="mb-3">
                     <label for="input_menu" class="form-label">Nombre del menú: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_menu" name="input_menu" data-input-name="NOMBRE DEL MÓDULO">
                  </div>
                  <div class="mb-3">
                     <label for="input_tag" class="form-label">Tag: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_tag" name="input_tag" data-input-name="TAG">
                  </div>
                  <div class="mb-3">
                     <label for="input_belongs_to" class="form-label">Pertence a: <span class="obligatory"></span></label>
                     <select class="select2 form-control" style="width:100%" id="input_belongs_to" name="input_belongs_to" data-input-name="PERTENECE A">
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="input_file_path" class="form-label">Archivo (php): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_file_path" name="input_file_path" data-input-name="ARCHIVO">
                  </div>
                  <div class="mb-3">
                     <label for="input_icon" class="form-label">Ícono:</label>
                     <input type="text" class="form-control not_validate" id="input_icon" name="input_icon" data-input-name="ÍCONO">
                  </div>
                  <!-- <div class="mb-3">
                     <label for="input_order" class="form-label">Orden: <span class="obligatory"></span></label>
                     <input type="number" step="1" class="form-control" id="input_order" name="input_order" data-input-name="ORDEN">
                  </div> -->
                  <div class="form-group">
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="input_active" name="input_active" checked>
                        <label class="custom-control-label" id="label_module_enable" for="input_active">Activo</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="input_show_counter" name="input_show_counter" checked>
                        <label class="custom-control-label" id="label_module_counter" for="input_show_counter" title="Mostrará el indicador de cantidades en el menú lateral de cada página">Mostrar contador</label>
                     </div>
                  </div>
                </div>
                <div class="card-footer">
                   <button type="reset" id="btn_cancel" class="btn btn-danger fw-bold float-start">CANCELAR</button>
                   <button type="reset" id="btn_reset" class="btn btn-secondary float-end ml-2 d-none">LIMPIAR</button>
                  <?php if ($permission_write ?? false): ?>
                     <button type="submit" id="btn_submit" class="btn btn-success fw-bold float-end">AGREGAR</button>
                  <?php endif ?>

               </div>
            </form>
            <!-- /.card -->
         </div>
         <div class="col">
            <!-- card Tabla-->
            <div class="card card-outline card-success shadow">
               <div class="card-body">
                  <!-- tabla -->
                  <div class="table-responsive">
                  <table id="table" class="table table-hover text-center" style="width:100%">
                     <thead class="thead-dark">
                        <tr>
                           <th scope="col">Ícono</th>
                           <th scope="col">Módulo</th>
                           <th scope="col">Info</th>
                           <th scope="col">Activo</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr class="thead-dark">
                           <th scope="col">Ícono</th>
                           <th scope="col">Módulo</th>
                           <th scope="col">Info</th>
                           <th scope="col">Activo</th>
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

</div>
<!-- /.content-wrapper -->


</div>
<!-- ./wrapper (este se abre en el Template-header) -->

<?php
include "../templates/footer.php";
?>
<script src="<?=($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>