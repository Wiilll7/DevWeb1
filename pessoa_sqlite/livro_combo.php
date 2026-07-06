<?php
$dao = PDOLivroDAO::getInstance();
$dados = array();
$dados = $dao->listar();
?>
<select name="livro_id">
    <option value="">Selecione o livro</option>
    <?php
            foreach ($dados as $key)
                echo "<option value='{$key['id']}'>{$key['nome']}</option>";
            ?>
</select>