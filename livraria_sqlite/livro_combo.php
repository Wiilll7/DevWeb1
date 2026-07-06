<?php

require_once "persistencia/PDOLivroDAO.php";

$dao = PDOLivroDAO::getInstance();
$dados = $dao->listar();
if (!isset($selecionado)) {
    $selecionado = "";
}
if (($dados == NULL) || (count($dados) == 0)) {
    echo "<div><span class='warning'>sem livros cadastrados</span></div>";
}
?>
<select name="livro_id" id="livro_id" required>
    <option value="">Selecione o livro</option>
    <?php
    foreach ($dados as $key) {
        $sel = ($key['id'] == $selecionado) ? "selected" : "";
        echo "<option value='{$key['id']}' $sel>" . htmlspecialchars($key['nome']) . "</option>";
    }
    ?>
</select>
