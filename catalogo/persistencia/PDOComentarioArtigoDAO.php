<?php
include_once __DIR__ . "/ComentarioArtigoDAO.php";

class PDOComentarioArtigoDAO extends ComentarioArtigoDAO
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
            self::$instance = new PDOComentarioArtigoDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO comentario_artigo (artigo_id, nome_usuario, comentario)
                 VALUES (:artigo_id, :nome_usuario, :comentario)');
            $stmt->execute(
                array(
                    ':artigo_id' => $objeto->artigo_id,
                    ':nome_usuario' => $objeto->nome_usuario,
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
            $stmt = $this->conn->prepare('DELETE FROM comentario_artigo WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listarPorArtigo($artigo_id)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare(
                "SELECT * FROM comentario_artigo WHERE artigo_id = :artigo_id ORDER BY data_comentario DESC"
            );
            $stmt->execute(array(':artigo_id' => $artigo_id));
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
