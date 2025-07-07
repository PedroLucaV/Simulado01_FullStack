<?php

class EmpresaService{
    private $conexao;
    private $empresa;

    public function __construct(Conexao $conexao, Empresa $empresa = null)
    {
        $this->conexao = $conexao->conectar();
        $this->empresa = $empresa;
    }

    public function getData(){
        $query = 'SELECT * FROM empresa';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}