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

   <ul id="sidebar_menus" class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
      <!-- CATÁLOGOS -->
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <!-- Perfil -->
      <li class='nav-item'>
         <div class='user-panel d-flex'>
            <div class='info'>
                  <span class='d-block text-decoration-none text-bold'>
                     <i class=''><?php echo "$role:&nbsp; $_COOKIE[email]" ?></i>
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