<?php

/*
 * Código de exemplo da utilização de PDO como persistencia
 * Controlador reponsável pela manutenção do cadastro da entidade Pessoa
 * @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
 * @version 0.1
 *
 */
/* definição de constantes */
define("DESTINO", "cidade_list.php");
define("ENTIDADE", "cidade");

require_once ENTIDADE.".php";
require_once "persistencia/PDO".ucfirst(ENTIDADE)."DAO.php";


include 'generico_acao.php';

/* escolha da ação que processará a requisição */
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

/*
 * Método que converte formulário html para array com respectivos dados
 * @return array
 */
function tela2array()
{
    $novo = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : date("YmdHis"),
        'nome' => isset($_POST['nome']) ? $_POST['nome'] : "",
        'estado_id' => isset($_POST['estado_id']) ? $_POST['estado_id'] : ""
    );
    if ($novo['id'] == "0") {
        $novo['id'] = date("YmdHis");
    }
    return $novo;
}

/*
 * Método que converte array para objeto
 * @return String json
 */
function array2objeto($array_dados)
{
    $elemento = new Cidade();

    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->estado_id = $array_dados['estado_id'];

    return $elemento;
}


/*
 * Método que converte array para objeto
 * @return String array
 */
function objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'nome' => (string) $elemento->nome,
        'sigla' => (string) $elemento->sigla
    );

    return $dado;
}


?>