<!DOCTYPE html>
<html lang="es-PE">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
if ($secc_item["SECC_chTITSEC"]!='' ) 
{
if ($secc_item["SECC_chFOTSEC"]!=null) {
  $foto="".$ruta."uploads/".$secc_item["SECC_chFOTSEC"]."";
}else{
  $foto="".$rutatheme."images/logo.jpg";
}
?>
<title><?php echo ''.$secc_item["SECC_chTITSEC"].' | '.$rsocial.''; ?></title>
  <meta content="<?=$claves?>" name="keywords">
  <meta content="<?=$descripcion?>" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="<?=$secc_item["SECC_chTITSEC"]?>">
  <meta property="og:image" content="<?=$foto?>">
  <meta property="og:url" content="<?=dameURL()?>">
  <meta property="og:site_name" content="<?=$rsocial?>">
  <meta property="og:description" content="<?=$secc_item["PROD_chDESPRO"]?>">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="<?=dameURL()?>">
  <meta name="twitter:title" content="<?=$secc_item["SECC_chTITSEC"]?>">
  <meta name="twitter:description" content="<?=$secc_item["PROD_chDESPRO"]?>">
  <meta name="twitter:image" content="<?=$foto?>">

<?php
}else{?>
<title><?=$rsocial?> <?=$secc_item["SECC_chTITSEC"]?></title>
  <meta content="<?=$claves?>" name="keywords">
  <meta content="<?=$descripcion?>" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="<?=$rsocial?>">
  <meta property="og:image" content="<?=$rutatheme?>images/logo.jpg">
  <meta property="og:url" content="<?=$ruta?>">
  <meta property="og:site_name" content="<?=$rsocial?>">
  <meta property="og:description" content="<?=$descripcion?>">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="<?=$ruta?>">
  <meta name="twitter:title" content="<?=$rsocial?>">
  <meta name="twitter:description" content="<?=$descripcion?>">
  <meta name="twitter:image" content="<?=$rutatheme?>images/logo.jpg">
<?php }?>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?=$rutatheme?>css/bootstrap.min.css">
	<!-- Sepapal CSS -->
	<link rel="stylesheet" type="text/css" href="<?=$rutatheme?>css/sedapal.css">
	<!-- Swiper CSS -->
	<link rel="stylesheet" type="text/css" href="<?=$rutatheme?>css/swiper.min.css">
	<!-- Fonts Google -->
	<link href="https://fonts.googleapis.com/css2?family=Aleo:wght@300;400&display=swap" rel="stylesheet">
	<!-- Iconos Sedapal -->
	<link rel="stylesheet" type="text/css" href="<?=$rutatheme?>css/sedapal-icon.css">
	<link rel="stylesheet" type="text/css" href="<?=$rutatheme?>css/sedapaluser-icon.css">
</head>