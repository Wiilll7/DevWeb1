<?php

$dao = PDOEstadoDAO::getInstance();
$dados = array();
$dados = $dao->listar();
if (($dados == NULL) || (count($dados) == 0)) {
    echo "<div><span class='warning'>sem dados a serem exibidos</span></div>";
}
?>
<select name="estado_id">
    <option value="">Selecione o estado</option>
    <?php
            foreach ($dados as $key)
                echo "<option value='{$key['id']}'>{$key['sigla']}</option>";
            ?>
</select>