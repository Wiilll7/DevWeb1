<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php
include "estado_acao.php";
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

        <form action="estado_acao.php" method="post">
            <fieldset>
                <legend><?= $id == 0 ? "Cadastro de Estado" : "Edição de Estado" ?></legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome"
                    value="<?= $id != 0 ? htmlspecialchars($dados['nome']) : "" ?>" required><br>

                <label for="sigla">Sigla</label>
                <input type="text" maxlength="2" name="sigla" id="sigla"
                    value="<?= $id != 0 ? htmlspecialchars($dados['sigla']) : "" ?>" required><br>

                <input class="primary" type="submit" name="acao" id="acao"
                    value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
                <a href="estado_list.php" role="button" class="secondary">Cancelar</a>

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>
