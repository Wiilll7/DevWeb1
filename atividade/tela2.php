<article>
    <section class="noticia-conteudo">
        <div class="noticia-imagem">[Imagem da Notícia]</div>
        <div class="noticia-cabecalho">
            <h2>Título da Notícia / Artigo</h2>
            <p>Texto inicial...</p>
        </div>
        <div class="noticia-texto">
            <p>Restante do texto da notícia, parágrafo 1...</p>
            <p>Restante do texto da notícia, parágrafo 2...</p>
        </div>
    </section>

    <section class="noticia-comentarios-lista">
        <h3>COMENTÁRIOS</h3>
        <table class="tabela-comentarios">
            <tr>
                <th>Usuário</th>
                <th>Mensagem</th>
            </tr>
            <tr>
                <td>João</td>
                <td>Muito bom o artigo!</td>
            </tr>
            <tr>
                <td>Maria</td>
                <td>Interessante.</td>
            </tr>
        </table>
    </section>

    <section class="noticia-comentarios-form">
        <form action="" method="post">
            <label for="nome">NOME</label><br>
            <input type="text" id="nome" name="nome" class="form-input"><br><br>
            
            <label for="comentario">COMENTÁRIO</label><br>
            <textarea id="comentario" name="comentario" rows="3" cols="40" class="form-textarea"></textarea><br><br>
            
            <button type="submit" class="btn-enviar">→</button>
        </form>
    </section>
</article>