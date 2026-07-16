<?php
require_once __DIR__ . "/../persistencia/PDOProdutoDAO.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id != 0) {
    $dao = PDOProdutoDAO::getInstance();
    $produto = $dao->obter($id);
    if (empty($produto)) {
        echo "<p><span class='warning'>produto não encontrado</span></p>";
    } else {
        include __DIR__ . "/exibicao_produto.php";
        include __DIR__ . "/avaliacoes_produto.php";
        include __DIR__ . "/duvidas_produto.php";
    }
} else {
    $busca = isset($_GET['q']) ? $_GET['q'] : "";
    $dao = PDOProdutoDAO::getInstance();
    $produtos = $busca != "" ? $dao->listar_filtro($busca) : $dao->listar();
    ?>
    <section class="lista-produtos">
        <h2>Produtos</h2>
        <form method="get" role="search">
            <input type="hidden" name="pagina" value="produto">
            <input type="text" name="q" placeholder="Nome" value="<?= htmlspecialchars($busca) ?>">
            <input type="submit" value="Buscar">
        </form>

        <?php if (($produtos == NULL) || (count($produtos) == 0)): ?>
            <p><span class="warning">nenhum produto encontrado</span></p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($produtos as $p): ?>
                    <article>
                        <header><strong><?= htmlspecialchars($p['nome']) ?></strong></header>
                        <p><?= htmlspecialchars($p['categoria']) ?></p>
                        <p>R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                        <footer>
                            <a href="index.php?pagina=produto&id=<?= $p['id'] ?>" role="button">Ver produto</a>
                            <a href="index.php?pagina=produto_cad&id=<?= $p['id'] ?>" role="button" class="secondary">Editar</a>
                            <a role="button" class="contrast"
                                href="javascript:excluirRegistro('produto/produto_acao.php?acao=excluir&id=<?= $p['id'] ?>');">Excluir</a>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
}
?>
