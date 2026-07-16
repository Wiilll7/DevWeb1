<?php
include __DIR__ . "/produto_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<article>
    <form action="produto/produto_acao.php" method="post">
        <fieldset>
            <legend><?= $id == 0 ? "Cadastro de Produto" : "Edição de Produto" ?></legend>

            <input type="hidden" name="id" id="id" value="<?= $id ?>">

            <label for="nome">Nome</label>
            <input type="text" size="40" name="nome" id="nome"
                value="<?= $id != 0 ? htmlspecialchars($dados['nome']) : "" ?>" required><br>

            <label for="categoria">Categoria</label>
            <input type="text" name="categoria" id="categoria"
                value="<?= $id != 0 ? htmlspecialchars($dados['categoria']) : "" ?>"><br>

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao"
                rows="4"><?= $id != 0 ? htmlspecialchars($dados['descricao']) : "" ?></textarea><br>

            <label for="preco">Preço</label>
            <input type="number" min="0" name="preco" id="preco"
                value="<?= $id != 0 ? htmlspecialchars($dados['preco']) : "" ?>" required><br>

            <input class="primary" type="submit" name="acao" id="acao"
                value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
            <a href="index.php?pagina=produto" role="button" class="secondary">Cancelar</a>
        </fieldset>
    </form>
</article>
