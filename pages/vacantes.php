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
                  <li class="breadcrumb-item"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp;
                        <?= $role ?? "" ?></a></li>
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
            <div class="card card-outline card-success">
               <div class="card-header">
                  <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-regular fa-memo-circle-info"></i>&nbsp; FORMULARIO</span>
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
                        <form id="form" enctype="multipart/form-data" class="card card-outline card-suce shadow" style="max-height: 85vh;">
                           <div class="card-header">
                              <span class="modal-vacancy fw-bold h5" id="modalLabel"><i class="fa-regular fa-circle-plus to-upper-case"></i>&nbsp; AGREGAR VACANTE</span>
                           </div>
                           <div class="card-body scroll-y">
                              <input type="hidden" id="op" name="op" value="" class="not_validate">
                              <input type="hidden" id="id" name="id" value="" class="not_validate">
                              <!-- VACANTE -->
                              <div class="mb-3">
                                 <label for="input_vacancy" class="form-label">Vacante: <span class="obligatory"></span></label>
                                 <input type="text" class="form-control counter" id="input_vacancy" name="input_vacancy" data-input-name="VACANTE" data-limit="45" data-counter="counter_vacancy" data-output="output_vacancy">
                                 <div class="text-sm text-end text-muted" id="counter_vacancy"></div>
                              </div>
                              <!-- EMPRESA -->
                              <?php if ($_COOKIE["role_id"] < 2) : ?>
                                 <div class="mb-3">
                                    <label for="input_company_id" class="form-label">Empresa: <span class="obligatory"></span></label>
                                    <select class="select2 form-control" style="width:100%" id="input_company_id" name="input_company_id" data-input-name="EMPRESA" data-output="output_info_company">
                                    </select>
                                 </div>
                              <?php endif ?>

                              <!-- PREGUNTAR SI AGREGARAN IMAGEN -->
                              <div class="text-center mb-4">
                                 <label class="">Modo de publicación: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="input_publication_mode" id="input_publication_mode_info" value="info" checked>
                                       <label class="form-check-label" for="input_publication_mode_info">Información</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="input_publication_mode" id="input_publication_mode_img" value="img">
                                       <label class="form-check-label" for="input_publication_mode_img">Imagen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="input_publication_mode" id="input_publication_mode_infoimg" value="infoImg">
                                       <label class="form-check-label" for="input_publication_mode_infoimg">Información
                                          +
                                          Imagen</label>
                                    </div>
                                 </label>
                              </div>

                              <hr>

                              <!-- DIV CARGAR IMAGEN -->
                              <div class="mb-3 div_img">
                                 <label for="input_img_path" class="form-label">Cargar imagen: <span class="obligatory"></span></label>
                                 <input class="form-control" type="file" id="input_img_path" name="input_img_path" data-input-name="CARGAR IMAGEN" accept="image/*">
                                 <!-- <div class="form-text">Subir archivo con un peso máximo de <b id="peso_archivo"></b><b>MB</b>.</div> -->
                              </div>

                              <!-- AREA -->
                              <div class="div_info">
                                 <div class="mb-3">
                                    <label for="input_area_id" class="form-label">Área: <span class="obligatory"></span></label>
                                    <select class="select2 form-control" style="width:100%" id="input_area_id" name="input_area_id" data-input-name="ÁREA" data-output="output_area">
                                    </select>
                                 </div>
                                 <!-- DESCRIPCION DE VACANTE -->
                                 <div class="mb-3">
                                    <label for="input_description" class="form-label">Descripción de la vacante:
                                       &nbsp;<i class="fa-duotone fa-circle-info" title="Si deseas dejar sin descripción las responsabilidades de la vacante, escribe un espacio en blanco [tecla escape]."></i>
                                       <span class="obligatory"></span></label>
                                    <textarea type="text" class="form-control counter" id="input_description" name="input_description" data-input-name="DESCRIPCIÓN" rows="5" data-limit="150" data-counter="counter_description" data-output="output_description"></textarea>
                                    <div class="text-sm text-end text-muted" id="counter_description"></div>
                                 </div>
                                 <!-- SUELDO -->
                                 <div class="mb-3">
                                    <label for="input_min_salary" class="form-label">Sueldo: <i>(mensual en pesos
                                          mexicanos)</i> <span class="obligatory"></span></label>
                                    <div class="row">
                                       <div class="col input-group">
                                          <span class="input-group-text">$</span>
                                          <input type="text" class="form-control numeric" id="input_min_salary" name="input_min_salary" data-input-name="SUELDO MÍNIMO" placeholder="Mínimo" data-output="output_min_salary">
                                       </div>
                                       <div class="col input-group">
                                          <span class="input-group-text">$</span>
                                          <input type="text" class="form-control numeric" id="input_max_salary" name="input_max_salary" data-input-name="SUELDO MÁXIMO" placeholder="Máximo" data-output="output_max_salary">
                                       </div>
                                    </div>
                                 </div>

                                 <hr>
                                 <!-- TIPO DE EMPLEO -->
                                 <div class="mb-3">
                                    <label for="input_job_type">Tipo de empleo: <span class="obligatory"></span></label>
                                    <div class="btn-group ml-3" role="group">
                                       <input type="radio" class="btn-check not_validate" name="input_job_type" id="input_job_type_tc" value="Tiempo completo" autocomplete="off" data-output="output_job_type" checked>
                                       <label class="btn btn-outline-dark rounded-left" for="input_job_type_tc">Tiempo
                                          completo</label>

                                       <input type="radio" class="btn-check not_validate" name="input_job_type" id="input_job_type_mt" value="Medio tiempo" autocomplete="off" data-output="output_job_type">
                                       <label class="btn btn-outline-dark" for="input_job_type_mt">Medio tiempo</label>

                                       <input type="radio" class="btn-check not_validate" name="input_job_type" id="input_job_type_p" value="Prácticas" autocomplete="off" data-output="output_job_type">
                                       <label class="btn btn-outline-dark" for="input_job_type_p">Prácticas</label>
                                    </div>
                                 </div>
                                 <!-- HORARIO -->
                                 <div class="mb-3">
                                    <label for="input_schedules" class="form-label">Horarios: <span class="obligatory"></span></label>
                                    <input type="text" class="form-control" id="input_schedules" name="input_schedules" data-input-name="HORARIO" placeholder="8 horas - Lunes a viernes" data-output="output_schedules">
                                 </div>
                                 <!-- MAS INFORMACION -->
                                 <div class="mb-3">
                                    <label for="input_more_info" class="form-label">Más información: &nbsp;<i class="fa-duotone fa-circle-info" title="Recuerda usar los ultimos iconos del editor, que es para borrar todo o crear una plantilla recomendada. Si deseas dejar sin texto 'más información', escribe un espacio en blanco [tecla escape]."></i></label>
                                    <div class="summernote"></div>
                                 </div>
                              </div>

                              <!-- TIEMPO DE PUBLICACION -->
                              <div class="mb-3">
                                 <label for="input_publication_date" class="form-label">Tiempo de publicación:</i>
                                    <span class="obligatory"></span></label>
                                 <div class="row">
                                    <div class="col input-group mb-3" title="Iniciar publicación">
                                       <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                                       <input type="date" class="form-control numeric" id="input_publication_date" name="input_publication_date" data-input-name="FECHA DE PUBLICACIÓN" data-output="output_publication_date" value="<?= date("Y-m-d") ?>">
                                    </div>
                                    <div class="col input-group mb-3" title="Finalizar publicación">
                                       <span class="input-group-text"><i class="fa-solid fa-alarm-exclamation"></i></span>
                                       <input type="date" class="form-control numeric" id="input_expiration_date" name="input_expiration_date" data-input-name="FECHA DE EXPIRACIÓN" data-output="output_expiration_date">
                                    </div>
                                 </div>
                              </div>
                              <!-- TAGS -->
                              <div class="form-group">
                                 <label for="input_tags_ids">TAGS de búsqueda:</label>
                                 <select class="select2 select2-hidden-accessible not_validate" multiple="" data-placeholder="Selecciona etiquetas relacionadas a la vacante" style="width: 100%;" tabindex="-1" aria-hidden="true" id="input_tags_ids" data-input-name="TAGS">
                                 </select>
                              </div>

                           </div>
                           <div class="card-footer">
                              <button type="reset" id="btn_cancel" class="btn btn-danger fw-bold float-start d-none">CANCELAR</button>
                              <button type="reset" id="btn_reset" class="btn btn-secondary float-end ml-2 d-none">LIMPIAR</button>
                              <?php if ($permission_write ?? false) : ?>
                                 <button type="submit" id="btn_submit" class="btn btn-success fw-bold float-end">AGREGAR</button>
                              <?php endif ?>
                           </div>
                        </form>
                        <!-- /.card -->
                     </div>

                     <!-- VISTA A DETALLE -->
                     <div class="col-md-6">
                        <div id="detail_vacancy" class="card shadow-lg card-detail">
                           <div class="card-header">
                              <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-regular fa-memo-circle-info"></i>&nbsp; VISTA PREVIA DE LA VACANTE</span>
                           </div>
                           <div class="card-body text-start scroll-y">
                              <input type="hidden" id="op" name="op" value="" class="not_validate">
                              <input type="hidden" id="id" name="id" value="" class="not_validate">
                              <p class="h5 fw-bolder" id="output_vacancy">Vacante</p>
                              <p class="mb-3" id="output_info_company">
                                 <span>Empresa</span><br>
                                 <span>Ciudad, Estado</span><br>
                                 <b>CONTACTO:</b>&nbsp;&nbsp;
                                 <i class="fa-solid fa-user"></i>&nbsp; ${obj.contact_name} &nbsp; | &nbsp;
                                 <i class="fa-solid fa-phone"></i>&nbsp; ${formatPhone(obj.contact_phone)} &nbsp; |
                                 &nbsp;
                                 <i class="fa-solid fa-at"></i>&nbsp; ${obj.contact_email}
                                 <br><br>
                                 <span class="">Descripción de la empresa...</span>
                              </p>

                              <hr>

                              <!-- DIV IMAGEN CARGADO -->
                              <div class="text-center div_img">
                                 <!-- <label for="preview_img" class="form-label">Imagen cargada:</label><br> -->
                                 <img src="../assets/img/cargar_imagen.png" controls preview="true" class="rounded-lg img-fluid" id="preview_img" height="250px"></img>
                                 <!-- <button type="button" id="btn_quit_file" class="btn btn-default btn-block fw-bolder">QUITAR IMAGEN</button> -->
                              </div>

                              <!-- DETALLES DEL EMPELO -->
                              <div class="div_info">
                                 <p class="h6 fw-bolder">Detalles del empleo</p>
                                 <p class="" id="output_area">Área</p>
                                 <p class="" id="output_description">Descripción de la vacante...</p>
                                 <div class="mb-2">
                                    <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp;
                                    <span class="fw-bolder">Sueldo <i>(menusal)</i>:&nbsp;</span>
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
                                    <span id="output_schedules">8 horas &nbsp;-&nbsp; Lunes a viernes</span>
                                 </div>

                                 <hr>

                                 <!-- MAS INFO -->
                                 <div id="output_more_info">
                                    <i>LA INFORMACION A CONTINUACIÓN ES SOLO DE EJEMPLO,
                                       NO SE GUARDARA A MENOS QUE ESCRIBA ALGO EN EL APARTADO DE <b>Más
                                          información</b></i>
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
                              <th scope="col">Empresa</th>
                              <th scope="col">Sueldo</th>
                              <th scope="col">Tipo de empleo</th>
                              <th scope="col">Publicidad</th>
                              <th scope="col">Imagen</th>
                              <th scope="col">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                           <tr class="thead-dark">
                              <th scope="col">Vacante</th>
                              <th scope="col">Empresa</th>
                              <th scope="col">Sueldo</th>
                              <th scope="col">Tipo de empleo</th>
                              <th scope="col">Publicidad</th>
                              <th scope="col">Imagen</th>
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
<script src="<?= ($SCRIPTS_PATH) ?>/<?= substr($path, 0, -4) ?>.js"></script>