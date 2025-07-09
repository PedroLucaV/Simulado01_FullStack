<?php

class Comentario
{
    private string $id_usuario;
    private string $id_post;
    private string $comentario;

    public function __construct(string $id_usuario, string $id_post, string $comentario){
        $this->id_usuario = $id_usuario;
        $this->id_post = $id_post;
        $this->comentario = $comentario;
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