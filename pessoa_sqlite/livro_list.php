<!DOCTYPE html>
<html lang="pt-BR" data-theme="ligth">
<?php
    include 'cabecalho.php';
    require_once 'livro_acao.php';
    require_once "persistencia/PDOUsoLivroDAO.php";
    require_once "persistencia/PDOPessoaDAO.php";
?>

<body>
    <main class="container">
        <?php
        
        include 'menu.php';

        $dao = PDOLivroDAO::getInstance();        
        $dados = array();
        $dados = $dao->listar();
        if (($dados == NULL) || (count($dados) == 0)) {
            echo "<div><span class='warning'>sem dados a serem exibidos</span></div>";
        }
        ?>
        <table role="grid">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            foreach ($dados as $key)
                echo "<tr><td>{$key['id']}</td>
                  <td>{$key['nome']}</td>
                  <td>{$key['descricao']}</td>
                  <td align='center'><a role='button' href='livro_cad.php?id=" . $key['id'] . "'>A</a></td>
                  <td align='center'><a role='button' href=javascript:excluirRegistro('livro_acao.php?acao=excluir&id=" . $key['id'] . "');>E</a></td>
              </tr>";
            ?>
        </table>

        <?php
            $dao = PDOUsoLivroDAO::getInstance();        
            $dados = array();
            $dados = $dao->listar();
            if (($dados == NULL) || (count($dados) == 0)) {
                echo "<div><span class='warning'>sem dados a serem exibidos</span></div>";
            }
        ?>

        <form action="livrouso_acao.php" method="post">
            <table role="grid">
                <tr>
                    <th>Id</th>
                    <th>Livro</th>
                    <th>Pessoa</th>
                    <th>Prazo</th>
                    <th>Data Empréstimo</th>
                    <th>Excluir</th>
                </tr>
                <?php
                    foreach ($dados as $key)
                        echo "<tr><td>{$key['id']}</td>
                        <td>{$key['livro_id']}</td>
                        <td>{$key['pessoa_id']}</td>
                        <td>{$key['prazo']}</td>
                        <td>{$key['data_emprestimo']}</td>

                        <td align='center'>
                            <a role='button' href=javascript:excluirRegistro('livrouso_acao.php?acao=excluir&id=" . $key['id'] . "');>E</a>
                        </td>

                        </tr>";
                ?>
                <tfoot>
                    <td>#</td>
                    <td>
                        <?php include "livro_combo.php"?>
                    </td>
                    <td>
                        <?php include "pessoa_combo.php"?>
                    </td>
                    <td><input type="date" name="prazo" id="data_prazo"></td>
                    <td><input type="date" name="data_emprestimo" id="data_emprestimo"></td>
                    <td><input type="submit" name="acao" value="Salvar"></td>
                </tfoot>
            </table>
        </form>
    </main>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>

</html>