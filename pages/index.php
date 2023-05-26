<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";



$pagina_acutal = "Bolsa de Trabajo";
?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
               <i class="fa-regular fa-sack-dollar"></i>&nbsp; <?= $pagina_acutal ?>
                  <em class="fw-ligth text-muted lead text-sm"></em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; Inicio</a></li>
                  <!-- <li class="breadcrumb-item">Catálogos</li> -->
                  <li class="breadcrumb-item active"><?= $pagina_acutal ?></li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content text-center">

      <div class="content">
         <div class="row">
            <!-- FILTROS -->
            <div class="col-md-4 sticky-top">
               <form id="form_filter"class="card card-outline card-success shadow sticky-top">
                  <div class="card-header">
                     <div class="pb-1">
                        <label for="input_filter_search" class="form-label">Buscador General</label>
                        <input type="search" class="form-control not_validate" id="input_filter_search" name="input_filter_search" data-input-name="BUSCADOR GENERAL" placeholder="Puesto | Empresa">
                     </div>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Filtros de busqueda" id="btn_show_filters">
                        <i class="fas fa-minus"></i>
                        <i class="fa-solid fa-filter-list"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body text-start">
                     <input type="hidden" id="filter_op" name="filter_op" value="" class="not_validate">
                     <div class="mb-3">
                        <label for="input_filter_min_salary" class="form-label">Sueldo deseado:</label>
                        <div class="row">
                           <div class="col">
                              <input type="text" class="form-control" id="input_filter_min_salary" name="input_filter_min_salary" data-input-name="NOMBRE DEL MÓDULO"
                              placeholder="Mínimo">
                           </div>
                           <div class="col">
                           <input type="text" class="form-control" id="input_filter_max_salary" name="input_filter_max_salary" data-input-name="NOMBRE DEL MÓDULO"
                           placeholder="Máximo">
                           </div>
                        </div>
                     </div>
                     <div class="mb-3">
                        <label for="input_filter_business_line_id" class="form-label">Giro:</label>
                        <select class="select2 form-control" style="width:100%"
                        id="input_filter_business_line_id" name="input_filter_business_line_id" data-input-name="GIRO">
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="input_filter_area_id" class="form-label">Área:</label>
                        <select class="select2 form-control" style="width:100%"
                        id="input_filter_area_id" name="input_filter_area_id" data-input-name="GIRO">
                        </select>
                     </div>
                     <div class="form-group" data-select2-id="29">
                        <label for="input_filter_interest_tags_ids">Intereses de busqueda:</label>
                        <select class="select2 select2-hidden-accessible not_validate" multiple="" data-placeholder="Selecciona etiquetas con tús intereses" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true" id="input_filter_interest_tags_ids" name="input_filter_interest_tags_ids" data-input-name="INTERESES">
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="input_state" class="form-label">Estado:</label>
                        <select class="select2 form-control" style="width:100%; line-height:10px"
                        id="input_state" name="input_state"
                        data-input-name="ESTADO">
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="input_municipality" class="form-label">Municipio:</label>
                        <select class="select2 form-control" style="width:100%; line-height:20px"
                        id="input_municipality" name="input_municipality"
                        data-input-name="MUNICIPIO" disabled>
                        </select>
                     </div>
                     
                     <!-- <div class="mb-3">
                        <label for="">Sueldo estimado: (mensual)</label>
                        <span class="irs irs--flat js-irs-0"><span class="irs"><span class="irs-line" tabindex="0"></span><span class="irs-min" style="visibility: visible;">$0</span><span class="irs-max" style="visibility: visible;">$5 000</span><span class="irs-from" style="visibility: visible; left: 22.9348%;">$1 309</span><span class="irs-to" style="visibility: visible; left: 65.4715%;">$3 505</span><span class="irs-single" style="visibility: hidden; left: 39.6617%;">$1 309 — $3 505</span></span><span class="irs-grid"></span><span class="irs-bar" style="left: 26.9302%; width: 42.5367%;"></span><span class="irs-shadow shadow-from" style="display: none;"></span><span class="irs-shadow shadow-to" style="display: none;"></span><span class="irs-handle from" style="left: 25.3554%;"><i></i><i></i><i></i></span><span class="irs-handle to type_last" style="left: 67.8921%;"><i></i><i></i><i></i></span></span><input id="range_1" type="text" name="range_1" value="" class="irs-hidden-input" tabindex="-1" readonly="">
                     </div> -->


                  </div>
                  <div class="card-footer">
                     <div class="fw-bolder mb-2">15 empleos encontrados para ti</div>
                     <button type="submit" id="btn_submit"
                     class="btn btn-outline-success btn-block fw-bold text-center">
                     <i class="fa-regular fa-magnifying-glass"></i>&nbsp;&nbsp;BUSCAR
                  </button>
                  <button type="reset" id="btn_reset"
                     class="btn btn-outline-secondary btn-block fw-bold text-center">
                     <i class="fa-solid fa-ban"></i>&nbsp;&nbsp;LIMPIAR
                  </button>
                  </div>
               </form>
            </div>
            <!-- LISTA DE EMPELOS -->
            <div class="col-md-4">
               <?php for ($i=0; $i < 8; $i++): ?>
                  <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm pointer-sm card_vacancy">
                  <div class="card-header">
                     <span class="card-title fw-bolder">Vacante</span>
                     <div class="card-tools">
                        <span title="vacantes disponibles" class="badge bg-success">3</span>
                        <button type="button" class="btn btn-tool" title="Favoritos" data-widget="chat-pane-toggle">
                           <i class="fa-solid fa-star"></i>
                        </button>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body pb-2">
                     <div class="direct-chat-infos clearfix px-2">
                        <span class="direct-chat-timestamp float-right">Publicado el: </span>
                        <span class="float-left">Empresa</span>
                        <br>
                        <span class="fst-italic float-left">Ciudad, Estado</span>
                     </div>
                     <p>Area de aplicacion: Informatica</p>
                     <span class="badge bg-success">
                        <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; <span id="output_min_salary">$10,000</span> a <span id="output_max_salary">$12,000</span>
                     </span>
                     <span class="badge bg-dark">
                        <i class="fa-solid fa-briefcase"></i>&nbsp; <span id="output_job_type">Tiempo completo</span>
                     </span>
                     <span class="badge bg-primary">
                        <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; <span id="output_days">Lunes a viernes</span>
                     </span>
                     <span class="badge bg-primary">
                        <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; <span id="output_schedules">8 horas</span>
                     </span> 
                  </div>
               </div>
               <?php endfor; ?>
            </div>
            <!-- VISTA A DETALLE -->
            <div class="col d-none d-sm-none d-md-block">
               <form id="form_vacancy" enctype="multipart/form-data" class="card shadow-lg sticky-top card-detail">
                  <div class="card-header">
                     <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-regular fa-memo-circle-info"></i>&nbsp; DETALLE DE LA VACANTE</span>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Favoritos" data-widget="chat-pane-toggle">
                           <i class="fa-solid fa-star"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body text-start scroll-y">
                     <input type="hidden" id="op" name="op" value="" class="not_validate">
                     <input type="hidden" id="id" name="id" value="" class="not_validate">
                     <p class="h5 fw-bolder" id="output_detail_title">Vacante</p>
                     <p class="mb-3">
                        <span id="output_detail_company">Empresa</span><br>
                        <span id="output_detail_location">Ciudad, Estado</span>
                     </p>
                     <p class="" id="output_detail_company_description">Descripción de la empresa...</p>

                     <hr>

                     <!-- DETALLES DEL EMPELO -->
                     <p class="h6 fw-bolder">Detalles del empleo</p>
                     <p class="" id="output_detail_area">Área</p>
                     <p class="" id="output_detail_description">Descripción...</p>
                     <div class="mb-2">
                        <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; 
                        <span class="fw-bolder">Sueldo:&nbsp;</span> 
                        <span id="output_detail_min_salary">$0</span> &nbsp;a&nbsp; 
                        <span id="output_detail_max_salary">$0</span>
                     </div>
                     <div class="mb-2">
                        <i class="fa-solid fa-briefcase"></i>&nbsp; 
                        <span class="fw-bolder">Tipo de empleo:&nbsp;</span> 
                        <span id="output_detail_job_type">Tiempo completo</span>
                     </div>
                     <div class="mb-2">
                        <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; 
                        <span class="fw-bolder">Horario:&nbsp;</span> 
                        <span id="output_detail_schedules">8 horas</span> &nbsp;-&nbsp;
                        <span id="output_detail_schedules">Lunes a viernes</span>
                     </div>
                     <hr>
                     <p class="">
                        <span class="fw-bolder">Requisitos</span>
                        <ul class="" id="output_detail_requirements">
                           <li>Requerimiento 1</li>
                           <li>Requerimiento 1</li>
                           <li>Requerimiento 1</li>
                        </ul>
                     </p>
                     <p class="">
                        <span class="fw-bolder">Expriencia necesaria</span>
                        <ul class="" id="output_detail_necessary_experience">
                           <li>Experiencias 1</li>
                           <li>Experiencias 1</li>
                           <li>Experiencias 1</li>
                        </ul>
                     </p>
                     <!-- ./ DETALLES DEL EMPELO -->

                     <hr>

                     <p class="">
                        <span class="fw-bolder">Beneficios</span>
                        <ul class="" id="output_detail_benefits">
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
               </form>
            </div>
         </div>
      </div>

   </section>
   <!-- /.content -->

   <!-- Modal Usuario -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-user-plus"></i>&nbsp; REGISTRAR USUARIO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="form_modal" enctype="multipart/form-data">
                  <input type="hidden" id="accion" name="accion" value="">
                  <input type="hidden" id="id" name="id" value=''>
                  <div class="mb-3">
                     <label for="input_usuario" class="form-label">Nombre de usuario:</label>
                     <input type="text" class="form-control" id="input_usuario" name="input_usuario">
                  </div>
                  <div class="mb-3" id="div_contrasenia">
                     <label for="input_contrasenia" class="form-label">Contraseña:</label>
                     <input type="text" class="form-control" id="input_contrasenia" name="input_contrasenia">
                  </div>
                  <div class="mb-3" id="div_nueva_contrasenia">
                     <label for="input_nueva_contrasenia" class="form-label">Nueva contraseña:</label>
                     <input type="text" class="form-control" id="input_nueva_contrasenia" name="input_nueva_contrasenia">
                     <span>
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="switch_nueva_contrasena">
                           <label class="custom-control-label text-sm" for="switch_nueva_contrasena">Habilitar cambio de contraseña</label>
                        </div>
                     </span>
                  </div>
                  <div class="mb-3">
                     <label for="input_rol" class="form-label">Rol:</label>
                     <select class="select2 form-control" style="width:100%" aria-label="Default select example" id="input_rol" name="input_rol">
                        <option selected value="-1">Selecciona una opción</option>
                     </select>
                  </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="btn_enviar_formulario" class="btn btn-success fw-bold">AGREGAR</button>
               <button type="reset" id="btn_reset_formulario" class="btn btn-secondary">Limpiar todo</button>
               </form>
            </div>
         </div>
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

<script>
   
   // $(function () {
   //    /* BOOTSTRAP SLIDER */
   //    // $('.slider').bootstrapSlider();

   //    /* ION SLIDER */
   //    $('#range_1').ionRangeSlider({
   //    min     : 0,
   //    max     : 5000,
   //    from    : 1000,
   //    to      : 4000,
   //    type    : 'double',
   //    step    : 1,
   //    prefix  : '$',
   //    prettify: false,
   //    hasGrid : true
   //    })
   // })
</script>