<?php
abstract class ComentarioArtigoDAO
{
    public abstract function connect();

    public abstract function inserir($objeto);

    public abstract function excluir($id);

    public abstract function listarPorArtigo($artigo_id);
}
?>
