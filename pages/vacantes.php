<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Vacantes";
// $single = "Vacante";
// $plural = "Vacantes";

?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-solid fa-file-lines"></i>&nbsp; <?= $current_page ?>
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de Vacantes</em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; <?= $role ?? "" ?></a></li>
                  <li class="breadcrumb-item">Administración</li>
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
            <div class="card card-outline card-success">
               <div class="card-header">
                  <span class="modal-vacancy fw-bold h5" id="modalLabel"><i class="fa-regular fa-memo-circle-info"></i>&nbsp; FORMULARIO</span>
                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                     <i class="fas fa-minus"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">

                     <!-- FORMULARIO -->
                     <div class="col-md-6">
                        <!-- card Formulario-->
                        <form id="form" enctype="multipart/form-data" class="card card-outline card-suce shadow sticky-top">
                           <div class="card-header">
                              <span class="modal-vacancy fw-bold h5" id="modalLabel"><i class="fa-regular fa-circle-plus to-upper-case"></i>&nbsp; AGREGAR VACANTE</span>
                           </div>
                           <div class="card-body">
                              <input type="hidden" id="op" name="op" value="" class="not_validate">
                              <input type="hidden" id="id" name="id" value="" class="not_validate">
                              <!-- VACANTE -->
                              <div class="mb-3">
                                 <label for="input_vacancy" class="form-label">Vacante: <span class="obligatory"></span></label>
                                 <input type="text" class="form-control" id="input_vacancy" name="input_vacancy" data-input-name="VACANTE" data-limit="45">
                                 <div class="text-sm text-end text-muted" id="counter_vacancy"></div>
                              </div>
                              <!-- EMPRESA -->
                              <div class="mb-3">
                                 <label for="input_company_id" class="form-label">Empresa: <span class="obligatory"></span></label>
                                 <select class="select2 form-control" style="width:100%"
                                 id="input_company_id" name="input_company_id" data-input-name="EMPRESA">
                                 </select>
                              </div>

                              <hr>

                              <!-- AREA -->
                              <div class="mb-3">
                                 <label for="input_area_id" class="form-label">Área: <span class="obligatory"></span></label>
                                 <select class="select2 form-control" style="width:100%"
                                 id="input_area_id" name="input_area_id" data-input-name="ÁREA">
                                 </select>
                              </div>
                              <!-- DESCRIPCION DE VACANTE -->
                              <div class="mb-3">
                                 <label for="input_description" class="form-label">Descripción de la vacante: <span class="obligatory"></span></label>
                                 <textarea type="text" class="form-control" id="input_description" name="input_description" data-input-name="DESCRIPCIÓN" rows="5" data-limit="150"></textarea>
                                 <div class="text-sm text-end text-muted" id="counter_description"></div>
                              </div>
                              <!-- SUELDO -->
                              <div class="mb-3">
                                 <label for="input_min_salary" class="form-label">Sueldo: <span class="obligatory"></span></label>
                                 <div class="row">
                                    <div class="col">
                                       <input type="text" class="form-control" id="input_min_salary" name="input_min_salary" data-input-name="SUELDO MÍNIMO"
                                       placeholder="Mínimo">
                                    </div>
                                    <div class="col">
                                    <input type="text" class="form-control" id="input_max_salary" name="input_max_salary" data-input-name="SUELDO MÁXIMO"
                                    placeholder="Máximo">
                                    </div>
                                 </div>
                              </div>

                              <hr>
                              <!-- TIPO DE EMPLEO -->
                              <div class="mb-3">
                                 <label for="input_job_type">Tipo de empleo: <span class="obligatory"></span></label>
                                 <div class="btn-group ml-3" role="group">
                                    <input type="radio" class="btn-check not_validate" name="input_job_type" id="input_job_type_tc" autocomplete="off" checked>
                                    <label class="btn btn-outline-dark rounded-left" for="input_job_type_tc">Tiempo completo</label>

                                    <input type="radio" class="btn-check not_validate" name="input_job_type" id="input_job_type_mt" autocomplete="off">
                                    <label class="btn btn-outline-dark" for="input_job_type_mt" >Medio tiempo</label>

                                    <input type="radio" class="btn-check not_validate" name="input_job_type" id="input_job_type_p" autocomplete="off">
                                    <label class="btn btn-outline-dark" for="input_job_type_p" >Prácticas</label>
                                 </div>
                              </div>
                              <!-- HORARIO -->
                              <div class="mb-3">
                                 <label for="input_schedules" class="form-label">Horarios: <span class="obligatory"></span></label>
                                 <input type="text" class="form-control" id="input_schedules" name="input_schedules" data-input-name="VACANTE" placeholder="8 horas - Lunes a viernes">
                              </div>
                              <!-- MAS INFORMACION -->
                              <div class="mb-3">
                                 <label for="input_more_info" class="form-label">Más información: </label>
                                 <div class="summernote"></div>
                              </div>
                              <!-- TAGS -->
                              <div class="form-group" data-select2-id="29">
                                 <label for="input_tags_ids">TAGS de busqueda:</label>
                                 <select class="select2 select2-hidden-accessible not_validate" multiple="" data-placeholder="Selecciona etiquetas relacionadas a la vacante" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true" id="input_tags_ids" name="input_tags_ids" data-input-name="TAGS">
                                 </select>
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
                     
                     <!-- VISTA A DETALLE -->
                     <div class="col ">
                        <div id="detail_vacancy" enctype="multipart/form-data" class="card shadow-lg sticky-top card-detail">
                           <div class="card-header">
                              <span class="modal-vacancy fw-bold h5" id="modalLabel"><i class="fa-regular fa-memo-circle-info"></i>&nbsp; VISTA PREVIA DE LA VACANTE</span>
                           </div>
                           <div class="card-body text-start scroll-y">
                              <input type="hidden" id="op" name="op" value="" class="not_validate">
                              <input type="hidden" id="id" name="id" value="" class="not_validate">
                              <p class="h5 fw-bolder" id="output_vacancy">Vacante</p>
                              <p class="mb-3">
                                 <span id="output_company">Empresa</span><br>
                                 <span id="output_location">Ciudad, Estado</span>
                              </p>
                              <p class="" id="output_company_description">Descripción de la empresa...</p>

                              <hr>

                              <!-- DETALLES DEL EMPELO -->
                              <p class="h6 fw-bolder">Detalles del empleo</p>
                              <p class="" id="output_area">Área</p>
                              <p class="" id="output_description">Descripción de la vacante...</p>
                              <div class="mb-2">
                                 <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; 
                                 <span class="fw-bolder">Sueldo:&nbsp;</span> 
                                 <span id="output_min_salary">$0</span> &nbsp;a&nbsp; 
                                 <span id="output_max_salary">$0</span>
                              </div>
                              <div class="mb-2">
                                 <i class="fa-solid fa-briefcase"></i>&nbsp; 
                                 <span class="fw-bolder">Tipo de empleo:&nbsp;</span> 
                                 <span id="output_job_type">Tiempo completo</span>
                              </div>
                              <div class="mb-2">
                                 <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; 
                                 <span class="fw-bolder">Horario:&nbsp;</span> 
                                 <span id="output_schedules">8 horas</span> &nbsp;-&nbsp;
                                 <span id="output_schedules">Lunes a viernes</span>
                              </div>
                              <hr>
                              <p class="">
                                 <span class="fw-bolder">Requisitos</span>
                                 <ul class="" id="output_requirements">
                                    <li>Requerimiento 1</li>
                                    <li>Requerimiento 1</li>
                                    <li>Requerimiento 1</li>
                                 </ul>
                              </p>
                              <p class="">
                                 <span class="fw-bolder">Expriencia necesaria</span>
                                 <ul class="" id="output_necessary_experience">
                                    <li>Experiencias 1</li>
                                    <li>Experiencias 1</li>
                                    <li>Experiencias 1</li>
                                 </ul>
                              </p>
                              <!-- ./ DETALLES DEL EMPELO -->

                              <hr>

                              <p class="">
                                 <span class="fw-bolder">Beneficios</span>
                                 <ul class="" id="output_benefits">
                                    <li>Beneficio 1</li>
                                    <li>Beneficio 1</li>
                                    <li>Beneficio 1</li>
                                 </ul>
                              </p>
                           </div>
                           <div class="card-footer">
                              <div class="d-grid gap-2">
                                 <button type="reset" id="btn_send" class="btn btn-outline-success fw-bold grid"><i class="fa-sharp fa-solid fa-paper-plane-top"></i>&nbsp; POSTULARSE
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
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
                           <th scope="col">Vacante</th>
                           <!-- <th scope="col">Sueldo</th> -->
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr class="thead-dark">
                           <th scope="col">Vacante</th>
                           <!-- <th scope="col">Sueldo</th> -->
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