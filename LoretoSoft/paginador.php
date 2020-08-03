<?php
@header( "Content-Type: text/html; charset=utf-8", true );
require_once '../includes/database/db_config.php';
$db->conn();

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  if($action == 'ajax'){
    //las variables de paginación
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 15; //la cantidad de registros que desea mostrar
    $adjacents  = 3; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;

    //Cuenta el número total de filas de la tabla*/
  $count_query   = $db->select('count(*) AS numrows', 'm_secc', "where SECC_inESTSEC=1 and CATE_F_inCODCAT='".$_REQUEST['categoria']."' order by SECC_P_inCODSEC desc"); 
    

    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);

    //consulta principal para recuperar los datos
    $query = $db->select('*', 'm_secc', "where SECC_inESTSEC=1 and CATE_F_inCODCAT='".$_REQUEST['categoria']."' order by SECC_P_inCODSEC desc LIMIT $offset,$per_page");

    if ($numrows>0){
      while($categoria_dat = mysqli_fetch_array($query)){
?>
                <div class="col-md-4 col-6 mb-5">
                    <div class="noticia" style="background-image: url(<?=$ruta?>uploads/<?=$categoria_dat["SECC_chFOTSEC"]?>);">
                        <div class="titulo">
                            <?=$categoria_dat["SECC_chTITSEC"]?>
                            <a href="<?=$ruta?><?=$categoria_dat["SECC_txURLSEC"]?>">Ver más >></a>
                        </div>
                    </div>
                </div>
    <?php }?>

    <div class="col-sm-12"> 
      <?php echo paginateFront($reload, $page, $total_pages, $adjacents, $_REQUEST['categoria']);?>
    </div>
      <?php
      
    } else {
      ?>
      <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No existe información en esta categoría.
            </div>
      <?php
    }

 }
 