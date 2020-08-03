<?php 

$data = '
[
    {
        "type": "number",
        "required": false,
        "label": "Numero",
        "className": "form-control",
        "name": "number-1595316693019",
        "access": false
    },
    {
        "type": "text",
        "required": false,
        "label": "nombre",
        "className": "form-control",
        "name": "number-1595316693019",
        "access": false
    },
    {
        "type": "number",
        "required": false,
        "label": "telefono",
        "className": "form-control",
        "name": "number-1595316693019",
        "access": false
    }
]
';

$texto = ' adc efc erfv ed fvber fgv erfv erv erfv erv erv error_repor
f dg svn_repos_fs_begin_txn_fommit(r tgbr 
tg 
r tgbr t , rev, author, log_ms
[form="6"]
';

echo "<br>";
$findme = '[form="';
if (strpos($data, $findme) != 1) {
  echo $xcadena = str_replace($findme, crearForm($data), $texto);
}

echo "<br>";


;


function crearForm($data){

$products = json_decode($data, true);

echo "<form>";

foreach ($products as $product) {

echo '<label>'.$product["label"].' </label>';
echo '<input type="'.$product["type"].'" name="'.$product["name"].'" class="'.$product["className"].'">';
}

echo "</form>";


} 
?>