<?php
require_once "persistencia/PDOCidadeDAO.php";

$dao = PDOCidadeDAO::getInstance();
$dados = $dao->listar();
if (!isset($selecionado)) {
    $selecionado = "";
}
if (($dados == NULL) || (count($dados) == 0)) {
    echo "<div><span class='warning'>sem cidades cadastradas</span></div>";
}
?>
<select name="cidade_id" id="cidade_id">
    <option value="">Selecione a cidade</option>
    <?php
    foreach ($dados as $key) {
        $sel = ($key['id'] == $selecionado) ? "selected" : "";
        echo "<option value='{$key['id']}' $sel>" . htmlspecialchars($key['nome']) . " / {$key['estado_sigla']}</option>";
    }
    ?>
</select>
