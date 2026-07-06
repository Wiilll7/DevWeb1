<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php
include "pessoa_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);

$selecionado = ($id != 0 && isset($dados['cidade_id'])) ? $dados['cidade_id'] : "";
?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">

        <form action="pessoa_acao.php" method="post">
            <fieldset>
                <legend><?= $id == 0 ? "Cadastro de Pessoa" : "Edição de Pessoa" ?></legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome"
                    value="<?= $id != 0 ? htmlspecialchars($dados['nome']) : "" ?>" required><br>

                <label for="cidade_id">Cidade</label>
                <?php include 'cidade_combo.php'; ?>

                <label for="peso">Peso (kg)</label>
                <input type="number" step="0.01" name="peso" id="peso"
                    value="<?= $id != 0 ? htmlspecialchars($dados['peso'] ?? "") : "" ?>"><br>

                <label for="altura">Altura (m)</label>
                <input type="number" step="0.01" name="altura" id="altura"
                    value="<?= $id != 0 ? htmlspecialchars($dados['altura'] ?? "") : "" ?>"><br>

                <input class="primary" type="submit" name="acao" id="acao"
                    value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
                <a href="pessoa_list.php" role="button" class="secondary">Cancelar</a>

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>
