<?php
//error_reporting(0);
@header( "Content-Type: text/html; charset=utf-8", true );
require_once '../includes/database/db_config.php';
$db->conn();
$url_categoria=alfanumerico($_GET["loretosoft1"]);
$secc_item = $db->select_one('*', 'm_secc', "where SECC_inESTSEC='1' and SECC_inESTSEC=1 and SECC_txURLSEC='".$url_categoria."' ");
include "../includes/comm2.php";
include "../includes/header.php";

//si es que encuentra banner activo en esta pagina
$bann = $db->select('*', 'm_secc', "
where SECC_chSECCAT=3 and SECC_inESTSEC=1 and
SECC_txURLPAG='".dameURL()."'
");
        while ($bann_dat = $bann->fetch_assoc()) {
        	if ($bann_dat["SECC_inABRMOD"]==1) {
        		$target="_blank";
        	}else{$target="_self";}
        	?>

<div class="modal fade" id="BannerModal" tabindex="-1" role="dialog" aria-labelledby="BannerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="BannerModalLabel"><?=$bann_dat["SECC_chTITSEC"]?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a href="<?=$bann_dat["SECC_txURLBAN"]?>" target="<?=$target?>" title="<?=$bann_dat["SECC_chTITSEC"]?>"><img src="<?=$ruta?>uploads/<?=$bann_dat["SECC_chFOTSEC"]?>" class="img-responsive" style="width: 100%"></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<a type="button" class="btn btn-secondary boton_banner d-none" data-toggle="modal" data-target="#BannerModal"></a>

<?php       }


if ($secc_item["SECC_chTITSEC"]==null) {?>
	<section class="subcabecera">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="<?=$ruta?>">Inicio</a></li>
							<li class="breadcrumb-item active">Página no encontrada</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<section class="noticia-contenido">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
        <img src="<?=$rutatheme?>img/error-404.jpg" class="img-responsive">
        <!-- <h4>Página web no encontrada, o artículo deshabilitado.</h4></center> -->
				</div>
			</div>
		</div>
	</section>
<?php }else{
	if ($secc_item["SECC_chSECCAT"]=='1') {
?>

	<section class="subcabecera">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#">Noticias</a></li>
							<li class="breadcrumb-item active"><?=$secc_item["SECC_chTITSEC"]?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<section class="noticia-principal" style="background-image: url(<?=$ruta?>uploads/<?=$secc_item["SECC_chFOTSEC"]?>);">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="fecha mb-3"><?=fechaletra($secc_item["SECC_dtFECCRE"])?></div>
					<h1 class="pl-3 mb-3"><?=$secc_item["SECC_chTITSEC"]?>
					</h1>
					<p class="pl-3"><?=$secc_item["SECC_txDETSEC"]?></p>
				</div>
			</div>
		</div>
	</section>
	<section class="noticia-contenido">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div class="compartir-social">
						<span>Comparte esta noticia</span>
						<div class="social-sepadal">
							<a href="#">
								<i class="sepapal-facebook"></i>
							</a>
							<a href="#">
								<i class="sepapal-whatsapp"></i>
							</a>
							<a href="#">
								<i class="sepapal-linkedin"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<article>
						<?=$secc_item["SECC_txCONSEC"]?>
					</article>
				</div>
			</div>
		</div>
	</section>
	<section class="noticias-relacionadas">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<h3>Noticias Relacionadas</h3>
					<div id="noticias-relacionada-swiper" class="swiper-container">
						<div class="swiper-wrapper row">
<?php
$relacionadas = $db->select('*', 'm_secc', "where SECC_chSECCAT='1' and SECC_inESTSEC=1 order by SECC_P_inCODSEC desc limit 3 ");
    while ($relacionadas_cat = $relacionadas->fetch_assoc()) {
?>
							<div class="swiper-slide col-md-4">
								<a href="<?=$ruta?><?=$relacionadas_cat["SECC_txURLSEC"]?>">
									<div class="noticia-relacionada" style="background-image: url(<?=$ruta?>uploads/<?=$relacionadas_cat["SECC_chFOTSEC"]?>);">
										<div class="titulo"><?=$relacionadas_cat["SECC_chTITSEC"]?></div>
									</div>
								</a>
							</div>
<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php }else if ($secc_item["SECC_chSECCAT"]=='2') {?>
	<section class="subcabecera">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="<?=$ruta?>">Páginas</a></li>
							<li class="breadcrumb-item active"><?=$secc_item["SECC_chTITSEC"]?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<section class="pagina-principal" style="background-image: url(<?=$ruta?>uploads/<?=$secc_item["SECC_chFOTSEC"]?>);">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="mb-0"><?=$secc_item["SECC_txDETSEC"]?></p>
					<h1><?=$secc_item["SECC_chTITSEC"]?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="pagina-contenido">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<article>
						<?=$secc_item["SECC_txCONSEC"]?>
					</article>
				</div>
			</div>
		</div>
	</section>

<?php }

}
include "../includes/footer.php" ?>
