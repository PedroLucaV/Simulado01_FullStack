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
        $query = 'SELECT u.nickname, u.nome, u.id, u.foto, SUM(l.tipo_avaliacao = "up") AS likes_up, SUM(l.tipo_avaliacao = "down" ) AS likes_down
FROM usuarios as u
LEFT JOIN likes as l on (u.id = l.id_usuario)
where nickname = :id
GROUP BY u.id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue('id', $this->usuario->__get('id'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(){
        $query = 'SELECT id, nickname FROM usuarios';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}