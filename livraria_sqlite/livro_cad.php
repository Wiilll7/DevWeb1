<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php
include "livro_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">

        <form action="livro_acao.php" method="post">
            <fieldset>
                <legend><?= $id == 0 ? "Cadastro de Livro" : "Edição de Livro" ?></legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome"
                    value="<?= $id != 0 ? htmlspecialchars($dados['nome']) : "" ?>" required><br>

                <label for="autor">Autor</label>
                <input type="text" size="40" name="autor" id="autor"
                    value="<?= $id != 0 ? htmlspecialchars($dados['autor']) : "" ?>"><br>

                <label for="genero">Gênero</label>
                <input type="text" name="genero" id="genero"
                    value="<?= $id != 0 ? htmlspecialchars($dados['genero']) : "" ?>"><br>

                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4"><?= $id != 0 ? htmlspecialchars($dados['descricao']) : "" ?></textarea><br>

                <input class="primary" type="submit" name="acao" id="acao"
                    value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
                <a href="livro_list.php" role="button" class="secondary">Cancelar</a>

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>
