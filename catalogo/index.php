<?php ob_start(); // permite usar header() para redirecionar mesmo após HTML já ter sido enviado ?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">
        <?php
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

        switch ($pagina) {
            case 'home':
                include 'home/home.php';
                break;
            case 'produto':
                include 'produto/produto.php';
                break;
            case 'produto_cad':
                include 'produto/produto_cad.php';
                break;
            case 'artigo':
                include 'artigo/artigo.php';
                break;
            case 'artigo_cad':
                include 'artigo/artigo_cad.php';
                break;
            default:
                include 'home/home.php';
                break;
        }
        ?>
    </main>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>

</html>
