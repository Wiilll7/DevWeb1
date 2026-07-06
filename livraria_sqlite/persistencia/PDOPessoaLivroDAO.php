<?php
include_once __DIR__ . "/PessoaLivroDAO.php";

class PDOPessoaLivroDAO extends PessoaLivroDAO
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
            self::$instance = new PDOPessoaLivroDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO pessoa_livro (pessoa_id, livro_id, data_emprestimo, prazo)
                 VALUES (:pessoa_id, :livro_id, :data_emprestimo, :prazo)');
            $stmt->execute(
                array(
                    ':pessoa_id' => $objeto->pessoa_id,
                    ':livro_id' => $objeto->livro_id,
                    ':data_emprestimo' => $objeto->data_emprestimo,
                    ':prazo' => $objeto->prazo
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE pessoa_livro
                  SET pessoa_id=:pessoa_id, livro_id=:livro_id, data_emprestimo=:data_emprestimo, prazo=:prazo
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':pessoa_id' => $objeto->pessoa_id,
                    ':livro_id' => $objeto->livro_id,
                    ':data_emprestimo' => $objeto->data_emprestimo,
                    ':prazo' => $objeto->prazo,
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
            $stmt = $this->conn->prepare('DELETE FROM pessoa_livro WHERE id=:id');
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
                "SELECT pl.*, p.nome AS pessoa_nome, l.nome AS livro_nome
                 FROM pessoa_livro pl
                 JOIN pessoa p ON pl.pessoa_id = p.id
                 JOIN livro l ON pl.livro_id = l.id
                 ORDER BY pl.data_emprestimo DESC"
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
                "SELECT pl.*, p.nome AS pessoa_nome, l.nome AS livro_nome
                 FROM pessoa_livro pl
                 JOIN pessoa p ON pl.pessoa_id = p.id
                 JOIN livro l ON pl.livro_id = l.id
                 WHERE p.nome LIKE :filtro OR l.nome LIKE :filtro
                 ORDER BY pl.data_emprestimo DESC"
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
                "SELECT pl.*, p.nome AS pessoa_nome, l.nome AS livro_nome
                 FROM pessoa_livro pl
                 JOIN pessoa p ON pl.pessoa_id = p.id
                 JOIN livro l ON pl.livro_id = l.id
                 WHERE pl.id=:id"
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

    function listarPorPessoa($pessoa_id)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare(
                "SELECT pl.*, l.nome AS livro_nome
                 FROM pessoa_livro pl
                 JOIN livro l ON pl.livro_id = l.id
                 WHERE pl.pessoa_id = :pessoa_id
                 ORDER BY pl.data_emprestimo DESC"
            );
            $stmt->execute(array(':pessoa_id' => $pessoa_id));
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
