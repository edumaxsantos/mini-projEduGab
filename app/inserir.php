<?php

require'dao.php';
//Cria objetos - comandos sql - atributos do produto
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
//var_dump($_POST);
//Atribui valores ao objeto
$produto->setId($id);
$produto->setNome($nome);
$produto->setCategoria($categoria);
$produto->setQtd($quantidade);
$produto->setDataCompra(dataBd($data_compra));
$produto->setFornecedor($fornecedor);
$produto->setPreco($preco);

//Verifica se produto é inserido
$return = $produtoSQL->Inserir($produto);
$teste = (substr($return, 0 ,8) ==  "SQLSTATE") ? ("<script> alert('Erro ao inserir, tente novamente');  history.back();</script>") : ("<script> alert('Produto inserido com sucesso!');  history.back();</script>");
echo $teste;
/*

//$h = $produto->getNome();
//echo$h."<br>";
//$produtoSQL->Inserir($produto);
$produto->setNome("nome5");
$produto->setCategoria(5);
$id = 5;
//$produtoSQL->Editar($produto,$id);
$g = $produtoSQL->Buscar('6');
if($g){
print_r($g->getNome());
echo"<br>";
print_r($g->getCategoria());
}
else{
	echo "sem linha";
}
//$produtoSQL->Deletar(4);
/*require_once 'conexao.php';
$statement = $dbh->query("SELECT * FROM produtos");
while($categoria = $statement->fetch()){
	echo$categoria['id']."<br>";
}
require'dao.php';
$produtoSQL = new sqlUsuario();
$produto = new Produtos();
$x = $produtoSQL->teste($dbh);

foreach ($x as $value) {
	echo$value['id']."<br>";
}*/
?>
