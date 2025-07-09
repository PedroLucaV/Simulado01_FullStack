<?php

class Comentario
{
    private $id;
    private $id_usuario;
    private $id_post;
    private $comentario;

    public function __construct($id_usuario = null, $id_post = null, $comentario = null, ?int $id = null){
        $this->id_usuario = $id_usuario;
        $this->id_post = $id_post;
        $this->comentario = $comentario;
        $this->id = $id;
    }
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}