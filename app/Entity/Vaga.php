<?php

namespace App\Entity;

use \App\Db\Database;

use \PDO;



class Vaga
{


     /**
      * Indentificador unico vaga
      * @var integer
      */
     public $id;

     /**
      * Título da vaga
      * @var string
      */
     public $titulo;

     /**
      * Descricao vaga
      * @var string
      */
     public $descricao;

     /**
      * Defini se a vaga esta ativa
      * @var string(s/n)
      */
     public $ativo;

     /**
      * Data de publicaçao da vaga
      * @var string
      */
     public $data;

     /**
      * Método responsavel por cadastrar uma nova vaga no banco
      * @return boolean
      */

     public function cadastrar()
     {

          //DEFINIR DATA
          $this->data = date('Y-m-d H:i:s');

          //INSERIR A VAGA NO BANCO
          $obDatabase = new Database('vagas');
          $this->id = $obDatabase->insert([
               'titulo' => $this->titulo,
               'descricao' => $this->descricao,
               'ativo' => $this->ativo,
               'data' => $this->data
          ]);

          //RETORNAR SUCESSO
          return true;
     }

     /**
      * Método por atualizar a vaga no banco
      * @return boolean
      */
     public function atualizar()
     {
          return (new Database('vagas'))->update('id = ' . $this->id, [
               'titulo' => $this->titulo,
               'descricao' => $this->descricao,
               'ativo' => $this->ativo,
               'data' => $this->data
          ]);
     }

     /**
      * METODO RESPONSAVEL POR EXLUIR A VAGA DO BANCO
      * @return boolean
      */
     public function exluir()
     {
          return (new Database('vagas'))->delete('id = ' . $this->id);
     }



     /**
      * Método responsavel por obter os dados do banco de dados
      * @param string $where
      * @param string $order
      * @param string $limit
      * @return array
      */
     public static function getVagas($where = null, $order = null, $limit = null)
     {
          return (new Database('vagas'))->select($where, $order, $limit)
               ->fetchAll(PDO::FETCH_CLASS, self::class);
     }

     /**
      * Método responsavel por obter a quantidade de vagas
      * @param string $where
      * @return integer
      */
     public static function getQuantidadeVagas($where = null)
     {
          return (new Database('vagas'))->select($where, null, null, 'COUNT(*) as qtd')
               ->fetchObject()
               ->qtd;
     }

     /**
      *Método responsavel por buscar com base no ID
      * @param integer $id
      * @return Vaga
      */
     public static function getVaga($id)
     {
          return (new Database('vagas'))->select('id =' . $id)->fetchObject(self::class);
     }
}
