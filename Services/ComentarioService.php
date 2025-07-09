<?php

class ComentarioService{
    private $conexao;
    private $comentario;

    public function __construct(Conexao $conexao, ?Comentario $comentario = null)
    {
        $this->conexao = $conexao->conectar();
        $this->comentario = $comentario;
    }

    public function inserir()
    {
        $query = 'INSERT INTO comentarios (comentario, id_usuario, id_publicacao) VALUES (?, ?, ?)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->comentario->__get('comentario'));
        $stmt->bindValue(2, $this->comentario->__get('id_usuario'));
        $stmt->bindValue(3, $this->comentario->__get('id_post'));
        $stmt->execute();
    }

    public function getAll(){
        $query = 'SELECT c.id, c.comentario, u.nickname
FROM comentarios as c
LEFT JOIN usuarios as u on (c.id_usuario = u.id)
';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}