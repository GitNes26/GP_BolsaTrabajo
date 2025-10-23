<?php
include "../templates/header.php";
include "../templates/navbar-top.php";
// include "../templates/navbar.php";
// include "../templates/sidebar.php";

$pagina_acutal = "Bolsa de Trabajo";
?>

<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm" style="height: 96% !important;">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header pt_sm_10">
      <div class="container-fluid">
         <div class="row mb-2 mt-3">
            <div class="col text-center">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-regular fa-sack-dollar"></i>&nbsp;
                  <!-- <?= $pagina_acutal ?> -->
                  <em class="fw-ligth text-muted lead text-sm">Actualmente contamos con <b id="vacancies_enabled"
                        class="">0</b> vacantes disponibles para ti</em>
               </h1>
            </div>
            <!-- <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; Inicio</a></li>
                  <li class="breadcrumb-item active"><?= $pagina_acutal ?></li>
               </ol>
            </div> -->
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content text-center">

      <div class="row">

         <!-- FILTROS -->
         <div class="col-md-4 sticky-top">
            <form id="form_filter" class="card card-outline card-dark shadow sticky-top">
               <div class="card-header">
                  <div class="pb-1">
                     <label for="input_filter_search" class="form-label">Buscador General</label>
                     <input type="search" class="form-control not_validate" id="input_filter_search"
                        name="input_filter_search" data-input-name="BUSCADOR GENERAL" placeholder="Puesto | Empresa">
                  </div>
                  <div class="card-tools mt-2">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Filtros de búsqueda"
                        id="btn_show_filters">
                        <i class="fas fa-minus"></i>
                        <i class="fa-solid fa-filter-list"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body text-start" hidden>
                  <input type="hidden" id="filter_op" name="filter_op" value="" class="not_validate">
                  <!-- SUELDO -->
                  <div class="mb-3">
                     <!-- <label for="input_filter_min_salary" class="form-label">Sueldo deseado:</label> -->
                     <!-- <div class="row">
                        <div class="col">
                           <input type="text" class="form-control" id="input_filter_min_salary"
                              name="input_filter_min_salary" data-input-name="NOMBRE DEL MÓDULO" placeholder="Mínimo">
                        </div>
                        <div class="col">
                           <input type="text" class="form-control" id="input_filter_max_salary"
                              name="input_filter_max_salary" data-input-name="NOMBRE DEL MÓDULO" placeholder="Máximo">
                        </div>
                     </div> -->
                     <div class="row">
                        <div class="col-12">
                           <label class="form-label">Rango Salarial</label>
                           <!-- <div id="salarySlider"></div> -->
                           <input type="text" id="salaryRange">
                        </div>
                        <div class="col mt-3">
                           <input type="number" class="form-control" id="input_filter_min_salary"
                              name="input_filter_min_salary" placeholder="Mínimo">
                        </div>
                        <div class="col mt-3">
                           <input type="number" class="form-control" id="input_filter_max_salary"
                              name="input_filter_max_salary" placeholder="Máximo">
                        </div>
                     </div>
                  </div>
                  <!-- GIRO -->
                  <div class="mb-3">
                     <label for="input_filter_business_line_id" class="form-label">Giro:</label>
                     <select class="select2 form-control" style="width:100%" id="input_filter_business_line_id"
                        name="input_filter_business_line_id" data-input-name="GIRO">
                     </select>
                  </div>
                  <!-- AREA -->
                  <div class="mb-3">
                     <label for="input_filter_area_id" class="form-label">Área:</label>
                     <select class="select2 form-control" style="width:100%" id="input_filter_area_id"
                        name="input_filter_area_id" data-input-name="GIRO">
                     </select>
                  </div>
                  <!-- INTERESES -->
                  <div class="form-group d-none">
                     <label for="input_filter_interest_tags_ids">Intereses de búsqueda:</label>
                     <select class="select2 select2-hidden-accessible not_validate" multiple=""
                        data-placeholder="Selecciona etiquetas con tús intereses" style="width: 100%;" tabindex="-1"
                        aria-hidden="true" id="input_filter_interest_tags_ids" name="input_filter_interest_tags_ids"
                        data-input-name="INTERESES">
                     </select>
                  </div>
                  <!-- ESTADO -->
                  <div class="mb-3 col-2 d-none">
                     <label for="input_zip" class="form-label">C.P.: <span class="obligatory"></span></label>
                     <!-- <span title="dar click aqui si no se cargan los datos." data-input="input_zip"
                              class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span> -->
                     <input type="text" maxlength="5" class="form-control numeric" id="input_zip" name="input_zip"
                        data-input-name="CÓDIGO POSTAL">
                  </div>
                  <div class="mb-3">
                     <label for="input_state" class="form-label">Estado:</label>
                     <span title="dar click aqui si no se cargan los datos." data-input="input_state"
                        class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                     <select class="select2 form-control" style="width:100%; line-height:10px" id="input_state"
                        name="input_state" data-input-name="ESTADO">
                     </select>
                  </div>
                  <!-- MUNICIPIO -->
                  <div class="mb-3">
                     <label for="input_municipality" class="form-label">Municipio:</label>
                     <span title="dar click aqui si no se cargan los datos." data-input="input_municipality"
                        class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                     <select class="select2 form-control" style="width:100%; line-height:20px" id="input_municipality"
                        name="input_municipality" data-input-name="MUNICIPIO" disabled>
                     </select>
                  </div>

                  <!-- <div class="mb-3">
                     <label for="">Sueldo estimado: (mensual)</label>
                     <span class="irs irs--flat js-irs-0"><span class="irs"><span class="irs-line" tabindex="0"></span><span class="irs-min" style="visibility: visible;">$0</span><span class="irs-max" style="visibility: visible;">$5 000</span><span class="irs-from" style="visibility: visible; left: 22.9348%;">$1 309</span><span class="irs-to" style="visibility: visible; left: 65.4715%;">$3 505</span><span class="irs-single" style="visibility: hidden; left: 39.6617%;">$1 309 — $3 505</span></span><span class="irs-grid"></span><span class="irs-bar" style="left: 26.9302%; width: 42.5367%;"></span><span class="irs-shadow shadow-from" style="display: none;"></span><span class="irs-shadow shadow-to" style="display: none;"></span><span class="irs-handle from" style="left: 25.3554%;"><i></i><i></i><i></i></span><span class="irs-handle to type_last" style="left: 67.8921%;"><i></i><i></i><i></i></span></span><input id="range_1" type="text" name="range_1" value="" class="irs-hidden-input" tabindex="-1" readonly="">
                  </div> -->


               </div>
               <div class="card-footer">
                  <div class="fw-bolder mb-2" id="leyend_job_found">¡Busca tú empleo ideal!</div>
                  <button type="submit" id="btn_submit" class="btn btn-outline-dark btn-block fw-bold text-center">
                     <i class="fa-regular fa-magnifying-glass"></i>&nbsp;&nbsp;BUSCAR
                  </button>
                  <button type="reset" id="btn_reset" class="btn btn-outline-secondary btn-block fw-bold text-center">
                     <i class="fa-solid fa-ban"></i>&nbsp;&nbsp;LIMPIAR
                  </button>
               </div>
            </form>

            <div class="div-banners-complete p-1 d-none d-sm-none d-md-block">
               <!-- Slider main container -->
               <div class="swiper">
                  <!-- Additional required wrapper -->
                  <div class="swiper-wrapper"></div>
                  <!-- Slide Template -->
                  <template id="template_banner">
                     <div class="swiper-slide">
                        <a target="_blank" rel="noopener noreferrer">
                           <img class="img-carrusel" src="../assets/img/cargar_imagen.png" alt="img">
                        </a>
                     </div>
                  </template>
                  <!-- If we need pagination -->
                  <div class="swiper-pagination"></div>

                  <!-- If we need navigation buttons -->
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>

                  <!-- If we need scrollbar -->
                  <div class="swiper-scrollbar"></div>
               </div>
            </div>

         </div>

         <!-- LISTA DE EMPELOS -->
         <div class="col-md-4 p-3" id="vacancy_container"></div>

         <!-- VISTA A DETALLE -->
         <div class="col-md-4 d-none d-sm-none d-md-block">
            <form id="form_vacancy" enctype="multipart/form-data" class="card shadow-lg sticky-top card-detail">
               <div class="card-header">
                  <span class="modal-title fw-bold h5" id="modalLabel"><i
                        class="fa-regular fa-memo-circle-info"></i>&nbsp; DETALLE DE LA VACANTE</span>
                  <div class="card-tools mt-2">
                     <button type="button" id="btn_close_detail" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                     </button>
                     <!-- <button type="button" class="btn btn-tool" title="Favoritos" data-widget="chat-pane-toggle">
                        <i class="fa-solid fa-star"></i>
                     </button> -->
                  </div>
               </div>
               <div class="card-body text-start scroll-y">
                  <input type="hidden" name="id" value="" class="id not_validate">
                  <p class="h5 fw-bolder output_vacancy">Vacante</p>
                  <p class="mb-3 output_info_company">
                     <span>Empresa</span><br>
                     <span>Ciudad, Estado</span><br>
                     <b>CONTACTO:</b>&nbsp;&nbsp;
                     <i class="fa-solid fa-user"></i>&nbsp; Contacto &nbsp; | &nbsp;
                     <i class="fa-solid fa-phone"></i>&nbsp; (871)-000-00-00 &nbsp; | &nbsp;
                     <i class="fa-solid fa-at"></i>&nbsp; correo@contacto.com
                     <br><br>
                     <span class="">Descripción de la empresa...</span>
                  </p>

                  <hr>

                  <!-- DIV IMAGEN CARGADA -->
                  <div class="text-center div_img d-none">
                     <!-- <label for="preview_img" class="form-label">Imagen cargada:</label><br> -->
                     <img src="../assets/img/cargar_imagen.png" controls preview="true"
                        class="rounded-lg img-fluid preview_img" height="250px"></img>
                     <!-- <button type="button" id="btn_quit_file" class="btn btn-default btn-block fw-bolder">QUITAR IMAGEN</button> -->
                  </div>

                  <!-- DETALLES DEL EMPELO -->
                  <div class="div_info">
                     <p class="h6 fw-bolder">Detalles del empleo</p>
                     <p class="output_area">Área</p>
                     <p class="output_description">Descripción de la vacante...</p>
                     <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                           <div class="mb-2">
                              <i class="fa-brands fa-accessible-icon"></i>&nbsp;
                              <span class="fw-bolder">Inclusiva:&nbsp;</span>
                              <span class="output_inclusive">...</span>
                           </div>
                           <div class="mb-2">
                              <i class="fa-solid fa-laptop-file"></i>&nbsp;
                              <span class="fw-bolder">Modalidad:&nbsp;</span>
                              <span class="output_mode">...</span>
                           </div>
                        </div>
                     </div>


                     <hr>

                     <!-- MAS INFO -->
                     <div class="output_more_info"></div>
                  </div>

               </div>
               <div class="card-footer">
                  <div class="d-grid gap-2">
                     <button type="submit" id="btn_send" class="btn btn-outline-dark fw-bold grid btn_submit"
                        disabled><i class="fa-sharp fa-solid fa-paper-plane-top"></i>&nbsp; POSTULARSE
                     </button>
                  </div>
               </div>
            </form>
         </div>
         <div class="col col-md-4 d-block d-sm-block d-md-none">
            <div class="div-banners-complete p-1">
               <!-- Slider main container -->
               <div class="swiper">
                  <!-- Additional required wrapper -->
                  <div class="swiper-wrapper"></div>
                  <!-- Slide Template -->
                  <template id="template_banner">
                     <div class="swiper-slide">
                        <a target="_blank" rel="noopener noreferrer">
                           <img class="img-carrusel" src="../assets/img/cargar_imagen.png" alt="img">
                        </a>
                     </div>
                  </template>
                  <!-- If we need pagination -->
                  <div class="swiper-pagination"></div>

                  <!-- If we need navigation buttons -->
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>

                  <!-- If we need scrollbar -->
                  <div class="swiper-scrollbar"></div>
               </div>
            </div>
         </div>
      </div>


      <!-- <div class="div-banners"></div> -->

      <!-- <div class="div-banners p-1">
         Slider main container
         <div class="swiper">
         Additional required wrapper
         <div class="swiper-wrapper" id="swipper_banners"></div>
         Slide Template
         <template id="template_banner">
            <div class="swiper-slide">
               <a target="_blank" rel="noopener noreferrer">
                  <img class="img-carrusel" src="../assets/img/cargar_imagen.png" alt="img">
               </a>
            </div>
         </template>
         If we need pagination
         <div class="swiper-pagination"></div>

         If we need navigation buttons
         <div class="swiper-button-prev"></div>
         <div class="swiper-button-next"></div>

         If we need scrollbar
         <div class="swiper-scrollbar"></div>
         </div>
      </div> -->

   </section>
   <!-- /.content -->

   <!-- Modal -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
      data-bs-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form id="form_modal" class="modal-content">
            <div class="modal-header">
               <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-regular fa-memo-circle-info"></i>&nbsp;
                  VISTA PREVIA DE LA VACANTE</span>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start scroll-y">
               <input type="hidden" name="id" value="" class="id not_validate">
               <p class="h5 fw-bolder output_vacancy">Vacante</p>
               <p class="mb-3 output_info_company">
                  <span>Empresa</span><br>
                  <span>Ciudad, Estado</span><br>
                  <b>CONTACTO:</b>&nbsp;&nbsp;
                  <i class="fa-solid fa-user"></i>&nbsp; Contacto &nbsp; | &nbsp;
                  <i class="fa-solid fa-phone"></i>&nbsp; (871)-000-00-00 &nbsp; | &nbsp;
                  <i class="fa-solid fa-at"></i>&nbsp; correo@contacto.com
                  <br><br>
                  <span class="">Descripción de la empresa...</span>
               </p>

               <hr>

               <!-- DIV IMAGEN CARGADA -->
               <div class="text-center div_img d-none">
                  <!-- <label for="preview_img" class="form-label">Imagen cargada:</label><br> -->
                  <img src="../assets/img/cargar_imagen.png" controls preview="true"
                     class="rounded-lg img-fluid preview_img" height="250px"></img>
                  <!-- <button type="button" id="btn_quit_file" class="btn btn-default btn-block fw-bolder">QUITAR IMAGEN</button> -->
               </div>

               <!-- DETALLES DEL EMPELO -->
               <div class="div_info">
                  <p class="h6 fw-bolder">Detalles del empleo</p>
                  <p class="output_area">Área</p>
                  <p class="output_description">Descripción de la vacante...</p>
                  <div class="row">
                     <div class="col-md-6">
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
                     </div>
                     <div class="col-md-6">
                        <div class="mb-2">
                           <i class="fa-brands fa-accessible-icon"></i>&nbsp;
                           <span class="fw-bolder">Inclusiva:&nbsp;</span>
                           <span class="output_inclusive">...</span>
                        </div>
                        <div class="mb-2">
                           <i class="fa-solid fa-laptop-file"></i>&nbsp;
                           <span class="fw-bolder">Modalidad:&nbsp;</span>
                           <span class="output_mode">...</span>
                        </div>
                     </div>
                  </div>


                  <hr>

                  <!-- MAS INFO -->
                  <div class="output_more_info"></div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-outline-dark fw-bold grid btn_submit" disabled><i
                        class="fa-sharp fa-solid fa-paper-plane-top"></i>&nbsp; POSTULARSE
                  </button>
               </div>
            </div>
      </div>
   </div>
</div>

</div>
<!-- /.content-wrapper -->


</div>
<!-- ./wrapper (este se abre en el Template-header) -->


<template id="template_card_vacancy">
   <div class="card card-dark card-outline direct-chat direct-chat-dark shadow-sm pointer-sm card_vacancy" data-id="id">
      <div class="ribbon-wrapper ribbon-lg d-none">
         <div class="ribbon bg-info fw-bolder">POSTULADO</div>
      </div>
      <div class="card-header">
         <span class="card-title fw-bolder vacancy">Vacante</span>
         <div class="card-tools">
            <!-- <span title="vacantes disponibles" class="badge bg-dark vacancy_numbers">3</span> -->
            <!-- <button type="button" class="btn btn-tool" title="Favoritos" data-widget="chat-pane-toggle">
               <i class="fa-solid fa-star"></i>
            </button> -->
         </div>
      </div>
      <div class="card-body pb-2">
         <div class="direct-chat-infos clearfix px-2">
            <span class="direct-chat-timestamp float-right publication_date text-mini">Publicado </span>
            <span class="float-left company">Empresa</span>
            <br>
            <span class="fst-italic float-left company_location">Ciudad, Estado</span>
         </div>
         <p class="fw-bolder have_img">
            Esta vacante contiene una imagen, <br> haz click para ver la información
         </p>
         <div class="div_info_vacancy">
            <p>Area de aplicacion: <span class="area">Informatica</span></p>
            <span class="badge bg-success">
               <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; <span class="min_salary">$0</span> a <span
                  class="max_salary">$0</span>
            </span>
            <span class="badge bg-dark">
               <i class="fa-solid fa-briefcase"></i>&nbsp; <span class="job_type">Tiempo completo</span>
            </span>
            <span class="badge bg-primary">
               <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; <span class="schedules">8 horas - Lunes a
                  vienres</span>
            </span>
            <span class="badge bg-orange text-light" title="Modalidad de trabajo">
               <i class="fa-sharp fa-regular text-light fa-laptop-file"></i>&nbsp; <span
                  class="mode text-light">PRESENCIAL</span>
            </span>
            <span class="badge bg-purple text-light"
               title="Vacante inclusiva: ¿acepta personal con alguna discapacidad?">
               <i class="text-light fa-brands fa-accessible-icon"></i>&nbsp; <span
                  class="inclusive text-light">NO</span>
            </span>
         </div>
      </div>
   </div>
</template>




<?php
include "../templates/footer.php";
?>
<script src="<?php echo ($SCRIPTS_PATH) ?>/index.js"></script>
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