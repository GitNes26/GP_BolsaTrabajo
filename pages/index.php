<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";



$pagina_acutal = "Listado de vacantes";
?>
<!-- Content Wrapper. Contenido de la pagina -->
<div class="content-wrapper text-sm">
   <!-- Content Header (Encabezado en el contenido de la pagina) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="fw-bolder text-uppercase">
                  <i class="fas fa-tachometer-alt"></i>&nbsp; <?= $pagina_acutal ?>
                  <em class="fw-ligth text-muted lead text-sm"></em>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-house"></i>&nbsp; Admin</a></li>
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
            <div class="col-4">
               <form id="form" enctype="multipart/form-data" class="card card-outline card-success shadow sticky-top">
                  <div class="card-header">
                     <span class="modal-title fw-bold h5" id="modalLabel"><i class="fa-solid fa-filter-list"></i>&nbsp; FILTROS DE BUSQUEDA</span>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <input type="hidden" id="op" name="op" value="" class="not_validate">
                     <input type="hidden" id="id" name="id" value="" class="not_validate">
                     <div class="mb-3">
                        <label for="input_menu" class="form-label">Nombre del menú: <span class="obligatory"></span></label>
                        <input type="text" class="form-control" id="input_menu" name="input_menu" data-input-name="NOMBRE DEL MÓDULO">
                     </div>
                     <div class="mb-3">
                        <label for="input_tag" class="form-label">Tag: <span class="obligatory"></span></label>
                        <input type="text" class="form-control" id="input_tag" name="input_tag" data-input-name="TAG">
                     </div>
                     <div class="mb-3">
                        <label for="input_belongs_to" class="form-label">Pertence a: <span class="obligatory"></span></label>
                        <select class="select2 form-control" style="width:100%" id="input_belongs_to" name="input_belongs_to" data-input-name="PERTENECE A">
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="input_file_path" class="form-label">Archivo (php): <span class="obligatory"></span></label>
                        <input type="text" class="form-control" id="input_file_path" name="input_file_path" data-input-name="ARCHIVO">
                     </div>
                     <div class="mb-3">
                        <label for="input_icon" class="form-label">Ícono:</label>
                        <input type="text" class="form-control not_validate" id="input_icon" name="input_icon" data-input-name="ÍCONO">
                     </div>
                     <!-- <div class="mb-3">
                        <label for="input_order" class="form-label">Orden: <span class="obligatory"></span></label>
                        <input type="number" step="1" class="form-control" id="input_order" name="input_order" data-input-name="ORDEN">
                     </div> -->
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="input_active" name="input_active" checked>
                           <label class="custom-control-label" id="label_module_enable" for="input_active">Activo</label>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="reset" id="btn_cancel" class="btn btn-danger fw-bold float-start">CANCELAR</button>
                     <button type="reset" id="btn_reset" class="btn btn-secondary float-end ml-2 d-none">LIMPIAR</button>
                     <?php if ($permission_write ?? false): ?>
                        <button type="submit" id="btn_submit" class="btn btn-success fw-bold float-end">AGREGAR</button>
                     <?php endif ?>

                  </div>
               </form>
            </div>
            <div class="col-3">
               <?php for ($i=0; $i < 20; $i++): ?>
                  <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm pointer-sm">
                  <div class="card-header">
                     <span class="card-title fw-bolder">Puesto</span>

                     <div class="card-tools">
                        <span title="vacantes disponibles" class="badge bg-success">3</span>
                        <button type="button" class="btn btn-tool" title="Favoritos" data-widget="chat-pane-toggle">
                           <i class="fa-solid fa-star"></i>
                        </button>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="direct-chat-infos clearfix px-2">
                        <span class="direct-chat-timestamp float-right">Publicado el: </span>
                        <span class="float-left">Empresa</span>
                        <br>
                        <span class="fst-italic float-left">Ciudad, Estado</span>
                     </div>
                     <p>Area de aplicacion: Informatica</p>
                     <span class="badge bg-success">
                        <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; $10,000 a $12,000
                     </span>
                     <span class="badge bg-dark">
                        <i class="fa-solid fa-briefcase"></i>&nbsp; Tiempo completo
                     </span>
                     <span class="badge bg-primary">
                        <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; Lunes a viernes
                     </span> 
                  </div>
               </div>
               <?php endfor; ?>
            </div>
            <div class="col">detalle</div>
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
               <form id="formulario_modal" enctype="multipart/form-data">
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

<script>
//   window.location.href = `${URL_ADMIN}/users.php`;
</script>