<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and 
  $_GET["accion"]!="grabar" and 
  $_GET["accion"]!="editar" and 
  $_GET["accion"]!="actualizar" and 
  $_GET["accion"]!="cargar" and 
  $_GET["accion"]!="multimedia" and  
  $_GET["accion"]!="seleccionar"){
	header("Location: ".$rutaadmin."error/");
}
if ($_GET["accion"]=="cargar"){?>

        <div class="row">
          <!-- Filtro -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group row col-md-10 mb-0">
                      <label class="m-0 col-md-4 col-form-label float-left">¿Que menu deseas editar?</label>
                      <div class="col-md-8 float-left">
                        <select class="custom-select" id="menuseleccionado">
                          <option value="1">Principal</option>
                          <option value="2">Footer 1</option>
                          <option value="3">Footer 2</option>
                          <option value="4">Footer 3</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-2 mb-0">
                      <a id="editarMenu" class="btn btn-outline-primary btn-block">Cargar Menú</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Contenido -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="card border-primary mb-3">
                      <!-- <div class="card-header">Editar item de menu</div> -->
                        <div class="card-body">
                          <form id="frmEdit" class="form-horizontal">
                            <div class="form-group">
                              <label for="text">Texto</label>
                              <div class="input-group">
                                <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Texto">
                              </div>
                              <!-- <input type="text" name="icon" class="item-menu"> -->
                            </div>
                            <div class="form-group">
                              <label for="href">URL</label>
                              <input type="hidden" name="id_pag" id="id_pag">
                              <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                              <button type="button" onclick="modal_lg('<?=$rutaadmin?>paginas/seleccionar');"  class="btn btn-outline-primary mt-1 btn-block col-sm-6 float-left" >Elegir página</button>
                              <button type="button" onclick="modal_lg('<?=$rutaadmin?>categorias/seleccionar');"  class="btn btn-outline-primary mt-1 btn-block col-sm-6 float-left" >Elegir categoría</button>
                            </div>
                 <div class="form-group ">
                    <label for="abrir" class="col-sm-12 control-label">¿Cómo se abrirá?</label><br>
                    <div class="col-sm-12">
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Misma pestaña</option>
                                        <option value="_blank">Nueva pestaña</option>
                                    </select>
                    </div>
                </div>
                          </form>
                        </div>

                      <div class="card-footer">
                        <button type="button" id="btnUpdate" class="btn btn-outline-primary" disabled>Actualizar</button>
                        <button type="button" id="btnAdd" class="btn btn-primary">Agregar</button>
                        <button id="btnOutput" type="button" class="btn btn-outline-success"><i class="fas fa-check-square"></i> Guardar menú</button>

                      </div>
                    </div>
                  </div>
                  <div class="col-sm-8 sedapal-medu-editable">
                    <ul id="myEditor" class="sortableLists list-group">
                      <input type="hidden" id="prueba">
                    </ul>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

<script type="text/javascript">

var sortableListOptions = {
    placeholderCss: {'background-color': "#cccccc"}
};
var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions});
editor.setForm($('#frmEdit'));
editor.setUpdateButton($('#btnUpdate'));
// Metodo para actualizar
$("#btnUpdate").click(function(){

    if ($("#text").val()=='') {
      Swal.fire('Error!','Debe ingresar un texto','error');
    }else{
    editor.update();
      $('#btnAdd').attr("disabled", false);
    } 
  

});


// Metodo para crear
$('#btnAdd').click(function(){

  if ($("#prueba").val()=='') {
    Swal.fire('Error!','Debe seleccionar un menu','error');
  }else{
    if ($("#text").val()=='') {
      Swal.fire('Error!','Debe ingresar un texto','error');
    }else{
      editor.add();
    }
  }

}); 

    //cargar menu dependiendo tipo
    $('#editarMenu').click(function(){
            var tipomenu = $("#menuseleccionado option:selected").val();
            var urlactual = ""+url_web+"menu/seleccionar/"+tipomenu+"";

            $.ajax({
                url:urlactual,
                 beforeSend: function(objeto){
                 $('#myEditor').html('<img src="'+url_web+'theme/system/dist/img/loading.gif" style="width:15px; height:15px"> Cargando...');
              },
                success:function(data){
                    editor.setData(data)
                    }
            })
   }); 


$('#btnOutput').on('click', function () {

var str = editor.getString();
var tipomenu = $("#menuseleccionado option:selected").val();
var urlactual = ""+url_web+"menu/guardar/"+tipomenu+"";

    $.ajax({
        type: "POST",
        url: urlactual,
        data: "data="+str,
         beforeSend: function(objeto){
          $('#myEditor').html('<img src="'+url_web+'theme/system/dist/img/loading.gif" style="width:15px; height:15px"> Cargando...');
          },
        success: function(datos1){
    // data = jQuery.parseJSON(datos1);
    // console.log(datos1);
    // if(datos1["success"]==false){
    //   Swal.fire('Error!',''+datos1["message"]+'','error');
    // }else{
    //   Swal.fire('Exito!',''+datos1["message"]+'','success');
    // }
          editor.setData(str)

        }
            });

});

</script>

<?php }

//para seleccionar datos de menu
if ($_GET["accion"]=="seleccionar"){

$secc_item = $db->select_one('*', 'm_menu', "where MENU_inTIPMENU='".$id."' ");

if($secc_item->num_rows!='0'){

$var =  json_decode($secc_item["MENU_txJSOMEN"]);
echo json_encode($var);

}

} 

//grabamos data del menu
if ($_GET["accion"]=="guardar"){

$data = array(
    'MENU_txJSOMEN' => "".$_POST["data"]."",
  );
if ($db->update('m_menu', $data, 'WHERE MENU_inTIPMENU="'.$id.'"')) {
      echo '{"success": true, "message": "Menu guardado con éxitos."}';
}else{
      echo '{"success": false, "message": "Error al guardar menú."}';
}

}





