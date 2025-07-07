<?php

require_once ROOT_PATH.'/Config/Conexao.php';
require_once ROOT_PATH.'/Services/EmpresaService.php';
$conexao = new Conexao();

$empresaService = new EmpresaService($conexao);
$empresa = $empresaService->getData();