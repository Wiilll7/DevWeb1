<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php require_once 'pessoa_acao.php'; ?>
<?php require_once 'persistencia/PDOPessoaLivroDAO.php'; ?>

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
                $daoEmprestimo = PDOPessoaLivroDAO::getInstance();
                $emprestimos = $daoEmprestimo->listarPorPessoa($id);
                ?>
                <article>
                    <h3>Visualizar Pessoa</h3>
                    <table>
                        <tr>
                            <th>Id</th>
                            <td><?= htmlspecialchars($dado['id']) ?></td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <td><?= htmlspecialchars($dado['nome']) ?></td>
                        </tr>
                        <tr>
                            <th>Cidade</th>
                            <td><?= $dado['cidade_nome'] ? htmlspecialchars($dado['cidade_nome']) : "-" ?></td>
                        </tr>
                        <tr>
                            <th>Peso</th>
                            <td><?= htmlspecialchars($dado['peso'] ?? "-") ?> <?= $dado['peso'] ? "kg" : "" ?></td>
                        </tr>
                        <tr>
                            <th>Altura</th>
                            <td><?= htmlspecialchars($dado['altura'] ?? "-") ?> <?= $dado['altura'] ? "m" : "" ?></td>
                        </tr>
                    </table>
                    <a href="pessoa_cad.php?id=<?= $dado['id'] ?>" role="button">Alterar</a>
                    <a href="pessoa_list.php" role="button" class="secondary">Voltar</a>
                </article>

                <article>
                    <h4>Livros emprestados a esta pessoa</h4>
                    <?php if (count($emprestimos) == 0): ?>
                        <div><span class='warning'>nenhum empréstimo registrado</span></div>
                    <?php else: ?>
                        <table role="grid">
                            <tr>
                                <th>Livro</th>
                                <th>Data do Empréstimo</th>
                                <th>Prazo</th>
                            </tr>
                            <?php foreach ($emprestimos as $emp) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($emp['livro_nome']) ?></td>
                                    <td><?= htmlspecialchars($emp['data_emprestimo']) ?></td>
                                    <td><?= htmlspecialchars($emp['prazo']) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php endif; ?>
                </article>
                <?php
            }
        else:
            $busca = isset($_GET['q']) ? $_GET['q'] : "";
            $dao = PDOPessoaDAO::getInstance();
            $dados = $busca != "" ? $dao->listar_filtro($busca) : $dao->listar();
            ?>
            <form method="get" role="search">
                <input type="text" name="q" placeholder="Buscar por nome" value="<?= htmlspecialchars($busca) ?>">
                <input type="submit" value="Buscar">
            </form>
            <a href="pessoa_cad.php" role="button">Nova Pessoa</a>
            <?php
            if (($dados == NULL) || (count($dados) == 0)) {
                echo "<div><span class='warning'>sem dados a serem exibidos</span></div>";
            }
            ?>
            <table role="grid">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>Visualizar</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
                <?php
                foreach ($dados as $key) {
                    $cidade_nome = $key['cidade_nome'] ? htmlspecialchars($key['cidade_nome']) : "-";
                    echo "<tr>
                        <td>" . htmlspecialchars($key['id']) . "</td>
                        <td>" . htmlspecialchars($key['nome']) . "</td>
                        <td>" . $cidade_nome . "</td>
                        <td>" . htmlspecialchars($key['peso'] ?? "-") . "</td>
                        <td>" . htmlspecialchars($key['altura'] ?? "-") . "</td>
                        <td align='center'><a role='button' href='pessoa_list.php?id=" . $key['id'] . "'>V</a></td>
                        <td align='center'><a role='button' href='pessoa_cad.php?id=" . $key['id'] . "'>A</a></td>
                        <td align='center'><a role='button' href=\"javascript:excluirRegistro('pessoa_acao.php?acao=excluir&id=" . $key['id'] . "');\">E</a></td>
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
