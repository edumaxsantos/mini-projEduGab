<?php

class Vendas extends Produtos{
	private $data_venda;
	private $produtos_vendidos;
	private $preco_total;

	public function __construct() {
		$this->produtos_vendidos = [];
	}

	public function setProdutosVendidos($produto) {
		$this->produtos_vendidos[] = $produto;
	}

	public function getProdutosVendidos() {
		return $this->produtos_vendidos;
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
