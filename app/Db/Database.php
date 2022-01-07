<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
    /**
     * Host de conexao ccom o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome da tabela
     * @var string
     */
    const NAME = 'sistem_vagas';

    /**
     * Ususario do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha do danco
     * Senha do banco
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulado
     * @var string
     */
    private $table;

    /**
     * Instancia de conexao com o banco
     * @var PDO
     */
    private $connection;

    /**
     * Define a table e instancia a conexao
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;

        $this->setConnection();
    }

    /**
     * Metodo responsavel por criar uma conexao com o banco
     */
    private function setConnection()
    {
        try {
            $this->connection = new \PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }


    /**
     * Método responsável por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     * 
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }


    /**
     * Método responsavel por inserir dados no banco
     * @param array $values [field => value]
     * @return integer ID inserido
     */
    public function insert($values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');



        //MONTA QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //EXECUTA O INSERT 
        $this->execute($query, array_values($values));

        //RETORNA O ID
        return $this->connection->lastInsertId();
    }


    /**
     * Método responsavel por executar um consulta no banco
     * @param string $where
     * @param string $order 
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT' . $limit : '';

        //MONTA QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . '' . $limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }
    

    /**
     * Método responsavel para atualizar os dados do banco
     * @param string $where
     * @param array $values [field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        //EXECUTA A QUERY
        $this->execute($query, array_values($values));
        return true;
    }


    /**
     * MÉTODO RESPONSAVEL POR EXLUIR DADOS DO BANCO
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        //MONTA A QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;


        //EXECUTA A QUERY

        $this->execute($query);

        //RETORN SUCESSO
        return true;
    }
}
