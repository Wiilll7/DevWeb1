<?php
include __DIR__ . "/artigo_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<article>
    <form action="artigo/artigo_acao.php" method="post">
        <fieldset>
            <legend><?= $id == 0 ? "Cadastrar Artigo" : "Editar Artigo" ?></legend>

            <input type="hidden" name="id" id="id" value="<?= $id ?>">

            <label for="titulo">Titulo</label>
            <input type="text" size="40" name="titulo" id="titulo"
                value="<?= $id != 0 ? htmlspecialchars($dados['titulo']) : "" ?>" required><br>

            <label for="resumo">Resumo</label>
            <input type="text" name="resumo" id="resumo"
                value="<?= $id != 0 ? htmlspecialchars($dados['resumo']) : "" ?>"><br>

            <label for="conteudo">Conteudo</label>
            <textarea name="conteudo" id="conteudo"
                rows="8"><?= $id != 0 ? htmlspecialchars($dados['conteudo']) : "" ?></textarea><br>

            <input class="primary" type="submit" name="acao" id="acao"
                value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
            <a href="index.php?pagina=artigo" role="button" class="secondary">Cancelar</a>
        </fieldset>
    </form>
</article>
