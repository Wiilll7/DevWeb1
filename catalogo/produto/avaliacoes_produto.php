<?php
require_once __DIR__ . "/../persistencia/PDOAvaliacaoProdutoDAO.php";
$daoAvaliacao = PDOAvaliacaoProdutoDAO::getInstance();
$avaliacoes = $daoAvaliacao->listarPorProduto($produto['id']);
?>
<section class="produto-avaliacoes">
    <h3>Avaliações</h3>
    <?php if (count($avaliacoes) == 0): ?>
        <p><span class="warning">O produto não possui avaliações</span></p>
    <?php else: ?>
        <table class="tabela-padrao">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nota</th>
                    <th>Comentario</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avaliacoes as $av): ?>
                    <tr>
                        <td><?= htmlspecialchars($av['nome_usuario']) ?></td>
                        <td><?= str_repeat('⭐', (int) $av['nota']) ?></td>
                        <td><?= htmlspecialchars($av['comentario']) ?></td>
                        <td><?= htmlspecialchars($av['data_avaliacao']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <details>
        <summary>Avaliar produto</summary>
        <form action="produto/avaliacao_acao.php" method="post">
            <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">

            <label for="nome_usuario">Nome</label>
            <input type="text" name="nome_usuario" id="nome_usuario" class="form-campo" required>

            <label for="nota">Nota</label>
            <select name="nota" id="nota" required>
                <option value="5">5 - Muito Bom</option>
                <option value="4">4 - Bom</option>
                <option value="3">3 - Regular</option>
                <option value="2">2 - Ruim</option>
                <option value="1">1 - Muito Ruim</option>
            </select>

            <label for="comentario">Comentario</label>
            <textarea name="comentario" id="comentario" rows="3" class="form-campo"></textarea>

            <button type="submit" class="btn-enviar">Enviar</button>
        </form>
    </details>
</section>
