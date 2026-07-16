<?php
require_once __DIR__ . "/../artigo.php";
require_once __DIR__ . "/../persistencia/PDOArtigoDAO.php";

define("DESTINO", "../index.php?pagina=artigo");

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}

switch ($acao) {
    case 'Salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'excluir':
        excluir();
        break;
}

function tela2array()
{
    $novo = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : 0,
        'titulo' => isset($_POST['titulo']) ? $_POST['titulo'] : "",
        'resumo' => isset($_POST['resumo']) ? $_POST['resumo'] : "",
        'conteudo' => isset($_POST['conteudo']) ? $_POST['conteudo'] : "",
        'imagem' => isset($_POST['imagem']) ? $_POST['imagem'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Artigo();
    $elemento->id = $array_dados['id'];
    $elemento->titulo = $array_dados['titulo'];
    $elemento->resumo = $array_dados['resumo'];
    $elemento->conteudo = $array_dados['conteudo'];
    $elemento->imagem = $array_dados['imagem'];
    return $elemento;
}

function carregar($id)
{
    $dao = PDOArtigoDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();
    $dao = PDOArtigoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);
    header("location:" . DESTINO);
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOArtigoDAO::getInstance();
    $dao->excluir($id);
    header("location:" . DESTINO);
}

function salvar()
{
    $novo = tela2array();
    $dao = PDOArtigoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->inserir($objeto);
    header("location:" . DESTINO);
}
?>
