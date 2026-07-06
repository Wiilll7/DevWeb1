<?php
include_once __DIR__ . "/PessoaDAO.php";

class PDOPessoaDAO extends PessoaDAO
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
            self::$instance = new PDOPessoaDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO pessoa (nome, cidade_id, peso, altura)
                 VALUES (:nome, :cidade_id, :peso, :altura)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':cidade_id' => $objeto->cidade_id,
                    ':peso' => $objeto->peso,
                    ':altura' => $objeto->altura
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE pessoa SET nome=:nome, cidade_id=:cidade_id, peso=:peso, altura=:altura
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':cidade_id' => $objeto->cidade_id,
                    ':peso' => $objeto->peso,
                    ':altura' => $objeto->altura,
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
            $stmt = $this->conn->prepare('DELETE FROM pessoa WHERE id=:id');
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
                "SELECT p.*, c.nome AS cidade_nome
                 FROM pessoa p
                 LEFT JOIN cidade c ON p.cidade_id = c.id
                 ORDER BY p.nome"
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
                "SELECT p.*, c.nome AS cidade_nome
                 FROM pessoa p
                 LEFT JOIN cidade c ON p.cidade_id = c.id
                 WHERE p.nome LIKE :filtro
                 ORDER BY p.nome"
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
                "SELECT p.*, c.nome AS cidade_nome
                 FROM pessoa p
                 LEFT JOIN cidade c ON p.cidade_id = c.id
                 WHERE p.id=:id"
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
