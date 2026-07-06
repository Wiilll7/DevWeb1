<?php
include_once __DIR__ . "/EstadoDAO.php";

class PDOEstadoDAO extends EstadoDAO
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
            self::$instance = new PDOEstadoDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO estado (nome, sigla)
                 VALUES (:nome, :sigla)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':sigla' => $objeto->sigla
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE estado SET nome=:nome, sigla=:sigla
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':sigla' => $objeto->sigla,
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
            $stmt = $this->conn->prepare('DELETE FROM estado WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query("SELECT * FROM estado ORDER BY nome");
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
            $stmt = $this->conn->prepare("SELECT * FROM estado WHERE nome LIKE :filtro OR sigla LIKE :filtro ORDER BY nome");
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
            $stmt = $this->conn->prepare("SELECT * FROM estado WHERE id=:id");
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
