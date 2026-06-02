<?php
echo "<section class='banner-principal'>";
include 'imagem_home.php';
echo "</section>";

echo "<section class='secao-1'>";
for ($i = 0; $i < 3; $i++) {
    $nome = 'Caixa Pequena '.($i+1);
    include 'caixa_pequena_home.php';
}
echo "</section>";

echo "<section class='secao-2'>";
for ($i = 0; $i < 2; $i++) {
    $nome = 'Caixa Media '.($i+1);
    include 'caixa_media_home.php';
}
echo "</section>";

echo "<section class='icones-inferiores'>";
for ($i = 0; $i < 5; $i++) {
    include 'icone_home.php';
}
echo "</section>";
?>