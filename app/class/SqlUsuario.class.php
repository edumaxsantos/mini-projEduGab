<?php
//transforma data para data BR
function dataBr($data)
      {
          $data = implode('/', array_reverse(explode('-', $data)));

          return $data;
      }
//transforma data para data do BD
function dataBd($data)
      {
          $data = implode('-', array_reverse(explode('/', $data)));

          return $data;
      }

class SqlUsuario {
    public static $instance;

     function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DaoUsuario();

        return self::$instance;
    }

    //Medtodo inserir
    public function Inserir(Produtos $produto) {
    	try {
    		$sql = "insert into produtos (id,nome,categoria,quantidade,data_compra,fornecedor,preco) values (:id,:nome,:categoria,:quantidade,:data,:fornecedor,:preco)";
    		$p_sql = Conexao::getInstance()->prepare($sql);

    		$p_sql->bindValue(":id", $produto->getId());
            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":categoria", $produto->getCategoria());
            $p_sql->bindValue(":quantidade", $produto->getQtd());
            $p_sql->bindValue(":data", $produto->getDataCompra());
            $p_sql->bindValue(":fornecedor", $produto->getFornecedor());
            $p_sql->bindValue(":preco", $produto->getPreco());


            return $p_sql->execute();
        }catch (Exception $e) {
              //display custom message
              return $e->getMessage();
            }
	}

	//Medtodo update
   	public function Editar(Produtos $produto,$id) {
        try {
            $sql = "update produtos set nome = :nome, categoria = :categoria, quantidade = :quantidade, data_compra = :data, fornecedor = :fornecedor, preco = :preco where id = :id";

            $p_sql = Conexao::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":categoria", $produto->getCategoria());
            $p_sql->bindValue(":quantidade", $produto->getQtd());
            $p_sql->bindValue(":data", $produto->getDataCompra());
            $p_sql->bindValue(":fornecedor", $produto->getFornecedor());
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":id", $id);

            return $p_sql->execute();
        } catch (Exception $e) {
              //display custom message
              return $e->getMessage();
            }
   	}

    //Medtodo update quantidade
    public function EditarQ(Produtos $produto,$id) {
        try {
            $sql = "update produtos set quantidade = :quantidade where id = :id";

            $p_sql = Conexao::getInstance()->prepare($sql);

            $p_sql->bindValue(":quantidade", $produto->getQtd());
            $p_sql->bindValue(":id", $id);

            return $p_sql->execute();
        } catch (Exception $e) {
              //display custom message
              return $e->getMessage();
            }
    }
   	//Medtodo inserir
   	public function Deletar($id) {
        try {
            $sql = "delete from produtos where id = :id";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);

            return $p_sql->execute();
        }catch (Exception $e) {
              //display custom message
              return $e->getMessage();
            }
    }

    //Medtodo select
    public function Buscar($id) {
        try {
            $sql = "select * from produtos where id = :id";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            $numero = $p_sql->rowCount();
            if($numero > 0)
            return $this->populaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
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
    private function populaUsuario($row) {
        $produto = new Produtos;
        $produto->setNome($row['nome']);
        $produto->setCategoria($row['categoria']);
        $produto->setQtd($row['quantidade']);
        $produto->setFornecedor($row['fornecedor']);
        $produto->setPreco($row['preco']);
        $produto->setDataCompra($row['data_compra']);
        return $produto;
    }

}
