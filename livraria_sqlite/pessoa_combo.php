<?php
require_once "persistencia/PDOPessoaDAO.php";

$dao = PDOPessoaDAO::getInstance();
$dados = $dao->listar();
if (!isset($selecionado)) {
    $selecionado = "";
}
if (($dados == NULL) || (count($dados) == 0)) {
    echo "<div><span class='warning'>sem pessoas cadastradas</span></div>";
}
?>
<select name="pessoa_id" id="pessoa_id" required>
    <option value="">Selecione a pessoa</option>
    <?php
    foreach ($dados as $key) {
        $sel = ($key['id'] == $selecionado) ? "selected" : "";
        echo "<option value='{$key['id']}' $sel>" . htmlspecialchars($key['nome']) . "</option>";
    }
    ?>
</select>
