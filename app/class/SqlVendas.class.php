<?php

class SqlVendas extends SqlUsuario{

	public static $instance;

     function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DaoUsuario();

        return self::$instance;
    }

    //Metodo inserir
    public function InserirV(Vendas $vendas) {
    	try {
    		$sql = "insert into vendas (data,preco_total,lista) values (:data,:preco_total,:lista)";
    		$p_sql = Conexao::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $vendas->getDataVenda());
            $p_sql->bindValue(":preco_total", $vendas->getPrecoTotal());
            $p_sql->bindValue(":lista",$vendas->getLista());

            return $p_sql->execute();
        }catch (Exception $e) {
              //display custom message
              return $e->getMessage();
            }
	}

	//Metodo inserir
    public function BuscarV($id) {
        try {
            $sql = "select vendas.*,produtos.* from vendas,produtos where produtos.id = vendas.id_produto and vendas.id_venda = :id_venda";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id_venda", $id);
            $p_sql->execute();
            $numero = $p_sql->rowCount();
            if($numero > 0)
            return $this->populaUsuarioV($p_sql->fetch(PDO::FETCH_ASSOC));
        	else{
        		$r = False;
        		return $r;
        	}

        } catch (Exception $e) {
              //display custom message
                $r = False;
                return $r;
            }
	}

	private function populaUsuarioV($row) {
        $venda = new Vendas;
        $venda->setNome($row['nome']);
        $venda->setCategoria($row['categoria']);
        $venda->setQtd($row['quantidade']);
        $venda->setFornecedor($row['fornecedor']);
        $venda->setPreco($row['preco']);
        $venda->setDataCompra($row['data_compra']);
        $venda->setDataVenda($row['data']);
        $venda->setQtdVenda($row['quantidade_venda']);
        $venda->setPrecoTotal($row['preco_total']);
        return $produto;
    }
}
?>