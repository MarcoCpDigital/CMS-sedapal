
<body class="sedapal inicio">
	<section class="precabecera">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-12">
					<div class="aquafono">
						<div class="texto">AQUAFONO</div>
						<div class="numero">317-8000</div>
					</div>
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
				<div class="col-md-6 ocultar-movil">
					<div class="portal-transparencia text-right">
						<div class="texto">
							<a href="#">
								Portal de Transparencia
								<i class="sepapal-lupa-inv"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="cabecera">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-2 col-6">
					<a href="#" class="">
						<img class="img-fluid my-3 logo-sedapal" src="<?=$rutatheme?>img/logo-sedapal-blanco.png">
					</a>
				</div>
				<div class="col-md-9 text-center ocultar-movil">
					<nav>
						<ul class="mb-0">
<?php 
$menu_principal = $db->select_one('*', 'm_menu', "where MENU_inTIPMENU='1' ");
 $array_menu = json_decode($menu_principal["MENU_txJSOMEN"],true);
foreach($array_menu as $obj_menu){
	if ($obj_menu["children"]!=null) {?>
							<li class="dropdown">
								<a href="<?=$obj_menu["href"]?>"><?=$obj_menu["text"]?></a></span>
								<ul class="submenu">
				<?php foreach($obj_menu["children"] as $obj_submenu1){
				if ($obj_submenu1["children"]!=null) {?>
									<li class="dropdown">
										<a href="<?=$obj_submenu1["href"]?>" target="<?=$obj_submenu1["target"]?>"><?=$obj_submenu1["text"]?></a></span>
										<ul class="submenu">
				<?php foreach($obj_submenu1["children"] as $obj_submenu2){?>	
											<li><a href="<?=$obj_submenu2["href"]?>" target="<?=$obj_submenu2["target"]?>"><?=$obj_submenu2["text"]?></a></li>
				<?php } ?>
										</ul>
									</li>
				<?php }else{?>
									<li><a href="<?=$obj_submenu1["href"]?>" target="<?=$obj_submenu1["target"]?>"><?=$obj_submenu1["text"]?></a></li>
				<?php }
			} ?>
								</ul>
							</li>
	<?php }else{
	?>
							<li><a href="<?=$obj_menu["href"]?>" target="<?=$obj_menu["target"]?>"><?=$obj_menu["text"]?></a></li>
<?php 
			}
}
?>
						</ul>
					</nav>
					<form>
						<img class="img-fluid" src="<?=$rutatheme?>img/lupa-sedapal.png">
						<input type="text" name="">
					</form>
				</div>
				<div class="col-md-1 text-center col-6">
					<div class="menu-hamburguesa">
						<i class="sepapal-menu"></i>
					</div>
				</div>
			</div>
		</div>
	</section>