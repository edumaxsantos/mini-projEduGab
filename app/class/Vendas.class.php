<?php

class Vendas extends Produtos{
	private $data_venda;
	private $qtd_venda;
	private $preco_total;


	public function getDataVenda() {
        return $this->data_venda;
    }

    public function setDataVenda($data_venda) {
        $this->data_venda = $data_venda;
    }

    public function getQtdVenda() {
    	return $this->qtd_venda;
    }
    public function setQtdVenda($qtd_venda) {
    	$this->qtd_venda = $qtd_venda;
    }

    public function getPrecoTotal() {
    	return $this->preco_total;
    }
    public function setPrecoTotal($preco_total) {
    	$this->preco_total = $preco_total;
    }
}
?>