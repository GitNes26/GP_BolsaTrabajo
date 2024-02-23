<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   </ul>

   <!-- <ul class="navbar-nav " id="ul_dark_theme">
      <label for="checkbox" id="label_dark_theme">
         Dark mode
         <input <?= $cookie_dark_mode != "1" ? "checked" : "" ?> type="checkbox" id="checkbox" />
         <div class="toggle button"></div>
      </label>

   </ul> -->

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <!-- Perfil -->
      <li class='nav-item'>
         <div class='user-panel d-flex'>
            <div class='info'>
               <span class='d-block text-decoration-none text-bold'>
                  <a href="<?=$URL_BASE?>/pages/perfil.php" title="Ir a mi perfil"><i
                        class=''><?php echo "$role:&nbsp; $_COOKIE[email]" ?></i></a>
               </span>
            </div>
         </div>
      </li>
      <!-- Btn Logout -->
      <li class='nav-item ml-3'>
         <a href='#' id="btn_logout" class='btn btn-outline-danger btn_logout' title='Cerrar sesión'>
            <i class="fas fa-door-closed"></i>
         </a>
      </li>
   </ul>

</nav>
<!-- /.navbar -->