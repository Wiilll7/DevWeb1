<?php
include_once __DIR__ . "/AvaliacaoProdutoDAO.php";

class PDOAvaliacaoProdutoDAO extends AvaliacaoProdutoDAO
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
            self::$instance = new PDOAvaliacaoProdutoDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO avaliacao_produto (produto_id, nome_usuario, nota, comentario)
                 VALUES (:produto_id, :nome_usuario, :nota, :comentario)');
            $stmt->execute(
                array(
                    ':produto_id' => $objeto->produto_id,
                    ':nome_usuario' => $objeto->nome_usuario,
                    ':nota' => $objeto->nota,
                    ':comentario' => $objeto->comentario
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare('DELETE FROM avaliacao_produto WHERE id=:id');
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
                "SELECT * FROM avaliacao_produto WHERE produto_id = :produto_id ORDER BY data_avaliacao DESC"
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

    function mediaPorProduto($produto_id)
    {
        $media = array('media' => 0, 'total' => 0);
        try {
            $stmt = $this->conn->prepare(
                "SELECT AVG(nota) AS media, COUNT(*) AS total FROM avaliacao_produto WHERE produto_id = :produto_id"
            );
            $stmt->execute(array(':produto_id' => $produto_id));
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $media = $linha;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $media;
    }
}
?>
