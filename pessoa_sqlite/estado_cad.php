<?php 
/*
* Código de exemplo da utilização de PDO como persistencia
* Página reponsável pelo formulário de cadastro da entidade Estado
* @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
* @version 0.1
*
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
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
                <legend>Cadastro de Estados</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome" value="<?php if ($id != 0)
                    echo $dados['nome']; ?>" required><br>

                <label for="sigla">Sigla</label>
                <input type="text" name="sigla" id="sigla" value="<?php if ($id != 0)
                    echo $dados['sigla']; ?>"><br>

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