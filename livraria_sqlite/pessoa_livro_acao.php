<?php
require_once "pessoa_livro.php";
require_once "persistencia/PDOPessoaLivroDAO.php";

define("DESTINO", "pessoa_livro_list.php");

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
        'pessoa_id' => isset($_POST['pessoa_id']) ? $_POST['pessoa_id'] : "",
        'livro_id' => isset($_POST['livro_id']) ? $_POST['livro_id'] : "",
        'data_emprestimo' => isset($_POST['data_emprestimo']) ? $_POST['data_emprestimo'] : "",
        'prazo' => isset($_POST['prazo']) ? $_POST['prazo'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new PessoaLivro();
    $elemento->id = $array_dados['id'];
    $elemento->pessoa_id = $array_dados['pessoa_id'];
    $elemento->livro_id = $array_dados['livro_id'];
    $elemento->data_emprestimo = $array_dados['data_emprestimo'];
    $elemento->prazo = $array_dados['prazo'];
    return $elemento;
}

function carregar($id)
{
    $dao = PDOPessoaLivroDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();
    $dao = PDOPessoaLivroDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);
    header("location:" . DESTINO);
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOPessoaLivroDAO::getInstance();
    $dao->excluir($id);
    header("location:" . DESTINO);
}

function salvar()
{
    $novo = tela2array();
    $dao = PDOPessoaLivroDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->inserir($objeto);
    header("location:" . DESTINO);
}
?>
