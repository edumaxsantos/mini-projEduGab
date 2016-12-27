<?php

class Vendas extends Produtos{
	private $data_venda;
	private $lista;
	private $preco_total;

	public function __construct() {
		//$this->lista = [];
	}

	public function setLista($lista) {
		$this->lista = $lista;
	}

	public function getLista() {
		return $this->lista;
	}

	public function getDataVenda() {
        return $this->data_venda;
    }

    public function setDataVenda($data_venda) {
        $this->data_venda = $data_venda;
    }

    public function getPrecoTotal() {
    	return $this->preco_total;
    }
    public function setPrecoTotal($preco_total) {
    	$this->preco_total = $preco_total;
    }
}
?>
