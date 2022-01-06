<?php

  namespace App\Db;

  class Pagination{
     /**
      * Número máximo de registros por páginas
      * @var integer
      */
      private $limit;

      /**
       * Quantidade total de resultados do banco
       * @var integer
       */
      private $results;

      /**
       * Quantidade de paginas
       * @var integer
       */
      private $pages;


      /**
       * Pagina Atual
       * @var integer
       */
      private $currentPage;

      /**
       * Construtor da classe
       * @param integer $results
       * @param integer $currentPages
       * @param integer $limit
       */
      public function __construct($results,$currentPage = 1, $limit = 10){
          $this->results = $results;
          $this->limit = $limit;
          $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
          $this->calculate();
          
      }

      /**
       * Método responsavel por calcular á paginação
       */
      private function calculate(){
          //Calcula o total de paginas
          $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

          //Verifica se a pagina atual nao excede o numero de paginas
          $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
      }


      /**
       * Método responsavel por retornar a clausula limit da sql
       * @return string
       */
      public function getLimit(){
          $offset = ($this->limit * ($this->currentPage - 1));
          return $offset.','.$this->limit;

      }


      /**
       * Metodo responsavel por restornar as opçoes de paginas disponiveis
       * @return array
       */
      public function getPages(){
        //NAO RETORNA A PAGINA
        if($this->pages == 1)return[];

        //PAGINAS
        $paginas = [];

        for ($i=1; $i <= $this->pages ; $i++) { 
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPage
            ];
        }
        return $paginas;
      }



  }