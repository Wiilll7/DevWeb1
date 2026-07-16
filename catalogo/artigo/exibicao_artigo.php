<section class="noticia-conteudo">
    <div class="caixa-borda caixa-imagem">
        <?php if (!empty($artigo['imagem'])): ?>
            <img src="<?= htmlspecialchars($artigo['imagem']) ?>" alt="Imagem do artigo <?= htmlspecialchars($artigo['titulo']) ?>">
        <?php else: ?>
            Sem imagem
        <?php endif; ?>
    </div>
    <div class="noticia-cabecalho">
        <h2><?= htmlspecialchars($artigo['titulo']) ?></h2>
        <p><small><?= htmlspecialchars($artigo['data_publicacao']) ?></small></p>
    </div>
    <div class="noticia-texto">
        <?php foreach (explode("\n\n", $artigo['conteudo']) as $paragrafo): ?>
            <?php if (trim($paragrafo) != ""): ?>
                <p><?= nl2br(htmlspecialchars($paragrafo)) ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <a href="index.php?pagina=artigo" role="button" class="secondary">Voltar</a>
</section>
