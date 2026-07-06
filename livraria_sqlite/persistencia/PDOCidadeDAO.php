<?php
include_once __DIR__ . "/CidadeDAO.php";

class PDOCidadeDAO extends CidadeDAO
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
            self::$instance = new PDOCidadeDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/biblioteca.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO cidade (nome, estado_id)
                 VALUES (:nome, :estado_id)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':estado_id' => $objeto->estado_id
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE cidade SET nome=:nome, estado_id=:estado_id
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':estado_id' => $objeto->estado_id,
                    ':id' => $objeto->id
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare('DELETE FROM cidade WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query(
                "SELECT c.*, e.nome AS estado_nome, e.sigla AS estado_sigla
                 FROM cidade c
                 JOIN estado e ON c.estado_id = e.id
                 ORDER BY c.nome"
            );
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($dados, $linha);
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $dados;
    }

    function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare(
                "SELECT c.*, e.nome AS estado_nome, e.sigla AS estado_sigla
                 FROM cidade c
                 JOIN estado e ON c.estado_id = e.id
                 WHERE c.nome LIKE :filtro
                 ORDER BY c.nome"
            );
            $stmt->execute(array(':filtro' => '%' . $filtro . '%'));
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($dados, $linha);
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $dados;
    }

    function obter($id)
    {
        $objeto = array();
        try {
            $stmt = $this->conn->prepare(
                "SELECT c.*, e.nome AS estado_nome, e.sigla AS estado_sigla
                 FROM cidade c
                 JOIN estado e ON c.estado_id = e.id
                 WHERE c.id=:id"
            );
            $stmt->execute(array(':id' => $id));
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $objeto = $linha;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $objeto;
    }
}
?>
