<?php


function carregar($id)
{
    $reflect  = new \ReflectionClass("PDO".ENTIDADE."DAO");
    $params_for_construct = array();
    $instance = $reflect->newInstanceArgs($params_for_construct);
    $dao = $instance::getInstance();
    
    $dados = $dao->obter($id);
    return $dados;
}


function alterar()
{
    $novo = tela2array();

    $reflect  = new \ReflectionClass("PDO".ENTIDADE."DAO");
    $params_for_construct = array();
    $instance = $reflect->newInstanceArgs($params_for_construct);
    $dao = $instance::getInstance();

    $objeto = array2objeto($novo);
    $dados = $dao->alterar($objeto);


    header("location:" . DESTINO);

}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $reflect  = new \ReflectionClass("PDO".ENTIDADE."DAO");
    $params_for_construct = array();
    $instance = $reflect->newInstanceArgs($params_for_construct);
    $dao = $instance::getInstance();
    $dados = $dao->excluir($id);

    header("location:" . DESTINO);

}


function salvar()
{
    $xml = NULL;
    $novo = tela2array();

    $reflect  = new \ReflectionClass("PDO".ENTIDADE."DAO");
    $params_for_construct = array();
    $instance = $reflect->newInstanceArgs($params_for_construct);
    $dao = $instance::getInstance();

    $objeto = array2objeto($novo);
    $dados = $dao->inserir($objeto);

    header("location:" . DESTINO);
}
?>