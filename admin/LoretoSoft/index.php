<?php
// error_reporting (0);
require_once 'check.php';
$pagina=letras($_GET["ruta"]);
$ruta_archivo = "".$pagina.".php";
include "includes/header.php";
include "includes/lateral.php";
if (file_exists($ruta_archivo)) {
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=primera(invertir($pagina))?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$ruta?>">Escritorio</a></li>
              <li class="breadcrumb-item active"><a><?=primera(invertir($pagina))?></a></li>
            </ol>
          </div><!-- /.col -->       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <!-- Contenido -->
          
<span id="loader"></span>
<div class='cargaweb'></div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  

  <!-- /.content-wrapper -->

<?php
} else {
    include "error-404.php";
}
include "includes/footer.php"; ?>