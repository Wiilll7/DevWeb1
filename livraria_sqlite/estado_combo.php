<?php
require_once "persistencia/PDOEstadoDAO.php";

$dao = PDOEstadoDAO::getInstance();
$dados = $dao->listar();
if (!isset($selecionado)) {
    $selecionado = "";
}
if (($dados == NULL) || (count($dados) == 0)) {
    echo "<div><span class='warning'>sem estados cadastrados</span></div>";
}
?>
<select name="estado_id" id="estado_id" required>
    <option value="">Selecione o estado</option>
    <?php
    foreach ($dados as $key) {
        $sel = ($key['id'] == $selecionado) ? "selected" : "";
        echo "<option value='{$key['id']}' $sel>" . htmlspecialchars($key['nome']) . " ({$key['sigla']})</option>";
    }
    ?>
</select>
