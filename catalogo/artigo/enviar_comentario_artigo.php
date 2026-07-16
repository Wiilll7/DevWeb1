<section class="noticia-comentarios-form">
    <form action="artigo/comentario_acao.php" method="post">
        <input type="hidden" name="artigo_id" value="<?= $artigo['id'] ?>">

        <label for="nome_usuario">Nome</label><br>
        <input type="text" id="nome_usuario" name="nome_usuario" class="form-campo" required><br><br>

        <label for="comentario">Comentario</label><br>
        <textarea id="comentario" name="comentario" rows="3" cols="40" class="form-campo" required></textarea><br><br>

        <button type="submit" class="btn-enviar">Enviar</button>
    </form>
</section>
