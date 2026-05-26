<?php
include 'cabecalho.php';
include 'menu.php';
echo '<main>';

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

switch ($pagina) {
    case 'home':
        include 'home.php';
        break;
    case 'tela1':
        include 'tela1.php';
        break;
    case 'tela2':
        include 'tela2.php';
        break;
    default:
        include 'home.php';
        break;
}

echo '</main>';

?>