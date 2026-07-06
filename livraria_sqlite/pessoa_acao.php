<?php
require_once "pessoa.php";
require_once "persistencia/PDOPessoaDAO.php";

define("DESTINO", "pessoa_list.php");

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
        'cidade_id' => isset($_POST['cidade_id']) && $_POST['cidade_id'] !== "" ? $_POST['cidade_id'] : NULL,
        'peso' => isset($_POST['peso']) ? $_POST['peso'] : "",
        'altura' => isset($_POST['altura']) ? $_POST['altura'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Pessoa();
    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->cidade_id = $array_dados['cidade_id'];
    $elemento->peso = $array_dados['peso'];
    $elemento->altura = $array_dados['altura'];
    return $elemento;
}

function carregar($id)
{
    $dao = PDOPessoaDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();
    $dao = PDOPessoaDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);
    header("location:" . DESTINO);
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOPessoaDAO::getInstance();
    $dao->excluir($id);
    header("location:" . DESTINO);
}

function salvar()
{
    $novo = tela2array();
    $dao = PDOPessoaDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->inserir($objeto);
    header("location:" . DESTINO);
}
?>
