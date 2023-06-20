<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$pagina_acutal = "Mi Perfil";
?>

<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">


  <!-- Main content -->
  <section class="content text-center">

    <div class="content">
      <div class="card card-widget widget-user shadow">

        <div class="widget-user-header bg-success" id="div_header">
          <h3 class="widget-user-username pointer-sm opacity-100" title="doble clic para editar" id="output_name">[Mi Nombre]</h3>
          <input type="text" class="form-control-border text-white text-center d-none" title="[Enter] para guardar" id="input_name" name="input_name" data-input-name="NOMBRES">
          <input type="text" class="form-control-border text-white text-center d-none" title="[Enter] para guardar" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
          <h5 class="widget-user-desc pointer-sm opacity-100" id="output_profession">[Mi Profesión]</h5>
          <select class="select2 d-none" style="width:15vw; line-height:10px"
          id="input_profession_id" name="input_profession_id"
          data-input-name="PROFESIÓN">
          </select>
          <h1 class="text-end fw-bolder" id="output_enable">DISPONIBLE</h1>
        </div>
        <div class="widget-user-image">
          <img class="img-circle elevation-2 bg-white" id="output_photo" src="/assets/img/sin_perfil.webp" alt="Foto de perfil">
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-3 border-right">
              <div class="description-block">
                <p class="description-header" id="output_email">[micorreo@gmail.com]</p>
                <span class="description-text"><i class="fa-solid fa-envelope"></i></span>
              </div>

            </div>

            <div class="col-sm-3 border-right">
              <div class="description-block">
                <p class="description-header" id="output_cellphone">[Mi número celular]</p>
                <span class="description-text"><i class="fa-sharp fa-solid fa-phone"></i></span>
              </div>

            </div>

            <div class="col-sm-3 border-right">
              <div class="description-block">
                <p class="description-header" id="output_languages">[Mi nivel de ingles]</p>
                <span class="description-text"><i class="fa-regular fa-language"></i></span>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="description-block">
                <button class="btn btn-outline-primary">Editar mi información</button>
                <button class="btn btn-outline-dark">FUI CONTRATADO</button>
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
              <input type="file" id="input_cv_path" name="input_cv_path" class="d-none" accept=".pdf" data-preview="preview_cv" data-input-name="CURRICULUM VITAE">
              <label for="input_cv_path" class="">
                <div id="preview_cv" class="d-flex justify-content-center">
                    <img src="<?=$IMG_PATH?>/cargar_archivo.png" alt="Cargar CV" id="output_cv" class="img-fluid pointer-sm p-5 rounded-lg" style="height: 250px !important;" for="input_cv_path" title="Haz clic aquí para cargar tu curriculum vitae">
                </div>
                <div class="btn btn-outline-secondary mt-2">Cambiar archivo</div>
              </label>
            </div>
          </div>
        </div>

        <!-- INFORMACION PROFESIONAL -->
        <div class="col">
          <div class="card card-success card-outline">
            <div class="card-body box-profile card-pdf">
              <div class="text-center h2 fw-bolder">INFORMACIÓN PROFESIONALES</div>
              <!-- <h3 class="profile-username text-center">Nina Mcintire</h3>
              <p class="text-muted text-center">Software Engineer</p> -->
              <div id="output_professional_info" class="text-start scroll-y" style="max-height: 81%;"></div>
            </div>
          </div>
        </div>

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
<script src="<?php echo($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>