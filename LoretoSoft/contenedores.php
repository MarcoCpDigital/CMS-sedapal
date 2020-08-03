<?php
//error_reporting(0);
@header( "Content-Type: text/html; charset=utf-8", true );
require_once '../includes/database/db_config.php';
$db->conn();
include "../includes/comm2.php";
include "../includes/header.php";

$url_categoria=alfanumerico($_GET["loretosoft1"]);

$datos_cat = $db->select_one('*', 's_cate', "where CATE_inESTCAT='1' and CATE_chURLCAT='".$url_categoria."' ");

?>
    <section class="principal-noticias">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Noticias <span>sobre <?=$datos_cat["CATE_chTITCAT"];?></span></h3>
                    <p><?=$datos_cat["CATE_chDESCAT"];?></p>
                </div>
            </div>
<div id="loader2" class="text-center"> <img src="<?=$rutatheme?>img/loading.gif"></div>
<div class="row mt-4 outer_div_pag">
</div>


        </div>
    </section>

<?php include "../includes/footer.php" ?>
 <script type="text/javascript">
    url_web = "<?=$ruta?>";
  paginador(<?=$datos_cat["CATE_P_inCODCAT"]?>,1);
</script>