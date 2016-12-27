<?php
// carrega classes
function __autoload ($class) {
	require_once("class/".$class.".class.php");
}

// cria objetos
$venda = new Vendas();
$vendaSql = new SqlVendas();

//pegar com post
$lista = addslashes($_POST['lista']);
var_dump($lista);
$lista = str_replace("\\", "", $lista);
var_dump($lista);
$lista =json_decode($lista);
var_dump($lista);

// para acessar um objeto especifico
var_dump($lista->{'1'});
//calcula preco final
$num = count($lista);
$x = 0;
$pf = 0;
while($x > $num){
	$vendasSql->Buscar($lista[$x][0]);
	$p = $vendas->getPreco();
	$pf .= $p*$lista[$x][1];
	$x++;
}

//Atribui valores ao objeto
$venda->setLista(json_encode($lista));
$venda->setDataVenda(date('Y-m-d'));
$venda->setPrecoTotal($pf);

//Envia para BD e retorna para outra pagina
$return = $vendaSql->InserirV($venda);
$teste = (substr($return, 0 ,8) ==  "SQLSTATE") ? ("<script> alert('Erro na compra, tente novamente');  </script>") : ("<script> alert('Compra realizada com sucesso!');</script>");
echo $teste;
?>
