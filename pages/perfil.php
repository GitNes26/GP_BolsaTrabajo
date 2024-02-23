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
      <?php if ($_COOKIE["role_id"] <= 2) : ?>
         <div class="callout callout-info mt-2">
            <h5>ESTA PAGINA NO ES FUNCIONAL PARA LOS ADMINISTRADORES.</h5>
            <p>Esta pagina es solo para que los candidatos o las empresas puedan modificar su informacion si asi lo desean.
            </p>
         </div>
      <?php endif; ?>

      <?php if ($_COOKIE["role_id"] == 3) : ?>
         <form id="form_logo">
            <input type="file" id="input_logo_path" name="input_logo_path" class="d-none" accept="image/*" data-preview="preview_logo">
         </form>
         <form class="content" id="form">
            <div class="card card-widget widget-user shadow">

               <div class="widget-user-header bg-success" id="div_header">
                  <h3 class="widget-user-username im_output" title="" id="output_company">[Mi Comañia]</h3>
                  <input type="text" class="form-control-border-white text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_company" name="input_company" data-input-name="COMPAÑIA">
                  <h5 class="widget-user-desc im_output" id="output_location">[Ciudad, Estado]</h5>
                  <div class="mt-2 d-none im_input">
                     <span title="dar click aqui si no se cargan los datos." data-input="input_state" class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                     <select class="select2 form-control" style="width:15vw; line-height:10px" id="input_state" name="input_state" data-input-name="ESTADO">
                     </select>
                     <span title="dar click aqui si no se cargan los datos." data-input="input_municipality" class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                     <select class="select2 form-control" style="width:15vw; line-height:10px" id="input_municipality" name="input_municipality" data-input-name="MUNICIPIO" disabled>
                     </select>
                  </div>
               </div>
               <div class="widget-user-image">
                  <label for="input_logo_path">
                     <div id="preview_logo" class="d-flex justify-content-center">
                        <img class="img-circle elevation-2 bg-white pointer-sm opacity-100 d-none" id="output_logo" src="../assets/img/cargar_imagen.png" alt="Foto de perfil" for="input_logo_path" title="Haz clic aquí, si deseas cambiar tu logo">
                     </div>
                  </label>
               </div>
               <div class="card-footer">
                  <div class="row">

                     <div class="col-sm-3 border-right">
                        <div class="description-block">
                           <p class="description-header im_output" id="output_contact_name">[Nombre del Contacto]</p>
                           <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_contact_name" name="input_contact_name" data-input-name="NOMBRE DE CONTACTO">
                           <span class="description-text"><i class="fa-solid fa-user"></i></span>
                        </div>
                     </div>

                     <div class="col-sm-3 border-right">
                        <div class="description-block">
                           <p class="description-header im_output" id="output_contact_phone">[telefono de contacto]</p>
                           <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_contact_phone" name="input_contact_phone" data-input-name="TELEFONO DE CONTACTO">
                           <span class="description-text"><i class="fa-sharp fa-solid fa-phone"></i></span>
                        </div>
                     </div>

                     <div class="col-sm-3 border-right">
                        <div class="description-block">
                           <p class="description-header im_output" id="output_contact_email">[correo_contacto@gmail.com]
                           </p>
                           <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_contact_email" name="input_contact_email" data-input-name="CORREO">
                           <span class="description-text"><i class="fa-solid fa-envelope"></i></span>
                        </div>
                     </div>

                     <div class="col-sm-3">
                        <div class=" btn-group">
                           <button type="button" class="btn btn-outline-primary" id="btn_edit">Editar mi
                              información</button>
                           <button type="submit" class="btn btn-outline-success d-none rounded-start" id="btn_submit">GUARDAR</button>
                           <button type="button" class="btn btn-outline-danger d-none rounded-end" id="btn_cancel">CANCELAR</button>
                        </div>
                        <button type="button" class="btn btn-outline-info m-2" id="btn_change_password" data-bs-toggle="modal" data-bs-target="#password_modal">Cambiar Contraseña</button>
                     </div>

                  </div>

               </div>
            </div>
            <div class="row">
               <!-- CURRICULUM VITAE -->
               <div class="col">
                  <div class="card card-success card-outline">
                     <div class="card-body box-profile card-pdf">
                        <div class="text-center h2 fw-bolder">DATOS DE LA EMPRESA</div>
                        <!-- <h3 class="profile-username text-center">Nina Mcintire</h3>
               <p class="text-muted text-center">Software Engineer</p> -->
                        <div class="row">
                           <!-- GIRO Y CLASIFICACION -->

                           <div class="mb-3 col">
                              <div class="im_output">
                                 <i class="fa-solid fa-briefcase"></i> &nbsp; Giro Empresarial
                                 <p class="fw-bolder" id="output_business_line">[Giro Empresarial]</p>
                              </div>
                              <div class="mt-2 d-none im_input">
                                 <label for="input_business_line_id" class="form-label">Giro: <span class="obligatory"></span></label>
                                 <select class="select2 form-control d-none im_input" style="width:100%" id="input_business_line_id" name="input_business_line_id" data-input-name="GIRO">
                                 </select>
                              </div>
                           </div>
                           <div class="mb-3 col">
                              <div class="im_output">
                                 <i class="far fa-circle"></i> &nbsp; Clasificacion de Empresa
                                 <p class="fw-bolder" id="output_company_ranking">[Clasificacion de Empresa]</p>
                              </div>
                              <div class="mt-2 d-none im_input">
                                 <label for="input_company_ranking_id" class="form-label">Clasificacón: <span class="obligatory"></span></label>
                                 <select class="select2 form-control d-none im_input" style="width:100%" id="input_company_ranking_id" name="input_company_ranking_id" data-input-name="ACERCA DE">
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="mb-3 col">
                              <div class="im_output">
                                 <i class="fa-regular fa-memo-circle-info"></i>&nbsp; Acerca de mi empresa
                                 <p class="fw-bolder" id="output_description">...</p>
                              </div>
                              <div class="mt-2 d-none im_input">
                                 <label for="input_description" class="form-label">Acerca de mí empresa: <span class="obligatory"></span></label>
                                 <textarea type="text" class="form-control counter" id="input_description" name="input_description" data-input-name="ACERCA DE" rows="6" data-limit="500" data-counter="counter_description"></textarea>
                                 <div class="text-sm text-end text-muted" id="counter_description"></div>
                              </div>
                           </div>
                           <div class="row border rounded-lg">
                              <!-- CORREO DE USUARIO -->
                              <div class="col-12 h3 fw-bolder">CORREO DE USUARIO</div>
                              <p class="description-header im_output" id="output_email">[correo_de_usuario@gmail.com]</p>
                              <div class="mb-3 d-none im_input">
                                 <label for="input_email " class="form-label">Correo Electronico: <span class="obligatory"></span></label>
                                 <input class="form-control" id="input_email" name="input_email" data-input-name="EMAIL DE USUARIO">
                                 </input>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>

         </form>


      <?php else : ?>
         <form id="form_photo">
            <input type="file" id="input_photo_path" name="input_photo_path" class="d-none" accept="image/*" data-preview="preview_photo">
         </form>
         <form id="form_cv">
            <input type="file" id="input_cv_path" name="input_cv_path" class="d-none" accept=".pdf" data-preview="preview_cv" data-input-name="CURRICULUM VITAE">
         </form>
         <form class="content" id="form">
            <div class="card card-widget widget-user shadow">

               <div class="widget-user-header bg-success" id="div_header">
                  <h3 class="widget-user-username im_output">
                     <span id="output_name">[Mi Nombre]</span> - <span class="h6 fst-italic" id="output_birthdate">[Mi edad]</span>
                  </h3>
                  <input type="text" class="form-control-border-white text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_name" name="input_name" data-input-name="NOMBRES">
                  <input type="text" class="form-control-border-white text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
                  <h5 class="widget-user-desc im_output" id="output_profession">[Mi Profesión]</h5>
                  <div class="mt-2 d-none im_input">
                     <select class="select2 d-none im_input form-select" style="width:15vw; line-height:10px" id="input_profession_id" name="input_profession_id" data-input-name="PROFESIÓN">
                     </select>
                  </div>
                  <h1 class="text-end fw-bolder" id="output_enable">DISPONIBLE</h1>
               </div>
               <div class="widget-user-image">
                  <label for="input_photo_path">
                     <div id="preview_photo" class="d-flex justify-content-center">
                        <img class="img-circle elevation-2 bg-white pointer-sm opacity-100 d-none" id="output_photo" src="../assets/img/sin_perfil.webp" alt="Foto de perfil" for="input_photo_path" title="Haz clic aquí, si deseas cambiar tu foto de perfil">
                     </div>
                  </label>
               </div>
               <div class="card-footer">
                  <div class="row">
                     <div class="col-sm-3 border-right">
                        <div class="description-block">
                           <p class="description-header im_output" id="output_email">[micorreo@gmail.com]</p>
                           <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_email" name="input_email" data-input-name="CORREO">
                           <span class="description-text"><i class="fa-solid fa-envelope"></i></span>
                        </div>

                     </div>

                     <div class="col-sm-3 border-right">
                        <div class="description-block">
                           <p class="description-header im_output" id="output_cellphone">[Mi número celular]</p>
                           <input type="text" class="form-control-border text-white text-center d-none im_input" title="[Enter] para siguiente" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR">
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
                                 <label class="btn btn-outline-dark" for="input_languages_i">Intermedio</label>

                                 <input type="radio" class="btn-check not_validate" name="input_languages" id="input_languages_a" autocomplete="off" value="Inglés - Avanzado">
                                 <label class="btn btn-outline-dark" for="input_languages_a">Avanzado</label>
                              </div>
                           </div>
                           <span class="description-text"><i class="fa-regular fa-language"></i></span>
                        </div>
                     </div>

                     <div class="col-sm-3">
                        <div class=" btn-group">
                           <button type="button" class="btn btn-outline-primary" id="btn_edit">Editar mi
                              información</button>
                           <button type="submit" class="btn btn-outline-success d-none rounded-start" id="btn_submit">GUARDAR</button>
                           <button type="button" class="btn btn-outline-danger d-none rounded-end" id="btn_cancel">CANCELAR</button>
                           <button type="button" class="btn btn-outline-dark" id="btn_change_enable" data-enable="" title=""></button>
                        </div>
                        <button type="button" class="btn btn-outline-info m-2" id="btn_change_password" data-bs-toggle="modal" data-bs-target="#password_modal">Cambiar Contraseña</button>

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
                              <img src="<?= $IMG_PATH ?>/cargar_archivo.png" alt="Cargar CV" id="output_cv" class="img-fluid pointer-sm p-5 rounded-lg" style="height: 250px !important;" for="input_cv_path" title="Haz clic aquí para cargar tu curriculum vitae">
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
                        <div id="output_professional_info" class="text-start scroll-y im_output" style="max-height: 81%;">
                        </div>
                        <div class="im_input d-none text-start">
                           <label for="input_professional_info" class="form-label">Más información: &nbsp;<i class="fa-duotone fa-circle-info" title="Escribir Habilidades, competencias, experiencias, observaciones, etc."></i></label>
                           <div class="summernote"></div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

         </form>
      <?php endif; ?>


   </section>
   <!-- /.content -->

   <!-- Modal para cambio de contraseña | data-bs-backdrop="static"-->
   <div class="modal fade" id="password_modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form_password" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-duotone fa-lock-keyhole"></i>&nbsp; CAMBIAR
                  CONTRASEÑA</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="mb-3 row">
                  <div class="col-12">
                     <label for="input_password" class="form-label">Nueva Contraseña: <span class="obligatory"></span></label>
                     <div class="input-icon">
                        <input type="password" class="form-control" id="input_password" name="input_password" data-input-name="NUEVA CONTRASEÑA">
                        <i class="fa-duotone fa-eye-slash eye_icon" data-input="input_password"></i>
                     </div>
                  </div>
                  <div class="col-12">
                     <label for="input_confirm_password" class="form-label">Confirmar Contraseña: <span class="obligatory"></span></label>
                     <div class="input-icon">
                        <input type="password" class="form-control" id="input_confirm_password" name="input_confirm_password" data-input-name="CONFIRMAR CONTRASEÑA">
                        <i class="fa-duotone fa-eye-slash eye_icon" data-input="input_confirm_password"></i>
                     </div>
                     <span class="fst-italic" id="feedback_confirm_password"></span>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="btn_submit_passwrod" class="btn btn-success fw-bold">ACEPTAR</button>
               <button type="reset" class="btn btn-secondary">LIMPIAR</button>
            </div>
         </form>
      </div>
   </div>
   <!-- /.content-wrapper -->


</div>
<!-- ./wrapper (este se abre en el Template-header) -->




<?php
include "../templates/footer.php";
?>
<script src="<?php echo ($SCRIPTS_PATH) ?>/<?= substr($path, 0, -4) ?>.js"></script>