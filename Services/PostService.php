<?php

class PostService{
    private $conexao;

    public function __construct(Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
    }

    public function getData(){
        $query = 'SELECT p.id_publicacao, p.foto, p.local, p.cidade, p.titulo_prato, COUNT(c.comentario) as comentarios, SUM(l.tipo_avaliacao = "up") AS likes_up,SUM(l.tipo_avaliacao = "down" ) AS likes_down
FROM publicacao as p
left join comentarios as c on (p.id_publicacao = c.id_publicacao)
left join likes as l on (p.id_publicacao = l.id_publicacao)
GROUP BY p.id_publicacao
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
}