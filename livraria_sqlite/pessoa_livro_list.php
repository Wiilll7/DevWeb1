<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php require_once 'pessoa_livro_acao.php'; ?>

<body>
    <main class="container">
        <?php include 'menu.php'; ?>
        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if ($id != 0):
            $dado = carregar($id);
            if (empty($dado)) {
                echo "<div><span class='warning'>registro não encontrado</span></div>";
            } else {
                ?>
                <article>
                    <h3>Visualizar Empréstimo</h3>
                    <table>
                        <tr>
                            <th>Id</th>
                            <td><?= htmlspecialchars($dado['id']) ?></td>
                        </tr>
                        <tr>
                            <th>Pessoa</th>
                            <td><?= htmlspecialchars($dado['pessoa_nome']) ?></td>
                        </tr>
                        <tr>
                            <th>Livro</th>
                            <td><?= htmlspecialchars($dado['livro_nome']) ?></td>
                        </tr>
                        <tr>
                            <th>Data do Empréstimo</th>
                            <td><?= htmlspecialchars($dado['data_emprestimo']) ?></td>
                        </tr>
                        <tr>
                            <th>Prazo</th>
                            <td><?= htmlspecialchars($dado['prazo']) ?></td>
                        </tr>
                    </table>
                    <a href="pessoa_livro_cad.php?id=<?= $dado['id'] ?>" role="button">Alterar</a>
                    <a href="pessoa_livro_list.php" role="button" class="secondary">Voltar</a>
                </article>
                <?php
            }
        else:
            $busca = isset($_GET['q']) ? $_GET['q'] : "";
            $dao = PDOPessoaLivroDAO::getInstance();
            $dados = $busca != "" ? $dao->listar_filtro($busca) : $dao->listar();
            ?>
            <form method="get" role="search">
                <input type="text" name="q" placeholder="Buscar por pessoa/livro" value="<?= htmlspecialchars($busca) ?>">
                <input type="submit" value="Buscar">
            </form>
            <a href="pessoa_livro_cad.php" role="button">Novo Empréstimo</a>
            <?php
            if (($dados == NULL) || (count($dados) == 0)) {
                echo "<div><span class='warning'>sem dados a serem exibidos</span></div>";
            }
            ?>
            <table role="grid">
                <tr>
                    <th>Id</th>
                    <th>Pessoa</th>
                    <th>Livro</th>
                    <th>Data do Empréstimo</th>
                    <th>Prazo</th>
                    <th>Visualizar</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
                <?php
                foreach ($dados as $key) {
                    echo "<tr>
                        <td>" . htmlspecialchars($key['id']) . "</td>
                        <td>" . htmlspecialchars($key['pessoa_nome']) . "</td>
                        <td>" . htmlspecialchars($key['livro_nome']) . "</td>
                        <td>" . htmlspecialchars($key['data_emprestimo']) . "</td>
                        <td>" . htmlspecialchars($key['prazo']) . "</td>
                        <td align='center'><a role='button' href='pessoa_livro_list.php?id=" . $key['id'] . "'>V</a></td>
                        <td align='center'><a role='button' href='pessoa_livro_cad.php?id=" . $key['id'] . "'>A</a></td>
                        <td align='center'><a role='button' href=\"javascript:excluirRegistro('pessoa_livro_acao.php?acao=excluir&id=" . $key['id'] . "');\">E</a></td>
                    </tr>";
                }
                ?>
            </table>
        <?php endif; ?>
    </main>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>

</html>
