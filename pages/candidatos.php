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
                  <li class="breadcrumb-item"><a href="<?php echo $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; <?php echo $role ?? "" ?></a></li>
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
      <div class="card card-outline card-dark shadow">
         <?php if ($permission_write ?? false): ?>
         <div class="container-fluid mt-2">
            <button id="btn_modal_form" class="float-end btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-circle-plus"></i>&nbsp; AGREGAR EMPRESA</button>
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
                        <th scope="col">Miembro desde</th>
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
                        <th scope="col">Miembro desde</th>
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
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <form class="modal-content" id="form" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="modalLabel"><i class="fa-solid fa-circle-plus"></i>&nbsp; REGISTRAR EMPRESA</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="op" name="op" value="" class="not_validate">
               <input type="hidden" id="id" name="id" value='' class="not_validate">
               <!-- <div class="row">
                  <div class="mb-3 col-md-6">
                     <label for="input_name" class="form-label">Nombre(s): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_name" name="input_name" data-input-name="NOMBRES">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label for="input_last_name" class="form-label">Apellido(s): <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_last_name" name="input_last_name" data-input-name="APELLIDOS">
                  </div>
               </div> -->
               <!-- <div class="row">
                  <div class="mb-3 col-md-6">
                     <label for="input_cellphone" class="form-label">Celular: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_cellphone" name="input_cellphone" data-input-name="CELULAR">
                  </div> 
                  <div class="mb-3 col">
                     <label for="input_email" class="form-label">Correo: <span class="obligatory"></span></label>
                     <input type="email" class="form-control" id="input_email" name="input_email" data-input-name="CORREO">
                  </div>
               </div> -->
               <div class="row"> <!-- USUARIO -->
                  <div class="mb-3 col">
                     <label for="input_user_id" class="form-label">Usuario: <i>(con el que se registro al inicio)</i><span class="obligatory"></span></label>
                     <select class="select2 form-control" style="width:100%"
                     id="input_user_id" name="input_user_id" data-input-name="USUARIO">
                     </select>
                  </div>
               </di>
               <div class="row"> <!-- LOGO Y NOMBRE -->
                  <div class="col-3 rounded-lg text-center"> <!-- LOGO -->
                     <input type="file" id="input_logo_path" name="input_logo_path" class="d-none" accept="image/*" data-preview="preview_logo">
                     <label for="input_logo_path">Logo
                        <div id="preview_logo" class="d-flex justify-content-center">
                           <img src="<?=$IMG_PATH?>/cargar_imagen.png" alt="Cargar Logo" id="output_logo" class="img-fluid pointer p-3 rounded-lg" for="input_logo_path" title="Haz clic aquí para cargar tu logo de empresa">
                        </div>
                     </label>

                  </div>
                  <div class="col"> <!-- NOMBRE Y ACERCA DE -->
                     <div class="mb-3 col">
                        <label for="input_company" class="form-label">Nombre de Empresa: <span class="obligatory"></span></label>
                        <input type="text" class="form-control" id="input_company" name="input_company" data-input-name="NOMBRES DE EMPRESA">
                     </div>
                     <div class="mb-3 col">
                        <label for="input_description" class="form-label">Acerca de mí empresa: <span class="obligatory"></span></label>
                        <textarea type="text" class="form-control counter" id="input_description" name="input_description" data-input-name="ACERCA DE" rows="4" data-limit="150" data-counter="counter_description"></textarea>
                        <div class="text-sm text-end text-muted" id="counter_description"></div>
                     </div>
                  </div>
               </div>

               <div class="row"> <!-- GIRO Y CLASIFICACION -->
                  <div class="mb-3 col">
                     <label for="input_business_line_id" class="form-label">Giro: <span class="obligatory"></span></label>
                     <select class="select2 form-control" style="width:100%"
                     id="input_business_line_id" name="input_business_line_id" data-input-name="GIRO">
                     </select>
                  </div>
                  <div class="mb-3 col">
                     <label for="input_company_ranking_id" class="form-label">Clasificacón: <span class="obligatory"></span></label>
                     <select class="select2 form-control" style="width:100%"
                     id="input_company_ranking_id" name="input_company_ranking_id" data-input-name="ACERCA DE">
                     </select>
                  </div>
               </div>
               <div class="row border rounded mb-3"> <!-- UBICACION -->
                  <label class="text-center">UBICACIÓN</label>
                  <div class="mb-3 col">
                     <label for="input_state" class="form-label">Estado: <span class="obligatory"></span></label>
                     <span title="dar click aqui si no se cargan los datos." data-input="input_state" class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                     <select class="select2 form-control" style="width:100%; line-height:10px"
                     id="input_state" name="input_state"
                     data-input-name="ESTADO">
                     </select>
                  </div>
                  <div class="mb-3 col">
                     <label for="input_municipality" class="form-label">Municipio: <span class="obligatory"></span></label>
                     <span title="dar click aqui si no se cargan los datos." data-input="input_municipality" class="reload_input">&nbsp;&nbsp;<i class="fa-light fa-arrows-rotate pointer"></i></span>
                     <select class="select2 form-control" style="width:100%; line-height:20px"
                     id="input_municipality" name="input_municipality"
                     data-input-name="MUNICIPIO" disabled>
                     </select>
                  </div>
               </div>
               <div class="row border rounded"> <!-- CONTACTO -->
                  <label class="text-center">CONTACTO</label>
                  <div class="mb-3 col">
                     <label for="input_contact_name" class="form-label">Nombre: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_contact_name" name="input_contact_name" data-input-name="NOMBRE DE CONTACTO">
                  </div>
                  <div class="mb-3 col">
                     <label for="input_contact_phone" class="form-label">Teléfono: <span class="obligatory"></span></label>
                     <input type="text" class="form-control" id="input_contact_phone" name="input_contact_phone" data-input-name="TELÉFONO" maxlength="10">
                  </div>
                  <div class="mb-3 col">
                     <label for="input_contact_email" class="form-label">Correo: <span class="obligatory"></span></label>
                     <input type="email" class="form-control" id="input_contact_email" name="input_contact_email" data-input-name="CORREO">
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

</div>
<!-- /.content-wrapper -->


</div>
<!-- ./wrapper (este se abre en el Template-header) -->

<?php
include "../templates/footer.php";
?>
<script src="<?php echo($SCRIPTS_PATH) ?>/<?=substr($path,0,-4)?>.js"></script>