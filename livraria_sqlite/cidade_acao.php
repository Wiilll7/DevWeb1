<?php
require_once "cidade.php";
require_once "persistencia/PDOCidadeDAO.php";

define("DESTINO", "cidade_list.php");

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
        'estado_id' => isset($_POST['estado_id']) ? $_POST['estado_id'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Cidade();
    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->estado_id = $array_dados['estado_id'];
    return $elemento;
}

function carregar($id)
{
    $dao = PDOCidadeDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();
    $dao = PDOCidadeDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);
    header("location:" . DESTINO);
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOCidadeDAO::getInstance();
    $dao->excluir($id);
    header("location:" . DESTINO);
}

function salvar()
{
    $novo = tela2array();
    $dao = PDOCidadeDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->inserir($objeto);
    header("location:" . DESTINO);
}
?>
