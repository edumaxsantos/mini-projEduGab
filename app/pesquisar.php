<?php
require'dao.php';
header('Content-Type: text/html; charset=utf-8');
//Cria objetos - comandos sql - atributos do produto
$produtoSQL = new sqlUsuario();
$produto = new Produtos();

function objectToArray( $object )
    {
        if( !is_object( $object ) && !is_array( $object ) )
        {
            return $object;
        }
        if( is_object( $object ) )
        {
            $object = get_object_vars( $object );
        }
				$v = array_map('objectToArray', $object);
				print_r($v);
        return $v;
    }


//Pegar com POST
$id = addslashes($_REQUEST['id']);

//Atribui valores ao objeto
$produto->setId($id);
//Faz o select e mostra valores
$buscar = $produtoSQL->Buscar($id);
if($buscar){
	$ar = (array)$buscar;
	$json = json_encode($ar);
	$json = explode('\u0000', $json);
	foreach ($json as $key => $value) {
		$json[$key] = explode('*', $value);
	}
	foreach($json as $key => $value) {
		$json[$key] = implode('', $value);
	}
	$json = implode('',$json);

	echo $json;
/*echo"Nome: ";
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
*/
}
else{
	echo "sem linha";
}
?>
