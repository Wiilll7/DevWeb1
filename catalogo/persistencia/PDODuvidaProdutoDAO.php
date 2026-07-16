<?php
include_once __DIR__ . "/DuvidaProdutoDAO.php";

class PDODuvidaProdutoDAO extends DuvidaProdutoDAO
{
    private static $instance = NULL;
    private $conn = NULL;

    function __construct()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDODuvidaProdutoDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/loja.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO duvida_produto (produto_id, nome_usuario, pergunta)
                 VALUES (:produto_id, :nome_usuario, :pergunta)');
            $stmt->execute(
                array(
                    ':produto_id' => $objeto->produto_id,
                    ':nome_usuario' => $objeto->nome_usuario,
                    ':pergunta' => $objeto->pergunta
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare('DELETE FROM duvida_produto WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listarPorProduto($produto_id)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare(
                "SELECT * FROM duvida_produto WHERE produto_id = :produto_id ORDER BY data_duvida DESC"
            );
            $stmt->execute(array(':produto_id' => $produto_id));
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($dados, $linha);
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $dados;
    }
}
?>
