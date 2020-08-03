// Menu
$(".menu-hamburguesa").click(function(){
	$(".menu-fullpage").toggle("abierto");
});

$(".submenu").hide();
// $("nav ul li").hover(function(){
// 	$(this).parent().find(".submenu:first").toggle("inline-grid");
// });
$("nav ul li").hover(function () {
    $(this).children(".submenu:first").slideDown().show();
}, function () {
    $(this).children(".submenu:first").slideUp();
});

$(".desplegable").click(function(){
	$(this).parent().find(".submenu:first").toggle("abierto");
	$(this).parent().find(".desplegable").toggleClass("abierto");
});

// Footer
if (screen.width<768){
	$(".contenido-menu").hide();
	$(".menu h4").click(function(){
		$(this).parent().find(".contenido-menu").toggle();
		$(this).parent().find("h4").toggleClass("abierto");
	});
}

function abrirbanner()
        {

$(document).ready(function(){
  $('.boton_banner').trigger('click');
});

}


function paginador(categoria, page){

		var parametros = {"action":"ajax","page":page,"categoria":categoria};
		$("#loader2").fadeIn('slow');
		$.ajax({

        type: "POST",
			url: ""+url_web+"paginador",
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader2").html('<img src="'+url_web+'theme/system/img/loading.gif"> Cargando...');
			},
			success:function(data){
		console.log(data);
				$(".outer_div_pag").html(data).fadeIn('slow');
				$("#loader2").html("");
			

			}

		})
	}
