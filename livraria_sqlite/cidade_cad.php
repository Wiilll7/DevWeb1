<?php
/*
 * Página responsável pelo formulário de cadastro/edição da entidade Cidade
 * @version 0.1
 */
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php
include "cidade_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);

/* variável usada pelo estado_combo.php para pré-selecionar o estado ao editar */
$selecionado = $id != 0 ? $dados['estado_id'] : "";
?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">

        <form action="cidade_acao.php" method="post">
            <fieldset>
                <legend><?= $id == 0 ? "Cadastro de Cidade" : "Edição de Cidade" ?></legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome"
                    value="<?= $id != 0 ? htmlspecialchars($dados['nome']) : "" ?>" required><br>

                <label for="estado_id">Estado</label>
                <?php include 'estado_combo.php'; ?>

                <input class="primary" type="submit" name="acao" id="acao"
                    value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
                <a href="cidade_list.php" role="button" class="secondary">Cancelar</a>

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>
