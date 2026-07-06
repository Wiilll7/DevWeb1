<?php

require_once "uso_livro.php";
require_once "persistencia/PDOUsoLivroDAO.php";


if(isset($_POST['livro_id'])){
    define("DESTINO", "livro_list.php");
}else{
    define("DESTINO", "livro_list.php");
}


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
        _salvar();
        break;
    case 'excluir':
        _excluir();
        break;
}

function _tela2array()
{
    $novo = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : date("YmdHis"),
        'livro_id' => isset($_POST['livro_id']) ? $_POST['livro_id'] : "",
        'pessoa_id' => isset($_POST['pessoa_id']) ? $_POST['pessoa_id'] : "",
        'prazo' => isset($_POST['prazo']) ? $_POST['prazo'] : "",
        'data_emprestimo' => isset($_POST['data_emprestimo']) ? $_POST['data_emprestimo'] : ""
    );
    if ($novo['id'] == "0") {
        $novo['id'] = date("YmdHis");
    }
    return $novo;
}

function _array2objeto($array_dados)
{
    $elemento = new UsoLivro();

    $elemento->id = $array_dados['id'];
    $elemento->livro_id = $array_dados['livro_id'];
    $elemento->pessoa_id = $array_dados['pessoa_id'];
    $elemento->prazo = $array_dados['prazo'];
    $elemento->data_emprestimo = $array_dados['data_emprestimo'];

    return $elemento;
}


function _objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'livro_id' => (string) $elemento->livro_id,
        'pessoa_id' => (string) $elemento->pessoa_id,
        'prazo' => (string) $elemento->prazo,
        'data_emprestimo' => (string) $elemento->data_emprestimo
    );

    return $dado;
}

function _carregar($id)
{
    $dao = PDOUsoLivroDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function _excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOUsoLivroDAO::getInstance();
    $dados = $dao->excluir($id);

    header("location:" . DESTINO);

}

function _salvar()
{
    $xml = NULL;
    $novo = _tela2array();

    $dao = PDOUsolivroDAO::getInstance();
    $objeto = _array2objeto($novo);
    $dados = $dao->inserir($objeto);

    header("location:" . DESTINO);
}

?>