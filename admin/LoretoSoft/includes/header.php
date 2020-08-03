<!DOCTYPE html>
<html lang="es-ES">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <?php
  //  if ($pagina=='') {
  //   $pag = explode(".", basename($_SERVER["PHP_SELF"]));
  //   $pagina = $pag[0];
  // } 
  ?>
  <!-- Página de CMS que se esta editando -->
  <title><?=$rsocial?> | <?=primera($pagina)?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/summernote/summernote-bs4.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link href="<?=$rutaadmintheme?>dist/css/datatables/jquery.dataTables.min.css" rel="stylesheet">
  <link href="<?=$rutaadmintheme?>dist/css/datatables/responsive.dataTables.min.css" rel="stylesheet">

  <!-- Personalización de Sepadal -->
  <link rel="stylesheet" type="text/css" href="<?=$rutaadmintheme?>dist/css/sedapal.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">