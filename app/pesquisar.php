<?php
require'dao.php';
header('Content-Type: text/html; charset=utf-8');
//Cria objetos - comandos sql - atributos do produto
$produtoSQL = new sqlUsuario();
$produto = new Produtos();

//Pegar com POST
$id = addslashes($_REQUEST['id']);

//Atribui valores ao objeto
$produto->setId($id);
//Faz o select e mostra valores
$buscar = $produtoSQL->Buscar($id);
if($buscar){
	$ar = (array)$buscar;
	$json = json_encode($ar);
	$json = str_replace('\u0000', '', $json);
	$json = str_replace('*', '', $json);
	echo $json;
}
else{
	$json = "sem linha";
	echo json_encode($json);
}
?>
