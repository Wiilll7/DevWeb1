<?php
include_once __DIR__ . "/ArtigoDAO.php";

class PDOArtigoDAO extends ArtigoDAO
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
            self::$instance = new PDOArtigoDAO();
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
            $stmt = $this->conn->prepare('INSERT INTO artigo (titulo, resumo, conteudo, imagem)
                 VALUES (:titulo, :resumo, :conteudo, :imagem)');
            $stmt->execute(
                array(
                    ':titulo' => $objeto->titulo,
                    ':resumo' => $objeto->resumo,
                    ':conteudo' => $objeto->conteudo,
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
            $stmt = $this->conn->prepare('UPDATE artigo SET titulo=:titulo, resumo=:resumo, conteudo=:conteudo,
                  imagem=:imagem WHERE id=:id');
            $stmt->execute(
                array(
                    ':titulo' => $objeto->titulo,
                    ':resumo' => $objeto->resumo,
                    ':conteudo' => $objeto->conteudo,
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
            $stmt = $this->conn->prepare('DELETE FROM artigo WHERE id=:id');
            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query("SELECT * FROM artigo ORDER BY data_publicacao DESC");
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
            $stmt = $this->conn->prepare("SELECT * FROM artigo WHERE titulo LIKE :filtro OR resumo LIKE :filtro ORDER BY data_publicacao DESC");
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
            $stmt = $this->conn->prepare("SELECT * FROM artigo WHERE id=:id");
            $stmt->execute(array(':id' => $id));
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $objeto = $linha;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
        return $objeto;
    }

    function listarDestaques($limite = 2)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM artigo ORDER BY data_publicacao DESC LIMIT :limite");
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
