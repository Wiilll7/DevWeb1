<?php

include_once __DIR__ . "/LivroDAO.php";
class PDOLivroDAO extends LivroDAO
{
    private static $instance = NULL;
    private $conn = NULL;
    function PDOLivroDAO()
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
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    
    }

    function inserir($objeto)
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('INSERT INTO livro (nome, descricao) 
                 VALUES(:nome, :descricao)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':descricao' => $objeto->descricao
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }

    }

    function alterar($objeto)
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('UPDATE livro SET nome=:nome,descricao=:descricao 
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':descricao' => $objeto->descricao,
                    ':id' => $objeto->id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {      
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('DELETE FROM livro WHERE id=:id');
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }

    }

    function listar()
    {
        $dados = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM livro");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto = array();
                $objeto['id'] = $linha['id'];
                $objeto['nome'] = $linha['nome'];
                $objeto['descricao'] = $linha['descricao'];
                array_push($dados, $objeto);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;

    }

    function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM livro ".$filtro);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto = array();
                $objeto['id'] = $linha['id'];
                $objeto['nome'] = $linha['nome'];
                $objeto['descricao'] = $linha['descricao'];
                array_push($dados, $objeto);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }


        return $dados;

    }
    
    function obter($id)
    {
        $objeto = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM livro WHERE id=?");

            if ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto['id'] = $linha['id'];
                $objeto['nome'] = $linha['nome'];
                $objeto['descricao'] = $linha['descricao'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $objeto;
    }
}
?>