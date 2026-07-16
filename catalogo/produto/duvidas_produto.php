<?php
require_once __DIR__ . "/../persistencia/PDODuvidaProdutoDAO.php";
$daoDuvida = PDODuvidaProdutoDAO::getInstance();
$duvidas = $daoDuvida->listarPorProduto($produto['id']);
?>
<section class="produto-duvidas">
    <h3>Duvidas</h3>
    <?php if (count($duvidas) == 0): ?>
        <p><span class="warning">O produto não possui duvidas</span></p>
    <?php else: ?>
        <?php foreach ($duvidas as $d): ?>
            <article>
                <p><strong><?= htmlspecialchars($d['nome_usuario']) ?> perguntou:</strong>
                    <?= htmlspecialchars($d['pergunta']) ?></p>
                <?php if (!empty($d['resposta'])): ?>
                    <p><small><strong>Resposta:</strong> <?= htmlspecialchars($d['resposta']) ?></small></p>
                <?php else: ?>
                    <p><small><em>aguardando resposta</em></small></p>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="produto/duvida_acao.php" method="post">
        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">

        <label for="nome_usuario_duvida">Nome</label><br>
        <input type="text" id="nome_usuario_duvida" name="nome_usuario" class="form-campo" required><br><br>

        <label for="pergunta">Duvida</label><br>
        <textarea id="pergunta" name="pergunta" rows="3" cols="50" class="form-campo" required></textarea><br><br>

        <button type="submit" class="btn-enviar">Enviar</button>
    </form>
</section>
