<?php
require_once __DIR__ . "/../persistencia/PDOArtigoDAO.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id != 0) {
    $dao = PDOArtigoDAO::getInstance();
    $artigo = $dao->obter($id);
    if (empty($artigo)) {
        echo "<p><span class='warning'>artigo não encontrado</span></p>";
    } else {
        echo "<article>";
        include __DIR__ . "/exibicao_artigo.php";
        include __DIR__ . "/comentarios_artigo.php";
        include __DIR__ . "/enviar_comentario_artigo.php";
        echo "</article>";
    }
} else {
    $busca = isset($_GET['q']) ? $_GET['q'] : "";
    $dao = PDOArtigoDAO::getInstance();
    $artigos = $busca != "" ? $dao->listar_filtro($busca) : $dao->listar();
    ?>
    <section class="lista-artigos">
        <h2>Artigos</h2>
        <form method="get" role="search">
            <input type="hidden" name="pagina" value="artigo">
            <input type="text" name="q" placeholder="Nome" value="<?= htmlspecialchars($busca) ?>">
            <input type="submit" value="Buscar">
        </form>

        <?php if (($artigos == NULL) || (count($artigos) == 0)): ?>
            <p><span class="warning">nenhum artigo encontrado</span></p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($artigos as $a): ?>
                    <article>
                        <header><strong><?= htmlspecialchars($a['titulo']) ?></strong></header>
                        <p><?= htmlspecialchars($a['resumo']) ?></p>
                        <footer>
                            <a href="index.php?pagina=artigo&id=<?= $a['id'] ?>" role="button">Ler artigo</a>
                            <a href="index.php?pagina=artigo_cad&id=<?= $a['id'] ?>" role="button" class="secondary">Editar</a>
                            <a role="button" class="contrast"
                                href="javascript:excluirRegistro('artigo/artigo_acao.php?acao=excluir&id=<?= $a['id'] ?>');">Excluir</a>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
}
?>
