<?php
class Anuncio {
    public $codigo;
    public $titulo;
    public $descricao;
    public $preco;
    public $data_hora;
    public $cep;
    public $bairro;
    public $cidade;
    public $estado;
    public $codigo_categoria;
    public $codigo_anunciante;

    public __construct($codigo, $titulo, $descricao, $preco, $data_hora, $cep, $bairro, $cidade, $estado, $codigo_categoria, $codigo_anunciante){
        $this->$codigo = $codigo;
        $this->$titulo = $titulo;
        $this->$descricao = $descricao;
        $this->$preco = $preco;
        $this->$data_hora = $data_hora;
        $this->$cep = $cep;
        $this->$bairro = $bairro;
        $this->$cidade = $cidade;
        $this->$estado = $estado;
        $this->$codigo_categoria = $codigo_categoria;
        $this->$codigo_anunciante = $codigo_anunciante;
    }
}
?>