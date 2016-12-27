<?php
// carrega classes
function __autoload ($class) {
	require_once("class/".$class.".class.php");
}

// cria objetos
$vendas = new Vendas();
$vendasSql = new SqlVendas();

//pegar com post
$lista = addslashes($_POST['lista']);
// tirar /
$lista = str_replace("\\", "", $lista);
// tirar do formato json
$lista =json_decode($lista);
//tranforma em array
$list = (array)$lista;
$x = 0;
$pf = 0;
//calcula preco final
foreach ($list as $value) {
	$lis = array_shift($list);
	$l = (array)$lis;
	foreach ($l as $key => $value) {
		$ar[] = $l;
		$b = $vendasSql->Buscar($key);
		$b = (array)$b;
		$b2 = json_encode($b);
		$b2 = str_replace('\u0000', '', $b2);
		$b2 = str_replace('*', '', $b2);
		$b2 = json_decode($b2);
		$b2 = (array)$b2;
		$p = $b2['preco'];
		//echo $ar[$x][$key];
		if($p != 0)
		$pf += $p*$ar[$x][$key];
	}
	$x++;
}
// codifica o array em json novamente
$a = json_encode($ar);

//Atribui valores ao objeto
$vendas->setLista($a);
$vendas->setDataVenda(date('Y-m-d'));
$vendas->setPrecoTotal($pf);

//Envia para BD e retorna para outra pagina
$return = $vendasSql->InserirV($vendas);
$teste = (substr($return, 0 ,8) ==  "SQLSTATE") ? ("<script> alert('Erro na compra, tente novamente'); history.back(); </script>") : ("<script> alert('Compra realizada com sucesso!' history.back(););</script>");
echo $teste;
?>
