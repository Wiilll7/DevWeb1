<!DOCTYPE html>
<html lang="pt-BR">
<?php
    include 'cabecalho.php';
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
                <legend>Cadastro de livros</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome" value="<?php if ($id != 0)
                    echo $dados['nome']; ?>" required><br>

                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" id="descricao" value="<?php if ($id != 0)
                    echo $dados['descricao']; ?>"><br>

                <input class="primary" type="submit" name="acao" id="acao" value="<?php if ($id == 0)
                    echo "Salvar";
                else
                    echo "Alterar";
                ?>">
                <input type="reset" value="Cancelar" />

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>