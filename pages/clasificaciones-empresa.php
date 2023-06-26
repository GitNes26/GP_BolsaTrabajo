<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Clasificaciones de Empresa";
// $single = "Clasificación";
// $plural = "Clasificacións";

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
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de Clasificaciones</em>
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
         <div class="col-md-4">
            <!-- card Formulario-->
            <form id="form" enctype="multipart/form-data" class="card card-outline card-success shadow sticky-top">
               <div class="card-header">
                  <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-regular fa-circle-plus to-upper-case"></i>&nbsp; AGREGAR CLASIFICACIÓN</span>
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
                     <label for="input_company_ranking" class="form-label">Clasificación: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_company_ranking" name="input_company_ranking" data-input-name="AREA">
                  </div>
                  <div class="mb-3">
                     <label for="input_description" class="form-label">Descripción: <span class="obligatory"></span></label>
                     <textarea type="text" class="form-control counter" id="input_description" name="input_description" data-input-name="DESCRIPCIÓN" rows="5" data-limit="150" data-counter="counter_description"></textarea>
                     <div class="text-sm text-end text-muted" id="counter_description"></div>
                  </div>
                </div>
                
                <div class="card-footer">
                   <button type="reset" id="btn_cancel" class="btn btn-danger fw-bold float-start d-none">CANCELAR</button>
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
                           <th scope="col">Clasificación</th>
                           <th scope="col">Descripción</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr class="thead-dark">
                           <th scope="col">Clasificación</th>
                           <th scope="col">Descripción</th>
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