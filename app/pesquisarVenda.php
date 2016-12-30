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
	$t = $buscar->getLista();
	$x = json_decode($t);
	foreach ($x as $key => $value) {
		$obj = $x[$key];
		$v = get_object_vars($obj);
		//$k = $t[$key];
		$k = key($v);
		$b = $vendasSql->Buscar($k);
		$n[] = $b->getNome();

	}
	$m = json_encode($n);
	$buscar->setNome($m);
	$ar = (array)$buscar;
	$json = json_encode($ar);
	$json = str_replace('\u0000', '', $json);
	$json = str_replace('*', '', $json);
	$json = str_replace('\\', '', $json);
	$json = str_replace(':"[', ':[', $json);
  	$json = str_replace(']"', ']', $json);
	$json = str_replace('}]",', '}],', $json);
	echo $json;
}
else{
	$json = "sem linha";
	echo json_encode($json);
}
