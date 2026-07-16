<?php
require_once __DIR__ . "/../avaliacao.php";
require_once __DIR__ . "/../persistencia/PDOAvaliacaoProdutoDAO.php";

$produto_id = isset($_POST['produto_id']) ? $_POST['produto_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $produto_id != 0) {
    $objeto = new AvaliacaoProduto();
    $objeto->produto_id = $produto_id;
    $objeto->nome_usuario = isset($_POST['nome_usuario']) ? $_POST['nome_usuario'] : "";
    $objeto->nota = isset($_POST['nota']) ? $_POST['nota'] : 0;
    $objeto->comentario = isset($_POST['comentario']) ? $_POST['comentario'] : "";

    $dao = PDOAvaliacaoProdutoDAO::getInstance();
    $dao->inserir($objeto);
}

header("location: ../index.php?pagina=produto&id=" . $produto_id);
?>
