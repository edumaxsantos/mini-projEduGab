<?php
function __autoload ($class) {
 require_once("class/".$class.".class.php");
 }
header('Content-Type: text/html; charset=utf-8');

//Cria objetos
$vendas = new Vendas();
$vendasSql = new SqlVendas();

//Pegar com POST
$id = addslashes($_REQUEST['id']);

//Faz o select e mostra valores
$buscar = $vendasSql->BuscarV($id);
if($buscar){
	$ar = (array)$buscar;
	//$json = json_encode($ar);

	//echo str_replace('"', '', substr($json, strripos($json, 'Vendaslista":"['), strstr($json, ']","Vendaspreco_total"')));
	$json = json_encode($ar);
	$json = str_replace('\u0000', '', $json);
	$json = str_replace('*', '', $json);
	$json = str_replace('\\', '', $json);
	$json = str_replace(':"[', ':[', $json);
	$json = str_replace('}]",', '}],', $json);
	echo $json;
}
else{
	$json = "sem linha";
	echo json_encode($json);
}