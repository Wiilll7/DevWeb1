<?php
require_once __DIR__ . "/../persistencia/PDOComentarioArtigoDAO.php";
$daoComentario = PDOComentarioArtigoDAO::getInstance();
$comentarios = $daoComentario->listarPorArtigo($artigo['id']);
?>
<section class="noticia-comentarios-lista">
    <h3>Comentarios</h3>
    <?php if (count($comentarios) == 0): ?>
        <p><span class="warning">Nenhum comentario</span></p>
    <?php else: ?>
        <table class="tabela-padrao">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comentarios as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['nome_usuario']) ?></td>
                        <td><?= htmlspecialchars($c['comentario']) ?></td>
                        <td><?= htmlspecialchars($c['data_comentario']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
