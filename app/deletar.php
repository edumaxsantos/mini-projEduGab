<?php

require'dao.php';
//Cria objetos - comandos sql - atributos do produto
$produtoSQL = new sqlUsuario();
$produto = new Produtos();

//Pegar com POST
$id = addslashes($_POST['id']);

//Verifica se produto é excluido
if($produtoSQL->Deletar($id);){
	echo"<script> alert('Produto deletado com sucesso!');  history.back();</script>";
}
else{
	echo"<script> alert('Produto não deletado!');  history.back();</script>";
}
?>