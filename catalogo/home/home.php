<?php
require_once __DIR__ . "/../persistencia/PDOProdutoDAO.php";
require_once __DIR__ . "/../persistencia/PDOArtigoDAO.php";

$daoProduto = PDOProdutoDAO::getInstance();
$produtosDestaque = $daoProduto->listarDestaques(3);

$daoArtigo = PDOArtigoDAO::getInstance();
$artigosDestaque = $daoArtigo->listarDestaques(2);
?>

<section class="secao-destaques">
    <h2>Produtos em destaque</h2>
    <?php if (count($produtosDestaque) == 0): ?>
        <p><span class="warning">Nenhum produto cadastrado ainda</span></p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($produtosDestaque as $produto): ?>
                <article>
                    <header><strong><?= htmlspecialchars($produto['nome']) ?></strong></header>
                    <p><?= htmlspecialchars($produto['categoria']) ?></p>
                    <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <a href="index.php?pagina=produto&id=<?= $produto['id'] ?>" role="button" class="secondary">Ver
                        produto</a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <a href="index.php?pagina=produto" role="button">Ver todos os produtos</a>
</section>

<section class="secao-artigos">
    <h2>Artigos recentes</h2>
    <?php if (count($artigosDestaque) == 0): ?>
        <p><span class="warning">Nenhum artigo cadastrado ainda</span></p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($artigosDestaque as $artigo): ?>
                <article>
                    <header><strong><?= htmlspecialchars($artigo['titulo']) ?></strong></header>
                    <p><?= htmlspecialchars($artigo['resumo']) ?></p>
                    <a href="index.php?pagina=artigo&id=<?= $artigo['id'] ?>" role="button" class="secondary">Ler
                        artigo</a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <a href="index.php?pagina=artigo" role="button">Ver todos os artigos</a>
</section>
