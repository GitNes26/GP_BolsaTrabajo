<nav class="main-header navbar navbar-expand-md navbar-light text-sm">
   <div class="container-fluid">
      <a href="<?php echo($URL_BASE) ?>/pages" class="navbar-brand">
         <img src="<?php echo($ICONO) ?>" alt="Logo" class="brand-image" style="opacity: .8;" id="img-logo-menu">
         <!-- <span class="brand-text d-sm-inline d-md-none">BT</span> -->
         <span class="brand-text d-md-inline d-none fw-bolder h3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bolsa
            de Trabajo</span>
      </a>
      <button class="navbar-toggler order-1" type="button" data-bs-toggle="collapse" data-bs-target="#div_navbar_menus"
         aria-controls="div_navbar_menus" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse order-3 justify-content-center" id="div_navbar_menus">
         <ul class="navbar-nav" id="navbar_menus">
            <li class="nav-item dropdown">
               <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
               <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="#" class="dropdown-item">Some action </a></li>
                  <li><a href="#" class="dropdown-item">Some other action</a></li>
                  <li class="dropdown-divider"></li>

                  <li class="dropdown-submenu dropdown-hover">
                     <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                     <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li>
                           <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                        </li>

                        <li class="dropdown-submenu">
                           <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                           <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                              <li><a href="#" class="dropdown-item">3rd level</a></li>
                              <li><a href="#" class="dropdown-item">3rd level</a></li>
                           </ul>
                        </li>

                        <li><a href="#" class="dropdown-item">level 2</a></li>
                        <li><a href="#" class="dropdown-item">level 2</a></li>
                     </ul>
                  </li>

               </ul>
            </li>
            <li class="nav-item dropdown">
               <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false" class="nav-link dropdown-toggle">Dropdoasaswn</a>
               <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="#" class="dropdown-item">Some action </a></li>
                  <li><a href="#" class="dropdown-item">Some other action</a></li>
                  <li class="dropdown-divider"></li>

                  <li class="dropdown-submenu dropdown-hover">
                     <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                     <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li>
                           <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                        </li>

                        <li class="dropdown-submenu">
                           <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                           <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                              <li><a href="#" class="dropdown-item">3rd level</a></li>
                              <li><a href="#" class="dropdown-item">3rd level</a></li>
                           </ul>
                        </li>

                        <li><a href="#" class="dropdown-item">level 2</a></li>
                        <li><a href="#" class="dropdown-item">level 2</a></li>
                     </ul>
                  </li>

               </ul>
            </li>
         </ul>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto text-light">
         <li class="nav-item dropdown text-center">
            <a href='#' id="btn_logout" class='btn btn-outline-danger btn_logout' title='Cerrar sesión'>
               <i class="fas fa-door-closed"></i>
            </a>
            <span class='d-block text-decoration-none text-bold'>
               <a href="/pages/perfil.php" title="Ir a mi perfil"><i
                     class='text-break'><?php echo "$role:&nbsp; $_COOKIE[email]" ?></i></a>
            </span>
         </li>
         <!-- <li class="nav-item ml-1">
            <a href='#' id="btn_logout" class='btn btn-outline-danger btn_logout' title='Cerrar sesión'>
               <i class="fas fa-door-closed"></i>
            </a>
         </li> -->
      </ul>
   </div>
</nav>