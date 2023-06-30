<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Solicitudes";
// $single = "Solicitud";
// $plural = "Solicitudes";

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
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de Solicitudes</em>
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
         <div class="col">
            <!-- card Tabla-->
            <div class="card card-outline card-success shadow">
               <div class="card-body">
                  <!-- tabla -->
                  <div class="table-responsive">
                  <table id="table" class="table table-hover text-center" style="width:100%">
                     <thead class="thead-dark">
                        <tr>
                           <th scope="col">Candidato</th>
                           <th scope="col">Vacante</th>
                           <th scope="col">Info</th>
                           <th scope="col">Flujo</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr class="thead-dark">
                           <th scope="col">Candidato</th>
                           <th scope="col">Vacante</th>
                           <th scope="col">Info</th>
                           <th scope="col">Flujo</th>
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

   <!-- Modal -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-user-plus"></i>&nbsp; REGISTRAR USUARIO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start scroll-y">
               <input type="hidden" name="id" value="" class="id not_validate">
               <p class="h5 fw-bolder output_vacancy">Vacante</p>
               <p class="mb-3 output_info_company">
                  <span>Empresa</span><br>
                  <span>Ciudad, Estado</span><br><br>
                  <span class="">Descripción de la empresa...</span>
               </p>

               <hr>

               <!-- DETALLES DEL EMPELO -->
               <p class="h6 fw-bolder">Detalles del empleo</p>
               <p class="output_area">Área</p>
               <p class="output_description">Descripción de la vacante...</p>
               <div class="mb-2">
                  <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; 
                  <span class="fw-bolder">Sueldo <i>(menusal)</i>:&nbsp;</span> 
                  <span class="output_min_salary">$0</span> &nbsp;a&nbsp; 
                  <span class="output_max_salary">$0</span>
               </div>
               <div class="mb-2">
                  <i class="fa-solid fa-briefcase"></i>&nbsp; 
                  <span class="fw-bolder">Tipo de empleo:&nbsp;</span> 
                  <span class="output_job_type">...</span>
               </div>
               <div class="mb-2">
                  <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; 
                  <span class="fw-bolder">Horario:&nbsp;</span> 
                  <span class="output_schedules">...</span>
               </div>

               <hr>

               <!-- MAS INFO -->
               <div class="output_more_info"></div>
            </div>
            <div class="modal-footer">
               <button type="button" onclick="cancel(this)" class="btn btn-danger fw-bold btn_cancel">CANCELAR SOLICITUD</button>
            </div>
         </form>
      </div>
   </div>

   <!-- Modal Candidato -->
   <div class="modal fade" id="candidate_modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold"><i class="fa-solid fa-user-tie"></i>&nbsp; INFORMACIÓN DEL POSTULADO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start scroll-y">
               <input type="hidden" name="id" value="" class="id not_validate">
               <p class="h5 fw-bolder output_vacancy">Vacante</p>
               <p class="mb-3 output_info_company">
                  <span>Empresa</span><br>
                  <span>Ciudad, Estado</span><br><br>
                  <span class="">Descripción de la empresa...</span>
               </p>

               <hr>

               <!-- DETALLES DEL EMPELO -->
               <p class="h6 fw-bolder">Detalles del empleo</p>
               <p class="output_area">Área</p>
               <p class="output_description">Descripción de la vacante...</p>
               <div class="mb-2">
                  <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; 
                  <span class="fw-bolder">Sueldo <i>(menusal)</i>:&nbsp;</span> 
                  <span class="output_min_salary">$0</span> &nbsp;a&nbsp; 
                  <span class="output_max_salary">$0</span>
               </div>
               <div class="mb-2">
                  <i class="fa-solid fa-briefcase"></i>&nbsp; 
                  <span class="fw-bolder">Tipo de empleo:&nbsp;</span> 
                  <span class="output_job_type">...</span>
               </div>
               <div class="mb-2">
                  <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; 
                  <span class="fw-bolder">Horario:&nbsp;</span> 
                  <span class="output_schedules">...</span>
               </div>

               <hr>

               <!-- MAS INFO -->
               <div class="output_more_info"></div>
            </div>
            <div class="modal-footer">
               <button type="button" onclick="cancel(this)" class="btn btn-danger fw-bold btn_cancel">CANCELAR SOLICITUD</button>
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
<script src="<?=($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>