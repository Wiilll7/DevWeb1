<?php
abstract class DuvidaProdutoDAO
{
    public abstract function connect();

    public abstract function inserir($objeto);

    public abstract function excluir($id);

    public abstract function listarPorProduto($produto_id);
}
?>
