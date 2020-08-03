

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=$ruta?>" class="brand-link">
      <img src="<?=$rutaadmintheme?>dist/img/logo-sedapal-blanco.png" alt="Sedapal Logo" class="brand-image">
      <span class="brand-text font-weight-light"><?=$rsocial?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=$rutaadmintheme?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=primera($_SESSION['node']['nombre'])?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manual de uso
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if(dameURL()=="".$rutaadmin."noticias/" or dameURL()=="".$rutaadmin."categorias/" or dameURL()=="".$rutaadmin."etiquetas/" or dameURL()=="".$rutaadmin."noticias/crear" or basename($_SERVER["PHP_SELF"])=="noticias.php"){echo "menu-open";} ?>">
            <a class="nav-link <?php if(dameURL()=="".$rutaadmin."noticias/"){echo "active";} ?>">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Noticias</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$rutaadmin?>noticias/" class="nav-link <?php if(dameURL()=="".$rutaadmin."noticias/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de Noticias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$rutaadmin?>noticias/crear" class="nav-link <?php if(dameURL()=="".$rutaadmin."noticias/crear"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Añadir noticia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$rutaadmin?>categorias/" class="nav-link <?php if(dameURL()=="".$rutaadmin."categorias/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorías</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$rutaadmin?>etiquetas/" class="nav-link <?php if(dameURL()=="".$rutaadmin."etiquetas/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Etiquetas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if(dameURL()=="".$rutaadmin."paginas/" or basename($_SERVER["PHP_SELF"])=="paginas.php"){echo "menu-open";} ?>">
            <a href="<?=$rutaadmin?>paginas/" class="nav-link <?php if(dameURL()=="".$rutaadmin."paginas/" or basename($_SERVER["PHP_SELF"])=="paginas.php"){echo "active";} ?>">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Páginas</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$rutaadmin?>paginas/" class="nav-link <?php if(dameURL()=="".$rutaadmin."paginas/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de Páginas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$rutaadmin?>paginas/crear" class="nav-link <?php if(dameURL()=="".$rutaadmin."paginas/crear"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Añadir página</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if(dameURL()=="".$rutaadmin."multimedia/"){echo "menu-open";} ?>">
            <a href="#" class="nav-link <?php if(dameURL()=="".$rutaadmin."multimedia/"){echo "active";} ?>">
              <i class="nav-icon fas fa-photo-video"></i>
              <p>
                Multimedia
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$rutaadmin?>multimedia/" class="nav-link <?php if(dameURL()=="".$rutaadmin."multimedia/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Biblioteca</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if(dameURL()=="".$rutaadmin."formularios/" or basename($_SERVER["PHP_SELF"])=="formularios.php"){echo "menu-open";} ?>">
            <a href="#" class="nav-link <?php if(dameURL()=="".$rutaadmin."formularios/" or basename($_SERVER["PHP_SELF"])=="formularios.php"){echo "active";} ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Funcionalidades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$rutaadmin?>formularios/" class="nav-link <?php if(dameURL()=="".$rutaadmin."formularios/" or dameURL()=="".$rutaadmin."encuestas/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Formularios</p>
                </a>
              </li>
              <li class="nav-item">
                <a  href="<?=$rutaadmin?>encuestas/" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Encuestas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?=$rutaadmin?>menu/" class="nav-link <?php if(dameURL()=="".$rutaadmin."menu/"){echo "active";} ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Menús</p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if(dameURL()=="".$rutaadmin."banners/" or basename($_SERVER["PHP_SELF"])=="banners.php"){echo "menu-open";} ?>">
            <a href="#" class="nav-link" <?php if(dameURL()=="".$rutaadmin."banners/" or basename($_SERVER["PHP_SELF"])=="banners.php"){echo "active";} ?>>
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Gestor de Banners
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$rutaadmin?>banners/" class="nav-link <?php if(dameURL()=="".$rutaadmin."banners/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver banners</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$rutaadmin?>banners/crear" class="nav-link <?php if(dameURL()=="".$rutaadmin."banners/crear"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Añadir nuevo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if(dameURL()=="".$rutaadmin."usuarios/"or dameURL()=="".$rutaadmin."enlaces/"){echo "menu-open";} ?>">
            <a href="#" class="nav-link  <?php if(dameURL()=="".$rutaadmin."usuarios/"or dameURL()=="".$rutaadmin."enlaces/"){echo "active";} ?>">
              <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                Administrador
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$rutaadmin?>enlaces/" class="nav-link <?php if(dameURL()=="".$rutaadmin."enlaces/"){echo "active";} ?>" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enlaces de inicio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$rutaadmin?>usuarios/" class="nav-link <?php if(dameURL()=="".$rutaadmin."usuarios/"){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrar usuarios</p>
                </a> 
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contactar</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>