<?php
require_once __DIR__ . "/../persistencia/PDOAvaliacaoProdutoDAO.php";
$daoAvaliacao = PDOAvaliacaoProdutoDAO::getInstance();
$mediaProduto = $daoAvaliacao->mediaPorProduto($produto['id']);
?>
<article class="produto-detalhes">
    <div class="grid">
        <div class="caixa-borda caixa-imagem">
            <?php if (!empty($produto['imagem'])): ?>
                <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="Foto de <?= htmlspecialchars($produto['nome']) ?>">
            <?php else: ?>
                Sem imagem
            <?php endif; ?>
        </div>
        <div class="info-lateral">
            <h2><?= htmlspecialchars($produto['nome']) ?></h2>
            <p><small><?= htmlspecialchars($produto['categoria']) ?></small></p>
            <p>
                <?php if ($mediaProduto['total'] > 0): ?>
                    ⭐ <?= number_format($mediaProduto['media'], 1) ?> (<?= $mediaProduto['total'] ?>
                    avaliação<?= $mediaProduto['total'] > 1 ? 'ões' : '' ?>)
                <?php else: ?>
                    <small>ainda sem avaliações</small>
                <?php endif; ?>
            </p>
            <p><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
            <p><strong>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></strong></p>
            <button>Comprar</button>
            <a href="index.php?pagina=produto" role="button" class="secondary">Voltar</a>
        </div>
    </div>
</article>
