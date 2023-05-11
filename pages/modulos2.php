<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$pagina_acutal = "Módulos";
?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-solid fa-kaaba"></i>&nbsp; <?php echo $pagina_acutal ?>
                  <!-- <em class="fw-ligth text-muted lead text-sm">| </em> -->
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; Admin</a></li>
                  <li class="breadcrumb-item">Administración</li>
                  <li class="breadcrumb-item active"><?php echo $pagina_acutal ?></li>
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
            <form id="formulario" enctype="multipart/form-data" class="card card-outline card-dark shadow">
               <div class="card-header">
                  <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-kaaba"></i>&nbsp; ADD MODULE</h5>
               </div>
               <div class="card-body">
                  <input type="hidden" id="accion" name="accion" value="" class="excluir_validacion">
                  <input type="hidden" id="id" name="id" value='' class="excluir_validacion">
                  <div class="mb-3">
                     <label for="input_descripcion" class="form-label">Module Name: <span class="span_campo_obligatorio"></span></label>
                     <input type="text" class="form-control" id="input_descripcion" name="input_descripcion" data-nombre-campo="MODULE NAME">
                  </div>
                  <div class="mb-3">
                     <label for="input_tag" class="form-label">Tag: <span class="span_campo_obligatorio"></span></label>
                     <input type="text" class="form-control" id="input_tag" name="input_tag" data-nombre-campo="TAG">
                  </div>
                  <div class="mb-3">
                     <label for="input_id_padre" class="form-label">Belongs To: <span class="span_campo_obligatorio"></span></label>
                     <select class="select2 form-control" style="width:100%" id="input_id_padre" name="input_id_padre" data-nombre-campo="YOUR FATHER">
                        <option value="-1">Selecciona una opción...</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="input_path_archivo" class="form-label">File Path: <span class="span_campo_obligatorio"></span></label>
                     <input type="text" class="form-control" id="input_path_archivo" name="input_path_archivo" data-nombre-campo="FILE PATH">
                  </div>
                  <div class="mb-3">
                     <label for="input_icono" class="form-label">Icon:</label>
                     <input type="text" class="form-control excluir_validacion" id="input_icono" name="input_icono" data-nombre-campo="ICON">
                  </div>
                  <div class="mb-3">
                     <label for="input_orden" class="form-label">Order: <span class="span_campo_obligatorio"></span></label>
                     <input type="number" step="1" class="form-control" id="input_orden" name="input_orden" data-nombre-campo="ORDER">
                  </div>
                  <div class="form-group">
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="input_habilitado" name="input_habilitado" checked>
                        <label class="custom-control-label" id="label_modulo_habilitado" for="input_habilitado">Enabled</label>
                     </div>
                  </div>
                </div>
                <div class="card-footer">
                   <button type="reset" id="btn_cancelar_formulario" class="btn btn-danger fw-bold float-start">CANCEL</button>
                   <button type="reset" id="btn_reset_formulario" class="btn btn-secondary float-end ml-2">CLEAR</button>
                   <button type="submit" id="btn_enviar_formulario" class="btn btn-success fw-bold float-end">ADD</button>
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
                  <table id="tabla_modulos" class="table table-hover text-center" style="width:100%">
                     <thead class="thead-dark">
                        <tr>
                           <th>Icon</th>
                           <th>Module</th>
                           <th>Info</th>
                           <th>Active</th>
                           <th>Edit / Enabled-Disabled</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr class="thead-dark">
                           <th>Icon</th>
                           <th>Module</th>
                           <th>Info</th>
                           <th>Active</th>
                           <th>Edit / Enabled-Disabled</th>
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
include "../Templates/footer.php";
?>
<script src="<?php echo($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>