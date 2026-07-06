<?php
/*
 * Código de exemplo da utilização de PDO como persistencia
 * Página reponsável pela listagem da entidade Cidade
 * @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
 * @version 0.1
 *
 */
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="ligth">
<?php include 'cabecalho.php'; ?>
<?php require_once 'cidade_acao.php'; ?>

<body>
    <main class="container">
        <?php include 'menu.php'; ?>
        <?php


        $dao = PDOCidadeDAO::getInstance();        
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
                <th>Estado Id</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            foreach ($dados as $key)
                echo "<tr><td>{$key['id']}</td>
                  <td>{$key['nome']}</td>
                  <td>{$key['estado_nome']}</td>
                  <td align='center'><a role='button' href='cidade_cad.php?id=" . $key['id'] . "'>A</a></td>
                  <td align='center'><a role='button' href=javascript:excluirRegistro('cidade_acao.php?acao=excluir&id=" . $key['id'] . "');>E</a></td>
              </tr>";
            ?>
        </table>
    </main>
    <!-- funcao de confirmacacao em javascript para a exclusao-->
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>

</html>