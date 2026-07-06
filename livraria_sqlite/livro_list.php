<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>
<?php require_once 'livro_acao.php'; ?>

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
                $daoLivro = PDOLivroDAO::getInstance();
                $emprestimos = $daoLivro->listarEmprestimosDoLivro($id);
                ?>
                <article>
                    <h3>Visualizar Livro</h3>
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
                            <th>Autor</th>
                            <td><?= htmlspecialchars($dado['autor']) ?></td>
                        </tr>
                        <tr>
                            <th>Gênero</th>
                            <td><?= htmlspecialchars($dado['genero']) ?></td>
                        </tr>
                        <tr>
                            <th>Descrição</th>
                            <td><?= nl2br(htmlspecialchars($dado['descricao'])) ?></td>
                        </tr>
                    </table>
                    <a href="livro_cad.php?id=<?= $dado['id'] ?>" role="button">Alterar</a>
                    <a href="livro_list.php" role="button" class="secondary">Voltar</a>
                </article>

                <article>
                    <h4>Histórico de empréstimos deste livro</h4>
                    <?php if (count($emprestimos) == 0): ?>
                        <div><span class='warning'>nenhum empréstimo registrado</span></div>
                    <?php else: ?>
                        <table role="grid">
                            <tr>
                                <th>Pessoa</th>
                                <th>Data do Empréstimo</th>
                                <th>Prazo</th>
                            </tr>
                            <?php foreach ($emprestimos as $emp) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($emp['pessoa_nome']) ?></td>
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
            $dao = PDOLivroDAO::getInstance();
            $dados = $busca != "" ? $dao->listar_filtro($busca) : $dao->listar();
            ?>
            <form method="get" role="search">
                <input type="text" name="q" placeholder="Buscar por nome/autor/gênero" value="<?= htmlspecialchars($busca) ?>">
                <input type="submit" value="Buscar">
            </form>
            <a href="livro_cad.php" role="button">Novo Livro</a>
            <?php
            if (($dados == NULL) || (count($dados) == 0)) {
                echo "<div><span class='warning'>sem dados a serem exibidos</span></div>";
            }
            ?>
            <table role="grid">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Visualizar</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
                <?php
                foreach ($dados as $key) {
                    echo "<tr>
                        <td>" . htmlspecialchars($key['id']) . "</td>
                        <td>" . htmlspecialchars($key['nome']) . "</td>
                        <td>" . htmlspecialchars($key['autor']) . "</td>
                        <td>" . htmlspecialchars($key['genero']) . "</td>
                        <td align='center'><a role='button' href='livro_list.php?id=" . $key['id'] . "'>V</a></td>
                        <td align='center'><a role='button' href='livro_cad.php?id=" . $key['id'] . "'>A</a></td>
                        <td align='center'><a role='button' href=\"javascript:excluirRegistro('livro_acao.php?acao=excluir&id=" . $key['id'] . "');\">E</a></td>
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
