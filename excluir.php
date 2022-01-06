<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\Vaga;
    use \App\Session\Login;

    //OBRIGA O USUARIO A ESTAR LOGADO
    Login::requireLogin();


    //VALIDA O ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?status=error');
        exit;
    }
    
    //CONSULTA A VAGA
    $obVaga = Vaga::getVaga($_GET['id']);

    // VALIDAR A VAGA
    if (!$obVaga instanceof Vaga){
        header('location: index.php?status=error');
        exit;
    }

   




    //VALIDAÇAO DO POST
    if (isset($_POST['excluir'])) {
        $obVaga->exluir();
        

        header('location: index.php?status=success');
        exit;



    }

    include __DIR__.'/includes/header.php';

    include __DIR__.'/includes/confirmar-exlusao.php';

    include __DIR__.'/includes/footer.php';




?>