<?php

$dao = PDOPessoaDAO::getInstance();
$dados = array();
$dados = $dao->listar();
?>
<select name="pessoa_id">
    <option value="">Selecione o pessoa</option>
    <?php
            foreach ($dados as $key)
                echo "<option value='{$key['id']}'>{$key['nome']}</option>";
            ?>
</select>