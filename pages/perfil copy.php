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
    <form id="form_photo">
      <input type="file" id="input_photo_path" name="input_photo_path" class="d-none" accept="image/*" data-preview="preview_photo">
    </form>
    <form id="form_cv">
      <input type="file" id="input_cv_path" name="input_cv_path" class="d-none" accept=".pdf" data-preview="preview_cv" data-input-name="CURRICULUM VITAE">
    </form>
    <form class="content" id="form">
      <div class="card card-widget widget-user shadow">

        <div class="widget-user-header bg-success" id="div_header">
          <h3 class="widget-user-username im_output" title="doble clic para editar" id="output_name">[Mi Nombre]</h3>
          <input type="text" class="form-control-border-white text-white text-center d-none im_input" title="[Enter] para guardar" id="input_name" name="input_name" data-input-name="NOMBRES">
          <input type="text" class="form-control-border-white text-white text-center d-none im_input" title="[Enter] para guardar" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
          <h5 class="widget-user-desc im_output" id="output_profession">[Mi Profesión]</h5>
          <div class="mt-2">
            <select class="select2 d-none im_input form-select" style="width:15vw; line-height:10px"
            id="input_profession_id" name="input_profession_id"
            data-input-name="PROFESIÓN">
            </select>
          </div>
          <?php if ($_COOKIE["role_id"] != 3): ?>
          <h1 class="text-end fw-bolder" id="output_enable">DISPONIBLE</h1>
          <?php endif; ?>
        </div>
        <div class="widget-user-image">
          <label for="input_photo_path">
              <div id="preview_photo" class="d-flex justify-content-center">
                <img class="img-circle elevation-2 bg-white pointer-sm opacity-100 d-none" id="output_photo" src="/assets/img/sin_perfil.webp" alt="Foto de perfil" for="input_photo_path" title="Haz clic aquí, si deseas cambiar tu foto de perfil">
              </div>
          </label>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-3 border-right">
              <div class="description-block">
                <p class="description-header im_output" id="output_email">[micorreo@gmail.com]</p>
                <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para guardar" id="input_email" name="input_email" data-input-name="CORREO">
                <span class="description-text"><i class="fa-solid fa-envelope"></i></span>
              </div>

            </div>

            <div class="col-sm-3 border-right">
              <div class="description-block">
                <p class="description-header im_output" id="output_cellphone">[Mi número celular]</p>
                <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para guardar" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR">
                <span class="description-text"><i class="fa-sharp fa-solid fa-phone"></i></span>
              </div>

            </div>

            <div class="col-sm-3 border-right">
              <div class="description-block">
                <p class="description-header im_output" id="output_languages">[Mi nivel de ingles]</p>
                <div class="mb-1 d-none im_input">
                    <label for="input_languages">Domínio del inglés: <span class="obligatory"></span></label>
                    <div class="btn-group ml-3" role="group">
                      <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_b" autocomplete="off" value="Inglés - Básico" checked>
                      <label class="btn btn-outline-dark rounded-left" for="input_languages_b">Básico</label>

                      <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_i" autocomplete="off" value="Inglés - Intermedio">
                      <label class="btn btn-outline-dark" for="input_languages_i" >Intermedio</label>

                      <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_a" autocomplete="off" value="Inglés - Avanzado">
                      <label class="btn btn-outline-dark" for="input_languages_a" >Avanzado</label>
                    </div>
                </div>
                <span class="description-text"><i class="fa-regular fa-language"></i></span>
              </div>
            </div>

            <div class="col-sm-3">
              <div class=" btn-group">
                <button type="button" class="btn btn-outline-primary" id="btn_edit">Editar mi información</button>
                <button type="submit" class="btn btn-outline-success d-none rounded-start" id="btn_submit">GUARDAR</button>
                <button type="button" class="btn btn-outline-danger d-none rounded-end" id="btn_cancel">CANCELAR</button>
                <?php if ($_COOKIE["role_id"] != 3): ?>
                <button type="button" class="btn btn-outline-dark" id="btn_change_enable" data-enable="">Cambiar estatus</button>
                <?php endif; ?>
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
              <div class="text-center h2 fw-bolder">INFORMACIÓN PROFESIONAL</div>
              <!-- <h3 class="profile-username text-center">Nina Mcintire</h3>
              <p class="text-muted text-center">Software Engineer</p> -->
              <div id="output_professional_info" class="text-start scroll-y im_output" style="max-height: 81%;"></div>
              <div class="im_input d-none text-start">
                <label for="input_professional_info" class="form-label">Más información: &nbsp;<i class="fa-duotone fa-circle-info" title="Escribir Habilidades, competencias, experiencias, observaciones, etc."></i></label>
                <div class="summernote"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </form>

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