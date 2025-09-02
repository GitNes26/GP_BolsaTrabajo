<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Banners";

?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-duotone fa-bullhorn"></i>&nbsp; <?php echo $current_page ?>
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de Banners</em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo $ADMIN_PATH ?>"><i
                           class="fa-solid fa-house"></i>&nbsp; <?php echo $role ?? "" ?></a></li>
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
               <!-- <i class="text-muted h6 text-sm">Medidas: <b>1400px</b> largo &nbsp; <i class="fas fa-times"></i> &nbsp; <b>132px</b> alto</i> -->
               <i class="text-muted h6 text-sm">Medidas: <b>350px-400px</b> largo &nbsp; <i class="fas fa-times"></i>
                  &nbsp; <b>340px</b> alto</i>
               <button id="btn_modal_form" class="float-end btn btn-dark fw-bold" data-bs-toggle="modal"
                  data-bs-target="#modal"><i class="fa-solid fa-circle-plus"></i>&nbsp; AGREGAR BANNER</button>
            </div>
         <?php endif ?>
         <div class="card-body">
            <!-- tabla -->
            <div class="table-responsive">
               <table id="table" class="table table-hover text-center" style="width:100%">
                  <thead class="thead-dark">
                     <tr>
                        <th scope="col">Fecha inicial</th>
                        <th scope="col">Fecha final</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Orden</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                     <tr class="thead-dark">
                        <th scope="col">Fecha inicial</th>
                        <th scope="col">Fecha final</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Orden</th>
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

   </section>
   <!-- /.content -->

   <!-- Modal -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
      data-bs-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-duotone fa-bullhorn"></i></i>&nbsp;
                  REGISTRAR BANNER</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="op" name="op" value="" class="not_validate">
               <input type="hidden" id="id" name="id" value='' class="not_validate">

               <div class="row">
                  <div class="mb-3 col">
                     <label for="input_date_init" class="form-label">Fecha inicial: <span
                           class="obligatory"></span></label>
                     <input class="form-control" type="date" id="input_date_init" name="input_date_init"
                        data-input-name="FECHA DE INICIO">
                  </div>
                  <div class="mb-3 col">
                     <label for="input_date_end" class="form-label">Fecha final: <span
                           class="obligatory"></span></label>
                     <input class="form-control" type="date" id="input_date_end" name="input_date_end"
                        data-input-name="FECHA FINAL">
                  </div>
               </div>
               <div class="mb-3 col">
                  <label for="input_link" class="form-label">Enlace:</span></label>
                  <input class="form-control not_validate" type="text" id="input_link" name="input_link"
                     data-input-name="ENLACE">
               </div>
               <!-- DIV CARGAR IMAGEN -->
               <div class="mb-3">
                  <label for="input_file_path" class="form-label">Cargar banner: <span
                        class="obligatory"></span></label>
                  <input class="form-control" type="file" id="input_file_path" name="input_file_path"
                     data-input-name="IMAGEN" accept="image/*">
                  <!-- <div class="form-text">Subir archivo con un peso máximo de <b id="peso_archivo"></b><b>MB</b>.</div> -->
                  <!-- DIV IMAGEN CARGADO -->
                  <div class="text-center">
                     <label for="preview_file" class="form-label">Banner cargado:</label><br>
                     <img src="../assets/img/cargar_imagen.png" controls preview="true" class="rounded-lg img-fluid"
                        id="preview_file" height="250px"></img>
                     <!-- <button type="button" id="btn_quit_file" class="btn btn-default btn-block fw-bolder">QUITAR IMAGEN</button> -->
                  </div>
               </div>
               <!-- <div class="row g-3 align-items-center">
                  <div class="col-auto">
                     <label for="input_active" class="col-form-label h4">STATUS:</label>
                  </div>
                  <div class="col-auto mx-2">
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="input_active" name="input_active" value="1" data-activo="1" checked>
                        <label class="form-check-label fst-italic" id="label_input_active" for="input_active">Activo</label>
                     </div>
                  </div>
               </div> -->
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