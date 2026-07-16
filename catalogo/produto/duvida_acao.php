<?php
require_once __DIR__ . "/../duvida.php";
require_once __DIR__ . "/../persistencia/PDODuvidaProdutoDAO.php";

$produto_id = isset($_POST['produto_id']) ? $_POST['produto_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $produto_id != 0) {
    $objeto = new DuvidaProduto();
    $objeto->produto_id = $produto_id;
    $objeto->nome_usuario = isset($_POST['nome_usuario']) ? $_POST['nome_usuario'] : "";
    $objeto->pergunta = isset($_POST['pergunta']) ? $_POST['pergunta'] : "";

    $dao = PDODuvidaProdutoDAO::getInstance();
    $dao->inserir($objeto);
}

header("location: ../index.php?pagina=produto&id=" . $produto_id);
?>
