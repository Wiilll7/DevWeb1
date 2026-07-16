<?php
include_once __DIR__ . "/ProdutoDAO.php";

class PDOProdutoDAO extends ProdutoDAO
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
            self::$instance = new PDOProdutoDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO produto (nome, categoria, descricao, preco, imagem)
                 VALUES (:nome, :categoria, :descricao, :preco, :imagem)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':categoria' => $objeto->categoria,
                    ':descricao' => $objeto->descricao,
                    ':preco' => $objeto->preco,
                    ':imagem' => $objeto->imagem
                )
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE produto SET nome=:nome, categoria=:categoria, descricao=:descricao,
                  preco=:preco, imagem=:imagem WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':categoria' => $objeto->categoria,
                    ':descricao' => $objeto->descricao,
                    ':preco' => $objeto->preco,
                    ':imagem' => $objeto->imagem,
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
            $stmt = $this->conn->prepare('DELETE FROM produto WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query("SELECT * FROM produto ORDER BY nome");
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
            $stmt = $this->conn->prepare("SELECT * FROM produto WHERE nome LIKE :filtro OR categoria LIKE :filtro ORDER BY nome");
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
            $stmt = $this->conn->prepare("SELECT * FROM produto WHERE id=:id");
            $stmt->execute(array(':id' => $id));
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $objeto = $linha;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $objeto;
    }

    function listarDestaques($limite = 3)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM produto ORDER BY id DESC LIMIT :limite");
            $stmt->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stmt->execute();
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
