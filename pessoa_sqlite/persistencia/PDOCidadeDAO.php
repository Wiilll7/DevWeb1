<?php
/*
 * Código de exemplo da utilização de PDO como persistencia
 * Classe abstrata para persistencia de Cidade
 * @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
 * @version 0.1
 *
 */
include_once __DIR__ . "/CidadeDAO.php";
class PDOCidadeDAO extends CidadeDAO
{
    private static $instance = NULL;
    private $conn = NULL;
    function PDOCidadeDAO()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDOCidadeDAO();        
        return self::$instance;
    }

    /*
     * Método faz a conexao com o recurso usado
     * @return void
     */
    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    
    }
    /*
     * Método que insere dados no sistema de persistencia
     * @param $objeto Cidade objeto que será inserido 
     * @return void
     */
    function inserir($objeto)
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('INSERT INTO cidade (nome, estado_id) 
                 VALUES(:nome, :estado_id)');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':estado_id' => $objeto->estado_id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }

    }
    /*
     * Método que altera dados no sistema de persistencia
     * @param $objeto Cidade objeto que será inserido 
     * @return void
     */
    function alterar($objeto)
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('UPDATE cidade SET nome=:nome,estado_id=:estado_id 
                  WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':estado_id' => $objeto->estado_id,
                    ':id' => $objeto->id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }
    /*
     * Método que exclui dados no sistema de persistencia
     * @param $id int identificador do registro 
     * @return void
     */
    function excluir($id)
    {
        try {      
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('DELETE FROM cidade WHERE id=:id');
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
    /*
     * Método que lista dados no sistema de persistencia
     * @return array array de dados
     */
    function listar()
    {
        $dados = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // com aritmetica relacional
            //$result = $this->conn->query("SELECT c.*,e.nome as estado_nome FROM cidade c, estado e where c.estado_id=e.id");
            //com join
            $result = $this->conn->query("SELECT c.*,e.nome as estado_nome FROM cidade c JOIN estado e ON c.estado_id=e.id");
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto = array();
                $objeto['id'] = $linha['id'];
                $objeto['nome'] = $linha['nome'];
                $objeto['estado_id'] = $linha['estado_id'];
                $objeto['estado_nome'] = $linha['estado_nome'];
                array_push($dados, $objeto);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;

    }
    /* Método que lista dados com filtro no sistema de persistencia
     * @param $filtro String filtro para dados     
     * @return array array de dados
     */
    function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM cidade ".$filtro);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto = array();
                $objeto['id'] = $linha['id'];
                $objeto['nome'] = $linha['nome'];
                $objeto['estado_id'] = $linha['estado_id'];
                array_push($dados, $objeto);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }


        return $dados;

    }
    /*
     * Método que obtem dados no sistema de persistencia
     * @param $id int identificador do registro 
     * @return array objeto em array
     */
    function obter($id)
    {
        $objeto = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM cidade WHERE id=?");

            if ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $objeto['id'] = $linha['id'];
                $objeto['nome'] = $linha['nome'];
                $objeto['estado_id'] = $linha['estado_id'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $objeto;
    }
}
?>