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
        'id' => isset($_POST['id']) ? $_POST['id'] : date("YmdHis"),
        'nome' => isset($_POST['nome']) ? $_POST['nome'] : "",
        'descricao' => isset($_POST['descricao']) ? $_POST['descricao'] : ""
    );
    if ($novo['id'] == "0") {
        $novo['id'] = date("YmdHis");
    }
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Livro();

    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->descricao = $array_dados['descricao'];

    return $elemento;
}

function objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'nome' => (string) $elemento->nome,
        'descricao' => (string) $elemento->descricao
    );

    return $dado;
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

    $dao = PDOlivroDAO::getInstance();
    $objeto = array2objeto($novo);
    $dados = $dao->alterar($objeto);


    header("location:" . DESTINO);

}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOLivroDAO::getInstance();
    $dados = $dao->excluir($id);

    header("location:" . DESTINO);

}

function salvar()
{
    $xml = NULL;
    $novo = tela2array();

    $dao = PDOlivroDAO::getInstance();
    $objeto = array2objeto($novo);
    $dados = $dao->inserir($objeto);

    header("location:" . DESTINO);
}

?>