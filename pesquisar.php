<?php

require'dao.php';
//Cria objetos - comandos sql - atributos do produto
$produtoSQL = new sqlUsuario();
$produto = new Produtos();

//Pegar com POST
$id = addslashes($_POST['id']);

//Atribui valores ao objeto
$produto->setId($id);

//Faz o select e mostra valores
$buscar = $produtoSQL->Buscar($id);
if($buscar){
echo"Nome: ";
print_r($buscar->getNome());
echo"<br>";
echo"Categoria: ";
print_r($buscar->getCategoria());
echo"<br>";
echo"Quantidade: ";
print_r($buscar->getQtd());
echo"<br>";
echo"Data de compra: ";
print_r($buscar->getDataCompra());
echo"<br>";
echo"Fornecedor: ";
print_r($buscar->getFornecedor());
echo"<br>";
echo"Preço: ";
print_r($buscar->getPreco());
echo"<br>";
}
else{
	echo "sem linha";
}
?>