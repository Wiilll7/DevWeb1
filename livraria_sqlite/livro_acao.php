<?php
require_once "livro.php";
require_once "persistencia/PDOLivroDAO.php";

define("DESTINO", "livro_list.php");

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
        'autor' => isset($_POST['autor']) ? $_POST['autor'] : "",
        'genero' => isset($_POST['genero']) ? $_POST['genero'] : "",
        'descricao' => isset($_POST['descricao']) ? $_POST['descricao'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Livro();
    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->autor = $array_dados['autor'];
    $elemento->genero = $array_dados['genero'];
    $elemento->descricao = $array_dados['descricao'];
    return $elemento;
}

function carregar($id)
{
    $dao = PDOLivroDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();
    $dao = PDOLivroDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);
    header("location:" . DESTINO);
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOLivroDAO::getInstance();
    $dao->excluir($id);
    header("location:" . DESTINO);
}

function salvar()
{
    $novo = tela2array();
    $dao = PDOLivroDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->inserir($objeto);
    header("location:" . DESTINO);
}
?>
