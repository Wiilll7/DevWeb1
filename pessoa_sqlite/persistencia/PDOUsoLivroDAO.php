<?php

include_once __DIR__ . "/UsoLivroDAO.php";
class PDOUsoLivroDAO extends UsoLivroDAO
{
    private static $instance = NULL;
    private $conn = NULL;
    function PDOUsoLivroDAO()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDOUsoLivroDAO();        
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

            $stmt = $this->conn->prepare('INSERT INTO emprestimo_livro (livro_id, pessoa_id, prazo, data_emprestimo) 
                 VALUES(:livro_id, :pessoa_id, :prazo, :data_emprestimo)');
            $stmt->execute(
                array(
                    ':livro_id' => $objeto->livro_id,
                    ':pessoa_id' => $objeto->pessoa_id,
                    ':prazo' => $objeto->prazo,
                    ':data_emprestimo' => $objeto->data_emprestimo
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

            $stmt = $this->conn->prepare('UPDATE emprestimo_livro SET livro_id=:livro_id,
                  pessoa_id=:pessoa_id, prazo=:prazo, data_emprestimo=:data_emprestimo
                  WHERE id=:id');
            $stmt->execute(
                array(
                 ':livro_id' => $objeto->livro_id,
                 ':pessoa_id' => $objeto->pessoa_id,
                 ':prazo' => $objeto->prazo,
                 ':data_emprestimo' => $objeto->data_emprestimo,
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

            $stmt = $this->conn->prepare('DELETE FROM emprestimo_livro WHERE id=:id');
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

            $result = $this->conn->query("SELECT * FROM emprestimo_livro");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto = array();

                $objeto['id'] = $linha['id'];
                $objeto['livro_id'] = $linha['livro_id'];
                $objeto['pessoa_id'] = $linha['pessoa_id'];
                $objeto['prazo'] = $linha['prazo'];
                $objeto['data_emprestimo'] = $linha['data_emprestimo'];
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

            $result = $this->conn->query("SELECT * FROM emprestimo_livro ".$filtro);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto = array();

                $objeto['id'] = $linha['id'];
                $objeto['livro_id'] = $linha['livro_id'];
                $objeto['pessoa_id'] = $linha['pessoa_id'];
                $objeto['prazo'] = $linha['prazo'];
                $objeto['data_emprestimo'] = $linha['data_emprestimo'];
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

            $result = $this->conn->query("SELECT * FROM emprestimo_livro WHERE id=?");

            if ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto['id'] = $linha['id'];
                $objeto['livro_id'] = $linha['livro_id'];
                $objeto['pessoa_id'] = $linha['pessoa_id'];
                $objeto['prazo'] = $linha['prazo'];
                $objeto['data_emprestimo'] = $linha['data_emprestimo'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $objeto;
    }
}
?>