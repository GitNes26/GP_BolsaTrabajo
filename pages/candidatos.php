<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";

$current_page = "Candidatos";

?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fa-solid fa-buildings"></i>&nbsp; <?php echo $current_page ?>
                  <em class="fw-ligth text-muted lead text-sm">| Gestión de candidatos</em>
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
      <div class="card card-outline card-success shadow">
         <?php if ($permission_write ?? false): ?>
         <div class="container-fluid mt-2">
            <button id="btn_modal_form" class="float-end btn btn-success fw-bold" data-bs-toggle="modal"
               data-bs-target="#modal"><i class="fa-solid fa-circle-plus"></i>&nbsp; AGREGAR CANDIDATO</button>
         </div>
         <?php endif ?>
         <div class="card-body">
            <!-- tabla -->
            <div class="table-responsive">
               <table id="table" class="table table-hover text-center" style="width:100%">
                  <thead class="thead-dark">
                     <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Candidato</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Profesión</th>
                        <th scope="col">Status</th>
                        <?php if ((int)$_COOKIE["role_id"] <= 2): ?> <th scope="col">Miembro desde</th> <?php endif ?>
                        <th scope="col">Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                     <tr class="thead-dark">
                        <th scope="col">Foto</th>
                        <th scope="col">Candidato</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Profesión</th>
                        <th scope="col">Status</th>
                        <?php if ((int)$_COOKIE["role_id"] <= 2): ?> <th scope="col">Miembro desde</th> <?php endif ?>
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
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-circle-plus"></i>&nbsp; REGISTRAR
                  EMPRESA</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y">
               <input type="hidden" id="op" name="op" value="" class="not_validate">
               <input type="hidden" id="id" name="id" value='' class="not_validate">
               <!-- USUARIO -->
               <div class="row">
                  <div class="mb-3 col">
                     <label for="input_user_id" class="form-label">Usuario: <i>(con el que se registro al
                           inicio)</i><span class="obligatory"></span></label>
                     <select class="select2 form-control" style="width:100%" id="input_user_id" name="input_user_id"
                        data-input-name="USUARIO">
                     </select>
                  </div>
               </div>
               <!-- LOGO Y NOMBRE -->
               <div class="row">
                  <!-- LOGO -->
                  <div class="col-3 rounded-lg text-center border rounded-lg">
                     <input type="file" id="input_photo_path" name="input_photo_path" class="d-none" accept="image/*"
                        data-preview="preview_photo">
                     <label for="input_photo_path">Foto de perfil
                        <div id="preview_photo" class="d-flex justify-content-center">
                           <img src="<?= $IMG_PATH ?>/cargar_imagen.png" alt="Cargar foto" id="output_photo"
                              class="img-fluid pointer p-3 rounded-lg" for="input_photo_path"
                              title="Haz clic aquí para cargar tu foto de perfil">
                        </div>
                     </label>
                  </div>
                  <!-- DATOS GENERALES -->
                  <div class="col">
                     <!-- NOMBRE Y APELLIDO -->
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label for="input_name" class="form-label">Nombre(s): <span
                                 class="obligatory"></span></label>
                           <input type="text" class="form-control not_validate" id="input_name" name="input_name"
                              data-input-name="NOMBRES">
                        </div>
                        <div class="mb-3 col-md-6">
                           <label for="input_last_name" class="form-label">Apellido(s): <span
                                 class="obligatory"></span></label>
                           <input type="text" class="form-control not_validate" id="input_last_name"
                              name="input_last_name" data-input-name="APELLIDOS">
                        </div>
                     </div>
                     <!-- CECULAR Y EDAD -->
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label for="input_cellphone" class="form-label">Celular: <span
                                 class="obligatory"></span></label>
                           <input type="text" class="form-control not_validate numeric" id="input_cellphone"
                              name="input_cellphone" data-input-name="CELULAR" maxlength="10">
                        </div>
                        <div class="mb-3 col-md-6">
                           <label for="input_birthdate" class="form-label">Fecha de Nacimiento: <span
                                 class="obligatory"></span></label>
                           <input type="date" class="form-control not_validate" id="input_birthdate"
                              name="input_birthdate" data-input-name="FECHA DE NACIMIENTO">
                           <!-- <input type="number" class="form-control not_validate" id="input_age" name="input_age"
                              data-input-name="CORREO"> -->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- INTERESES -->
               <div class="row">
                  <div class="form-group">
                     <label for="input_interest_tags_ids">Intereses de búsqueda:</label>
                     <select class="select2 select2-hidden-accessible not_validate" multiple=""
                        data-placeholder="Selecciona etiquetas relacionadas a tús intereses" style="width: 100%;"
                        tabindex="-1" aria-hidden="true" id="input_interest_tags_ids" name="input_interest_tags_ids"
                        data-input-name="INTERESES">
                     </select>
                  </div>
               </div>
               <!-- DATOS PROFESIONALES -->
               <div class="border rounded mt-2 p-2">
                  <div for="" class="text-center fw-bolder mb-3">DATOS PROFESIONALES</div>
                  <!-- ACERCA DE MÍ -->
                  <!-- <div class="row">
                     <div class="mb-3 col">
                        <label for="input_about_me" class="form-label">Acerca de mí: <span class="obligatory"></span></label>
                        <textarea type="text" class="form-control" id="input_about_me" name="input_about_me" data-input-name="ACERCA DE" rows="4" data-limit="500"></textarea>
                        <div class="text-sm text-end text-muted" id="counter_description">0/150</div>
                     </div>
                  </div> -->
                  <!-- COMPETENCIAS Y HABILIDADES -->
                  <!-- <div class="row">
                     <div class="mb-3 col-md-6">
                        <label for="">Competencias:</label>
                        <ul class="list-group" id="list_skills">
                           <li class="list-group-item d-flex justify-content-between align-items-center" id="skill_li
                           ">
                              <input type="text" class="border-only-bottom not_validate" id="input_skill_" value="Competencia 1">
                              <div class="">
                                 <span class="badge bg-success rounded-pill pointer btn_skill_ok" data-id="" title="Aceptar"><i class="fa-solid fa-check"></i></span>
                                 <span class="badge bg-primary rounded-pill pointer btn_skill_edit" data-id="" title="Editar"><i class="fa-solid fa-pen"></i></span>
                                 <span class="badge bg-danger rounded-pill pointer btn_skill_delete" data-id="" title="Eliminar"><i class="fa-solid fa-xmark"></i></span>
                              </div>
                           </li>
                        </ul>
                        <div class="d-grid gap-2">
                           <button class="btn btn-outline-dark" type="button" id="btn_add_skill"><i class="fa-regular fa-circle-plus"></i>&nbsp; Agregar</button>
                        </div>
                     </div>
                     <div class="mb-3 col-md-6">
                        <label for="">Habilidades:</label>
                        <ul class="list-group" id="list_abilities">
                           <li class="list-group-item d-flex justify-content-between align-items-center" id="ability_li
                           ">
                              <input type="text" class="border-only-bottom not_validate" id="input_ability_" value="Competencia 1">
                              <div class="">
                                 <span class="badge bg-success rounded-pill pointer btn_ability_ok" data-id="" title="Aceptar"><i class="fa-solid fa-check"></i></span>
                                 <span class="badge bg-primary rounded-pill pointer btn_ability_edit" data-id="" title="Editar"><i class="fa-solid fa-pen"></i></span>
                                 <span class="badge bg-danger rounded-pill pointer btn_ability_delete" data-id="" title="Eliminar"><i class="fa-solid fa-xmark"></i></span>
                              </div>
                           </li>
                        </ul>
                        <div class="d-grid gap-2">
                           <button class="btn btn-outline-dark" type="button" id><i class="fa-regular fa-circle-plus"></i>&nbsp; Agregar</button>
                        </div>
                     </div>
                  </div> -->
                  <!-- PROFESION -->
                  <div class="row">
                     <div class="mb-3 col">
                        <label for="input_profession_id" class="form-label">Profesión/Oficio: <span
                              class="obligatory"></span></label>
                        <select class="select2 form-control" style="width:100%; line-height:10px"
                           id="input_profession_id" name="input_profession_id" data-input-name="PROFESIÓN">
                        </select>
                     </div>
                  </div>
                  <!-- INFORMACION PROFESIONAL -->
                  <div class="mb-3">
                     <label for="input_professional_info" class="form-label">Más información: <span
                           class="obligatory"></span> &nbsp;<i class="fa-duotone fa-circle-info"
                           title="Escribir Habilidades, competencias, experiencias, observaciones, etc."></i></label>
                     <div class="summernote"></div>
                  </div>
                  <!-- LENGUAJE Y CV-->
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label for="input_languages">Domínio del inglés: <span class="obligatory"></span></label>
                        <div class="btn-group ml-3" role="group">
                           <input type="radio" class="btn-check not_validate" name="input_languages"
                              id="input_languages_b" autocomplete="off" value="Inglés - Básico" checked>
                           <label class="btn btn-outline-dark rounded-left" for="input_languages_b">Básico</label>

                           <input type="radio" class="btn-check not_validate" name="input_languages"
                              id="input_languages_i" autocomplete="off" value="Inglés - Intermedio">
                           <label class="btn btn-outline-dark" for="input_languages_i">Intermedio</label>

                           <input type="radio" class="btn-check not_validate" name="input_languages"
                              id="input_languages_a" autocomplete="off" value="Inglés - Avanzado">
                           <label class="btn btn-outline-dark" for="input_languages_a">Avanzado</label>
                        </div>
                     </div>
                     <div class="mb-3 col-md-6 rounded-lg text-center">
                        <input type="file" id="input_cv_path" name="input_cv_path" class="d-none" accept=".pdf"
                           data-preview="preview_cv" data-input-name="CURRICULUM VITAE">
                        <label for="input_cv_path" class="border rounded-lg">Cargar CV: <span
                              class="badge btn-outline-secondary btn-xs mt-2 h4">Cambiar archivo</span>
                           <div id="preview_cv" class="d-flex justify-content-center">
                              <img src="<?= $IMG_PATH ?>/cargar_archivo.png" alt="Cargar CV" id="output_cv"
                                 class="img-fluid pointer-sm p-5 rounded-lg" style="height: 150px;" for="input_cv_path"
                                 title="Haz clic aquí para cargar tu curriculum vitae">
                           </div>
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="btn_submit" class="btn btn-success fw-bold">AGREGAR</button>
               <button type="reset" id="btn_reset" class="btn btn-secondary">LIMPIAR</button>
            </div>
         </form>
      </div>
   </div>

   <!-- Modal Ver Candidato -->
   <div class="modal fade" id="candidate_modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
      data-bs-backdrop="static">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-titles fw-bold" id="modalLabel"><i class="fa-solid fa-user-tie"></i>&nbsp; INFORMACIÓN
                  DEL CANDIDATO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y">
               <section class="content text-center">
                  <div class="content">
                     <div class="card card-widget widget-user shadow">

                        <div class="widget-user-header bg-success" id="d_div_header">
                           <h3 class="widget-user-username im_output">
                              <span id="d_output_name">[Mi Nombre]</span> - <span class="h6 fst-italic"
                                 id="d_output_birthdate">[Mi edad]</span>
                           </h3>
                           <h5 class="widget-user-desc im_output" id="d_output_profession">[Mi Profesión]</h5>
                           <h1 class="text-end fw-bolder" id="d_output_enable">DISPONIBLE</h1>
                        </div>
                        <div class="widget-user-image">
                           <label>
                              <div id="d_preview_photo" class="d-flex justify-content-center">
                                 <img class="img-circle elevation-2 bg-white pointer-sm opacity-100 d-none"
                                    id="d_output_photo" src="../assets/img/sin_perfil.webp" alt="Foto de perfil"
                                    title="Foto de perfil">
                              </div>
                           </label>
                        </div>
                        <div class="card-footer">
                           <div class="row">
                              <div class="col-sm-4 border-right">
                                 <div class="description-block">
                                    <p class="description-header im_output" id="d_output_email">[micorreo@gmail.com]</p>
                                    <span class="description-text"><i class="fa-solid fa-envelope"></i></span>
                                 </div>
                              </div>

                              <div class="col-sm-4 border-right">
                                 <div class="description-block">
                                    <p class="description-header im_output" id="d_output_cellphone">[Mi número celular]
                                    </p>
                                    <span class="description-text"><i class="fa-sharp fa-solid fa-phone"></i></span>
                                 </div>
                              </div>

                              <div class="col-sm-4">
                                 <div class="description-block">
                                    <p class="description-header im_output" id="d_output_languages">[Mi nivel de ingles]
                                    </p>
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
                                 <label for="d_input_cv_path" class="">
                                    <div id="d_preview_cv" class="d-flex justify-content-center">
                                       <img src="<?= $IMG_PATH ?>/cargar_archivo.png" alt="Cargar CV" id="d_output_cv"
                                          class="img-fluid p-5 rounded-lg" style="height: 250px !important;"
                                          for="d_input_cv_path" title="Curriculum Vitae">
                                    </div>
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
                                 <div id="d_output_professional_info" class="text-start scroll-y im_output"
                                    style="max-height: 81%;"></div>
                              </div>
                           </div>
                        </div>

                     </div>

                  </div>
               </section>
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