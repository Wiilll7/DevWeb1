<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php
include "pessoa_livro_acao.php";
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

        <form action="pessoa_livro_acao.php" method="post">
            <fieldset>
                <legend><?= $id == 0 ? "Novo Empréstimo" : "Edição de Empréstimo" ?></legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="pessoa_id">Pessoa</label>
                <?php
                $selecionado = $id != 0 ? $dados['pessoa_id'] : "";
                include 'pessoa_combo.php';
                ?>

                <label for="livro_id">Livro</label>
                <?php
                $selecionado = $id != 0 ? $dados['livro_id'] : "";
                include 'livro_combo.php';
                ?>

                <label for="data_emprestimo">Data do Empréstimo</label>
                <input type="date" name="data_emprestimo" id="data_emprestimo"
                    value="<?= $id != 0 ? htmlspecialchars($dados['data_emprestimo']) : date('Y-m-d') ?>" required><br>

                <label for="prazo">Prazo para Devolução</label>
                <input type="date" name="prazo" id="prazo"
                    value="<?= $id != 0 ? htmlspecialchars($dados['prazo']) : "" ?>" required><br>

                <input class="primary" type="submit" name="acao" id="acao"
                    value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
                <a href="pessoa_livro_list.php" role="button" class="secondary">Cancelar</a>

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>
