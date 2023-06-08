<?php
include "../templates/header.php";
include "../templates/navbar.php";
include "../templates/sidebar.php";



$pagina_acutal = "Dashboard";
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

     <h1 clas="lead fw-bold text-center">Dashboard</h1>

      <!-- card -->
      <!-- <?php #include "./paquetes.php"; ?> -->
      <!-- /.card -->

   </section>
   <!-- /.content -->

   <!-- Modal -->
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