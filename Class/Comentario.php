<?php

class Comentario
{
    private $id;
    private string $id_usuario;
    private string $id_post;
    private string $comentario;

    public function __construct(?string $id_usuario = null, ?string $id_post = null, ?string $comentario = null, ?int $id = null){
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