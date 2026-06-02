<?php
include 'cabecalho.php';
include 'menu.php';
echo '<main>';

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

switch ($pagina) {
    case 'home':
        include 'home/home.php';
        break;
    case 'tela1':
        include 'produto/produto.php';
        break;
    case 'tela2':
        include 'artigo/artigo.php';
        break;
    default:
        include 'home/home.php';
        break;
}

echo '</main>';

?>