<?php
//error_reporting(0);
@header( "Content-Type: text/html; charset=utf-8", true );
require_once 'includes/database/db_config.php';
$db->conn();
include "includes/comm2.php";
include "includes/header.php";
?>
	<section class="carrusel-principal">
		<div id="principal-swiper" class="swiper-container">
			<div class="swiper-wrapper">

<?php
$slide = $db->select('*', 'm_secc', "where SECC_inSLIPRI=1 and SECC_inESTSEC=1 order by SECC_P_inCODSEC desc limit 10");
        while ($slide_dat = $slide->fetch_assoc()) {
?>
				<div class="swiper-slide">
					<div class="principal-slide" style="background-image: url(<?=$ruta?>uploads/<?=$slide_dat["SECC_chFOTSEC"]?>);">
						<div class="container">
							<div class="row align-items-center">
								<div class="col-md-5">
									<div class="contenido-principal-slide">
										<span><?=$slide_dat["SECC_chTITSEC"]?></span>
										<h3><?=$slide_dat["SECC_txDETSEC"]?></h3>
										<a href="<?=$ruta?><?=$slide_dat["SECC_txURLSEC"]?>">CONOCE MÁS</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-button-prev"></div>
    				<div class="swiper-button-next"></div>
				</div>
<?php } ?>

			</div>
		</div>
	</section>
	<section class="accesos-rapidos">
		<div class="container">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="titulo">
						Accesos rápidos
					</div>
					<div class="subtitulo ocultar-movil">
						Centro de ayuda
					</div>
				</div>
				<div class="col-md-12 mt-5">
					<div class="accesos-rapidos-enlaces">
						<div class="flecha-antes"></div>
						<div id="accesos-rapidos-swiper" class="swiper-container">
						    <div class="swiper-wrapper">

<?php
$acceso = $db->select('*', 'm_enla', "where ENLA_intESTENL=1 and ENLA_intLUGENL=1 order by ENLA_P_inCODENL");
        while ($acceso_dat = $acceso->fetch_assoc()) {
?>
						        <div class="swiper-slide">
						        	<a href="<?=$acceso_dat["ENLA_chURLENL"]?>" target="<?=$acceso_dat["ENLA_chABRENL"]?>" class="sedapal-cuadro-icono">
						        			<!-- <img src="<?=$ruta?>uploads/<?=$acceso_dat["ENLA_chFOTENL"]?>" class="w-100"> -->
						        		<span class="sedapaluser-aquanets" style="background-image: url(<?=$ruta?>uploads/<?=$acceso_dat["ENLA_chFOTENL"]?>)">
						        		</span>
						        		<h4><?=$acceso_dat["ENLA_chTITENL"]?></h4>
						        	</a>
						        </div>
<?php } ?>

						    </div>
						</div>
						<div class="flecha-despues"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="principal-noticias">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h3>Te mantenemos informado</h3>
					<p>CONOCE MÁS SOBRE SEDAPAL Y SUS SERVICIOS</p>
				</div>
			</div>
			<div class="row mt-4">
<?php
$noticias = $db->select('*', 'm_secc', "where SECC_chSECCAT=1 and SECC_inESTSEC=1 order by SECC_P_inCODSEC and SECC_chSECCAT=1 desc limit 3");
        while ($noticias_dat = $noticias->fetch_assoc()) {
?>
				<div class="col-md-4 col-6 mb-3">
					<div class="noticia" style="background-image: url(<?=$ruta?>uploads/<?=$noticias_dat["SECC_chFOTSEC"]?>);">
						<div class="titulo">
							<?=$noticias_dat["SECC_chTITSEC"]?>
							<a href="<?=$ruta?><?=$noticias_dat["SECC_txURLSEC"]?>">Ver más >></a>
						</div>
					</div>
				</div>
<?php } ?>	
			</div>
		</div>
	</section>
	<section class="servicios">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row mb-5 pb-5">
						<div class="col-9">
							<h2 class="titulo">Nuestros Servicios</h2>
							<div class="subtitulo">MÁS RÁPIDO Y SENCILLO</div>
						</div>
					</div>
					<div class="row text-center mt-5">
<?php
$conteo=0;
$acceso = $db->select('*', 'm_enla', "where ENLA_intESTENL=1 and ENLA_intLUGENL=2 order by ENLA_P_inCODENL");
        while ($acceso_dat = $acceso->fetch_assoc()) {$conteo++;
if ($conteo==4 or $conteo==8) {
	echo '<div class="col-md-3 col-6 ocultar-movil"></div>';
}
?>
						<div class="col-md-3 col-6">
							<a href="<?=$acceso_dat["ENLA_chURLENL"]?>" target="<?=$acceso_dat["ENLA_chABRENL"]?>" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-aquanets" style="background-image: url(<?=$ruta?>uploads/<?=$acceso_dat["ENLA_chFOTENL"]?>)"></span>
						    	<h4><?=$acceso_dat["ENLA_chTITENL"]?></h4>
						    </a>
						</div>
<?php } ?>



					</div>
				</div>
				<div class="gota-sedapal"></div>
			</div>
		</div>
	</section>
	<section class="enlaces-externos">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="titulo">Enlaces externos</h3>
					<div class="enlaces">
						<div class="flecha-antes"></div>
						<div id="enlaces-externos-swiper" class="swiper-container">
						    <div class="swiper-wrapper">
<?php
$conteo=0;
$acceso = $db->select('*', 'm_enla', "where ENLA_intESTENL=1 and ENLA_intLUGENL=3 order by ENLA_P_inCODENL");
        while ($acceso_dat = $acceso->fetch_assoc()) {$conteo++;
if ($conteo==4 and $conteo==8) {
	echo '<div class="col-md-3 col-6 ocultar-movil"></div>';
}
?>
						        <div class="swiper-slide">
						        	<a href="<?=$acceso_dat["ENLA_chURLENL"]?>" target="<?=$acceso_dat["ENLA_chABRENL"]?>" title="<?=$acceso_dat["ENLA_chTITENL"]?>">
						        		<div class="enlaces-externos-item" style="background-image:url(<?=$ruta?>uploads/<?=$acceso_dat["ENLA_chFOTENL"]?>);"></div>
						        	</a>
						        </div>
<?php } ?>

						        
						    </div>
						</div>
						<div class="flecha-despues"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include "includes/footer.php";?>