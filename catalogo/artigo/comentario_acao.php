<?php
require_once __DIR__ . "/../comentario.php";
require_once __DIR__ . "/../persistencia/PDOComentarioArtigoDAO.php";

$artigo_id = isset($_POST['artigo_id']) ? $_POST['artigo_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $artigo_id != 0) {
    $objeto = new ComentarioArtigo();
    $objeto->artigo_id = $artigo_id;
    $objeto->nome_usuario = isset($_POST['nome_usuario']) ? $_POST['nome_usuario'] : "";
    $objeto->comentario = isset($_POST['comentario']) ? $_POST['comentario'] : "";

    $dao = PDOComentarioArtigoDAO::getInstance();
    $dao->inserir($objeto);
}

header("location: ../index.php?pagina=artigo&id=" . $artigo_id);
?>
