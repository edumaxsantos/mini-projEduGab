<?php
class Produtos {
	private $id;
	private $nome;
	private $categoria;
	private $quantidade;
	private $data_compra;
	private $fornecedor;
	private $preco;

	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

	public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getQtd() {
        return $this->quantidade;
    }

    public function setQtd($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getDataCompra() {
        return $this->data_compra;
    }

    public function setDataCompra($data_compra) {
        $this->data_compra = $data_compra;
    }

    public function getFornecedor() {
        return $this->fornecedor;
    }

    public function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
}


?>