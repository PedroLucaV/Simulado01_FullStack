<?php

class UsuarioService{
    private $conexao;
    private $usuario;

    public function __construct(Conexao $conexao, Usuario $usuario)
    {
        $this->conexao = $conexao->conectar();
        $this->usuario = $usuario;
    }

    public function getData(){
        $query = 'SELECT nickname, nome, id FROM usuarios where nickname = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue('id', $this->usuario->__get('id'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}