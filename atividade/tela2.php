<article>
    <section class="noticia-conteudo">
        <div class="noticia-imagem">Imagem</div>
        <div class="noticia-cabecalho">
            <h2>Artigo</h2>
            <p> text </p>
        </div>
        <div class="noticia-texto">
            <p> paragrafo 1 </p>
            <p> paragrafo 2 </p>
        </div>
    </section>

    <section class="noticia-comentarios-lista">
        <h3>COMENTARIOS</h3>
        <table class="tabela-comentarios">
            <tr>
                <th>Usuario</th>
                <th>Mensagem</th>
            </tr>
            <tr>
                <td> usuario 1 </td>
                <td> comentario </td>
            </tr>
            <tr>
                <td> usuario 2 </td>
                <td> comentario </td>
            </tr>
        </table>
    </section>

    <section class="noticia-comentarios-form">
        <form action="" method="post">
            <label for="nome">NOME</label><br>
            <input type="text" id="nome" name="nome" class="form-input"><br><br>
            
            <label for="comentario">COMENTARIO</label><br>
            <textarea id="comentario" name="comentario" rows="3" cols="40" class="form-textarea"></textarea><br><br>
            
            <button type="submit" class="btn-enviar"> Enviar </button>
        </form>
    </section>
</article>