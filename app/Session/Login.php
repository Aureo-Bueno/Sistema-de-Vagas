<?php

namespace App\Session;

class Login
{

  /**
   * Método responsável por iniciar a sessão
   */
  private static function init()
  {
    //VERIFICA STATUS DA SESSÃO
    if (session_status() !== PHP_SESSION_ACTIVE) {
      //INICIA A SESSÃO
      session_start();
    }
  }

  /**
   * Método responsável por retornar os dados do usuário logado
   *
   * @return array
   */
  public static function getUsuarioLogado()
  {
    //INCIIA A SESSÃO
    self::init();

    //RETORNA DADOS DO USUARIO
    return self::isLogged() ? $_SESSION['usuario'] : null;
  }

  /**
   * Método responsável por logar o usuário
   *
   * @param Usuario $obUsuario
   */
  public static function login($obUsuario)
  {
    //INICIA A SESSÃO  
    self::init();

    //SESSÃO DO USUARIO
    $_SESSION['usuario'] = [
      'id' => $obUsuario->id,
      'nome' => $obUsuario->nome,
      'email' => $obUsuario->email
    ];

    //REDIRECIONA O USUÁRIO PARA INDEX
    header('location: index.php');
    exit;
  }

  /**
   * Método responsável por deslogar o usuario
   */
  public static function logout()
  {
    //INICIA A SESSÃO
    self::init();

    //REMOVE A SESSAO DO USUÁRIO
    unset($_SESSION['usuario']);

     //REDIRECIONA O USUÁRIO PARA LOGIN
     header('location: login.php');
     exit;
  }

  /**
   * Método responsavel por verificar se o usuario esta logado
   * @return boolean
   */
  public static function isLogged()
  {
    //INICIA A SESSÃO
    self::init();

    //VALIDAÇÃO DA SESSAO
    return isset($_SESSION['usuario']['id']);
  }

  /**
   * Método responsavel por obrigar o usuario a estar logado para acessar
   */
  public static function requireLogin()
  {
    if (!self::isLogged()) {
      header('location: login.php');
      exit;
    }
  }

  /**
   * Método responsavel por obrigar o usuario a estar deslogado para acessar
   */
  public static function requireLogout()
  {
    if (self::isLogged()) {
      header('location: index.php');
      exit;
    }
  }
}
