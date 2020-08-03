	<section class="footer">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-3">
					<div class="menu">
						<h4>Título menú footer 1</h4>
						<div class="contenido-menu">
							<ul>
								<li><a href="#">Enlace con bullet</a></li>
								<li><a href="#">Enlace con bullet</a></li>
								<li><a href="#">Enlace con bullet</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="menu">
						<h4>Título menú footer 2</h4>
						<div class="contenido-menu">
							<ul>
								<li><a href="#">Enlace con bullet</a></li>
								<li><a href="#">Enlace con bullet</a></li>
								<li><a href="#">Enlace con bullet</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="menu">
						<h4>Título menú footer 3</h4>
						<div class="contenido-menu">
							<ul>
								<li><a href="#">Enlace con bullet</a></li>
								<li><a href="#">Enlace con bullet</a></li>
								<li><a href="#">Enlace con bullet</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<a href="#">
						<img src="<?=$rutatheme?>img/libro.png" class="img-fluid">
					</a>
				</div>
			</div>
			<div class="row subfooter pt-4 align-items-center">
				<div class="col-md-4 order-3 order-md-1">
					<div class="sedapal-creditos">
						© Sedapal 2020
					</div>
				</div>
				<div class="col-md-4 order-1 order-md-2">
					<div class="aquafono">
						<div class="texto">AQUAFONO</div>
						<div class="numero">317-8000</div>
					</div>
				</div>
				<div class="col-md-4 order-2 order-md-3">
					<div class="social-sepadal">
						<a href="#">
							<i class="sepapal-facebook"></i>
						</a>
						<a href="#">
							<i class="sepapal-youtube"></i>
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
		</div>
	</section>

	<section class="menu-fullpage">
		<div class="container">
			<div class="row">
				<div class="col-md-6 order-last order-md-1">
					<h2 class="mb-5">CENTRO DE AYUDA</h2>
					<div class="row">
						<div class="col-md-4 col-4">
							<a href="#" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-aquanet"></span>
						    	<h4>Aquanet</h4>
						    </a>
						</div>
						<div class="col-md-4 col-4">
							<a href="#" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-recibo"></span>
						    	<h4>Recibo Digital</h4>
						    </a>
						</div>
						<div class="col-md-4 col-4">
							<a href="#" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-sedapal-movil"></span>
						    	<h4>Sedapal Movil</h4>
						    </a>
						</div>
						<div class="col-md-4 col-4">
							<a href="#" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-aquanet"></span>
						    	<h4>Aquanet</h4>
						    </a>
						</div>
						<div class="col-md-4 col-4">
							<a href="#" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-recibo"></span>
						    	<h4>Recibo Digital</h4>
						    </a>
						</div>
						<div class="col-md-4 col-4">
							<a href="#" class="sedapal-cuadro-icono">
						    	<span class="sedapaluser-sedapal-movil"></span>
						    	<h4>Sedapal Movil</h4>
						    </a>
						</div>
					</div>
				</div>
				<div class="col-md-2">
				</div>
				<div class="col-md-4 order-first order-md-2">
					<div id="cerrar-menu" class="mb-5 text-right">x</div>
					<h3>¿Más ayuda?</h3>
					<ul>
						<li><a href="#">Opción de menú textual</a></li>
						<li><a href="#">Máximo 4 palabras</a></li>
						<li><a href="#">Creación de menús automático</a></li>
						<li><a href="#">Según se van agregando</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Javascript jQuery,Popper, Bootstrap-->
	<script type="text/javascript" src="<?=$rutatheme?>js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="<?=$rutatheme?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?=$rutatheme?>js/bootstrap.min.js"></script>
	<!-- Swiper JS -->
	<script type="text/javascript" src="<?=$rutatheme?>js/swiper.min.js"></script>
	<!-- Sedapal JS -->
	<script type="text/javascript" src="<?=$rutatheme?>js/sedapal.js"></script>
	<!-- Iniciar -->
	<script type="text/javascript">
		$(document).ready(function () {
			var principalSwiper = new Swiper ('#principal-swiper', {
				loop: true,
				slidesPerView:1,
				navigation: {
				    nextEl: '.swiper-button-next',
				    prevEl: '.swiper-button-prev',
				},
			});
		});

		$(document).ready(function () {
			var accesosRapidosSwiper = new Swiper ('#accesos-rapidos-swiper', {
				loop: true,
				slidesPerView:  2,
				spaceBetween: 20,
				breakpoints: {
			        480: {
			        	slidesPerView: 2,
			        	spaceBetween: 20,
			        },
			        768: {
			        	slidesPerView: 3,
			        	spaceBetween: 20,
			        },
			        1024: {
			        	slidesPerView: 3,
			        	spaceBetween: 30,
			        },
			        1200: {
			        	slidesPerView: 4,
			        	spaceBetween: 50,	
			        }
		      	}
			})
	
			$(".flecha-antes").click(function(){
				accesosRapidosSwiper.slidePrev();
			});
			$(".flecha-despues").click(function(){
				accesosRapidosSwiper.slideNext();
			});
		});

		$(document).ready(function () {
			var noticiasSwiper = new Swiper ('#noticias-swiper', {
				loop: false,
				slidesPerView:  1,
			})
		});

		$(document).ready(function () {
			var enlacesExternosSwiper = new Swiper ('#enlaces-externos-swiper', {
				loop: true,
				slidesPerView:  2,
				spaceBetween: 16,
				breakpoints: {
			        480: {
			        	slidesPerView: 2,
			        	spaceBetween: 16,
			        },
			        768: {
			        	slidesPerView: 3,
			        	spaceBetween: 16,
			        },
			        1024: {
			        	slidesPerView: 3,
			        	spaceBetween: 16,
			        },
			        1200: {
			        	slidesPerView: 4,
			        	spaceBetween: 16,	
			        }
		      	}
			})
	
			$(".enlaces-externos .flecha-antes").click(function(){
				enlacesExternosSwiper.slidePrev();
			});
			$(".enlaces-externos .flecha-despues").click(function(){
				enlacesExternosSwiper.slideNext();
			});
		});

	</script>

</body>
</html>