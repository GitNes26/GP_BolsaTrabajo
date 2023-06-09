<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$pagina_acutal = "Bolsa de Trabajo";
?>

<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">


  <!-- Main content -->
  <section class="content text-center">

    <div class="content">
      <div class="card card-widget widget-user shadow">

        <div class="widget-user-header bg-success">
          <h3 class="widget-user-username" id="output_name">Alexander Pierce</h3>
          <h5 class="widget-user-desc">26 Años</h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle elevation-2" src="/assets/img/logo_gomez_palacio.png" alt="Foto de perfil">
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-4 border-right">
              <div class="description-block">
                <h5 class="description-header">micorreo@gmail.com</h5>
                <span class="description-text"><i class="fa-solid fa-envelope"></i></span>
              </div>

            </div>

            <div class="col-sm-4 border-right">
              <div class="description-block">
                <h5 class="description-header">871-526-5689</h5>
                <span class="description-text"><i class="fa-sharp fa-solid fa-phone"></i></span>
              </div>

            </div>

            <div class="col-sm-4">
              <div class="description-block">
                <h5 class="description-header">Inglés - Básico</h5>
                <span class="description-text"><i class="fa-regular fa-language"></i></span>
              </div>

            </div>

          </div>

        </div>
      </div>
      <div class="row">
        <!-- CURRICULUM VITAE -->
        <div class="col col-md-4">
          <div class="card card-success card-outline">
            <div class="card-body box-profile card-pdf">
              <div class="text-center h2 fw-bolder">CURRICULUM VITAE</div>
              <!-- <h3 class="profile-username text-center">Nina Mcintire</h3>
              <p class="text-muted text-center">Software Engineer</p> -->
              <input type="file" id="input_file" name="input_file" class="d-none" accept=".pdf" style="height: 50% !important">
              <label for="input_file" id="label_input_file">
                  <div id="preview_file" class="d-flex justify-content-center">
                  <!-- <iframe frameborder="0"  src="/assets/img/elPDF.pdf" ></iframe> -->
                    <img src="<?=$IMG_PATH?>/cargar_imagen.png" alt="Cargar Logo" class="img-fluid pointer p-3 rounded-lg" for="input_file" title="Haz clic aquí para cargar tu logo de empresa">
                  </div>
              </label>
            </div>

          </div>
        </div>

        <!-- INFORMACION PROFESIONAL -->
        <div class="col">
         <div class="card card-success card-outline">
            <div class="card-body box-profile">
              <div class="text-center h2 fw-bolder">DATOS PROFESIONALES</div>
              <!-- <h3 class="profile-username text-center">Nina Mcintire</h3>
              <p class="text-muted text-center">Software Engineer</p> -->
              <div id="output_professional_info"></div>
            </div>

          </div>
        </div>
      </div>

    </div>

  </section>
  <!-- /.content -->

  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-outline-success fw-bold grid btn_submit" disabled><i
                class="fa-sharp fa-solid fa-paper-plane-top"></i>&nbsp; POSTULARSE
            </button>
          </div>
        </div>
    </div>
  </div>

</div>
<!-- /.content-wrapper -->


</div>
<!-- ./wrapper (este se abre en el Template-header) -->


<template id="template_card_vacancy">
  <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm pointer-sm card_vacancy"
    data-id="id">
    <div class="card-header">
      <span class="card-title fw-bolder vacancy">Vacante</span>
      <div class="card-tools">
        <span title="vacantes disponibles" class="badge bg-success vacancy_numbers">3</span>
        <button type="button" class="btn btn-tool" title="Favoritos" data-widget="chat-pane-toggle">
          <i class="fa-solid fa-star"></i>
        </button>
      </div>
    </div>
    <div class="card-body pb-2">
      <div class="direct-chat-infos clearfix px-2">
        <span class="direct-chat-timestamp float-right publication_date text-mini">Publicado el: </span>
        <span class="float-left company">Empresa</span>
        <br>
        <span class="fst-italic float-left company_location">Ciudad, Estado</span>
      </div>
      <p>Area de aplicacion: <span class="area">Informatica</span></p>
      <span class="badge bg-success">
        <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; <span class="min_salary">$0</span> a <span
          class="max_salary">$0</span>
      </span>
      <span class="badge bg-dark">
        <i class="fa-solid fa-briefcase"></i>&nbsp; <span class="job_type">Tiempo completo</span>
      </span>
      <span class="badge bg-primary">
        <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; <span class="schedules">8 horas - Lunes a vienres</span>
      </span>
    </div>
  </div>
</template>




<?php
include "../templates/footer.php";
?>
<script src="<?php echo($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>