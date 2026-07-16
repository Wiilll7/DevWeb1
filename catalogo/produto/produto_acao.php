<?php
require_once __DIR__ . "/../produto.php";
require_once __DIR__ . "/../persistencia/PDOProdutoDAO.php";

define("DESTINO", "../index.php?pagina=produto");

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
        'nome' => isset($_POST['nome']) ? $_POST['nome'] : "",
        'categoria' => isset($_POST['categoria']) ? $_POST['categoria'] : "",
        'descricao' => isset($_POST['descricao']) ? $_POST['descricao'] : "",
        'preco' => isset($_POST['preco']) ? $_POST['preco'] : 0,
        'imagem' => isset($_POST['imagem']) ? $_POST['imagem'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Produto();
    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->categoria = $array_dados['categoria'];
    $elemento->descricao = $array_dados['descricao'];
    $elemento->preco = $array_dados['preco'];
    $elemento->imagem = $array_dados['imagem'];
    return $elemento;
}

function carregar($id)
{
    $dao = PDOProdutoDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();
    $dao = PDOProdutoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);
    header("location:" . DESTINO);
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOProdutoDAO::getInstance();
    $dao->excluir($id);
    header("location:" . DESTINO);
}

function salvar()
{
    $novo = tela2array();
    $dao = PDOProdutoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->inserir($objeto);
    header("location:" . DESTINO);
}
?>
