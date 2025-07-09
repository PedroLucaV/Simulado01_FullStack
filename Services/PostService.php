<?php

class PostService{
    private $conexao;

    public function __construct(Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
    }

    public function getData(){
        $query = 'SELECT 
    p.id_publicacao,
    p.foto,
    p.local,
    p.cidade,
    p.titulo_prato,
    (SELECT COUNT(*) FROM comentarios c WHERE c.id_publicacao = p.id_publicacao) AS comentarios,
    (SELECT COUNT(*) FROM likes l WHERE l.id_publicacao = p.id_publicacao AND l.tipo_avaliacao = "up") AS likes_up,
    (SELECT COUNT(*) FROM likes l WHERE l.id_publicacao = p.id_publicacao AND l.tipo_avaliacao = "down") AS likes_down
FROM publicacao p
;';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLikes(){
        $query = 'SELECT COUNT(tipo_avaliacao) from likes where tipo_avaliacao = "up"';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verifyLike($id, $type){
        $query = 'SELECT id_usuario FROM likes WHERE id_publicacao = :id and tipo_avaliacao = :tipoAva';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':tipoAva', $type);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like($id, $type, $idU){
        $query = 'INSERT into likes(tipo_avaliacao, id_usuario, id_publicacao) values(?, ?, ?)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $type);
        $stmt->bindValue(2, $idU);
        $stmt->bindValue(3, $id);
        return $stmt->execute();
    }

    public function unlike($id, $idU, $type)
    {
        $query = 'DELETE from likes where id_usuario=? and id_publicacao =? and tipo_avaliacao=?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idU);
        $stmt->bindValue(2, $id);
        $stmt->bindValue(3, $type);
        return $stmt->execute();
    }

    public function getLike($idPost, $idUser)
    {
        $query = 'SELECT tipo_avaliacao FROM likes WHERE id_usuario = ? AND id_publicacao = ? LIMIT 1';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idUser);
        $stmt->bindValue(2, $idPost);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['tipo_avaliacao'] : null;
    }

    public function getById($idPost){
        $query = 'SELECT 
    p.id_publicacao,
    p.foto,
    p.local,
    p.cidade,
    p.titulo_prato,
    (SELECT COUNT(*) FROM comentarios c WHERE c.id_publicacao = p.id_publicacao) AS comentarios,
    (SELECT COUNT(*) FROM likes l WHERE l.id_publicacao = p.id_publicacao AND l.tipo_avaliacao = "up") AS likes_up,
    (SELECT COUNT(*) FROM likes l WHERE l.id_publicacao = p.id_publicacao AND l.tipo_avaliacao = "down") AS likes_down
FROM publicacao p
WHERE p.id_publicacao = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idPost);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}