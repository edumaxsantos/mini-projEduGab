<?php
require'dao.php';

$produtoSQL = new sqlUsuario();
$produto = new Produtos();

//Pegar com POST
$id = addslashes($_POST['id']);
$nome = addslashes($_POST['nome']);
$categoria = addslashes($_POST['categoria']);
$quantidade = addslashes($_POST['quantidade']);
$data_compra = addslashes($_POST['data_compra']);
$fornecedor = addslashes($_POST['fornecedor']);
$preco = addslashes($_POST['preco']);

//Atribui valores ao objeto
$produto->setNome($nome);
$produto->setCategoria($categoria);
$produto->setQtd($quantidade);
$produto->setDataCompra($data_compra);
$produto->setFornecedor($fornecedor);
$produto->setPreco($preco);

//Verifica se produto é auterado
if($produtoSQL->Editar($produto,$id)){
	echo"<script> alert('Produto auterado com sucesso!');  history.back();</script>";
}
else{
	echo"<script> alert('Produto não auterado!');  history.back();</script>";
}
?>