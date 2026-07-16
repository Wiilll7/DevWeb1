<?php
abstract class AvaliacaoProdutoDAO
{
    public abstract function connect();

    public abstract function inserir($objeto);

    public abstract function excluir($id);

    public abstract function listarPorProduto($produto_id);

    public abstract function mediaPorProduto($produto_id);
}
?>
