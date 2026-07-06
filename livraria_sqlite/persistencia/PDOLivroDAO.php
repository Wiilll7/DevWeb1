<?php
include_once __DIR__ . "/LivroDAO.php";

class PDOLivroDAO extends LivroDAO
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
            self::$instance = new PDOLivroDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO livro (nome, autor, genero, descricao)
                 VALUES (:nome, :autor, :genero, :descricao)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':autor' => $objeto->autor,
                    ':genero' => $objeto->genero,
                    ':descricao' => $objeto->descricao
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE livro SET nome=:nome, autor=:autor, genero=:genero, descricao=:descricao
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':autor' => $objeto->autor,
                    ':genero' => $objeto->genero,
                    ':descricao' => $objeto->descricao,
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
            $stmt = $this->conn->prepare('DELETE FROM livro WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query("SELECT * FROM livro ORDER BY nome");
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
                "SELECT * FROM livro
                 WHERE nome LIKE :filtro OR autor LIKE :filtro OR genero LIKE :filtro
                 ORDER BY nome"
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
            $stmt = $this->conn->prepare("SELECT * FROM livro WHERE id=:id");
            $stmt->execute(array(':id' => $id));
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $objeto = $linha;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $objeto;
    }

    function listarEmprestimosDoLivro($livro_id)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare(
                "SELECT pl.*, p.nome AS pessoa_nome
                 FROM pessoa_livro pl
                 JOIN pessoa p ON pl.pessoa_id = p.id
                 WHERE pl.livro_id = :livro_id
                 ORDER BY pl.data_emprestimo DESC"
            );
            $stmt->execute(array(':livro_id' => $livro_id));
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
