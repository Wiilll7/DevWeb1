<?php
include 'cabecalho.php';
include 'menu.php';
echo '<main>';

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

switch ($pagina) {
    case 'home':
        include 'home/home.php';
        break;
    case 'produto':
        include 'produto/produto.php';
        break;
    case 'artigo':
        include 'artigo/artigo.php';
        break;
    default:
        include 'home/home.php';
        break;
}

echo '</main>';

?>