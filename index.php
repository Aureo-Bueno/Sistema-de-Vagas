<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\Vaga;
    use \App\Db\Pagination;
    use \App\Session\Login;

    //OBRIGA O USUARIO A ESTAR LOGADO
    Login::requireLogin();

    //BUSCA POR INPUT 
    $busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_STRING); 

    //BUSCA POR SELECT
    $filtroStatus = filter_input(INPUT_GET,'filtroStatus', FILTER_SANITIZE_STRING); 
    $filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';
    


    //CONDIÇOES SQL
    $condicoes = [
         strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%',$busca).'%"' : null,
         strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
    ];

    //REMOVE POSIÇOES VAZIAS
    $condicoes = array_filter($condicoes);
    
    //CLAUSULA WHERE
    $where = implode(' AND ', $condicoes);


     
    //QUANTIDADE TOTAL DE VAGAS
    $quantidadeVagas = Vaga::getQuantidadeVagas($where);

    //Paginação
    $obPagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);
    

    //OBTEM AS VAGAS
    $vagas = Vaga::getVagas($where,null,null,$obPagination->getLimit());

    
    include __DIR__.'/includes/header.php';

    include __DIR__.'/includes/listagem.php';

    include __DIR__.'/includes/footer.php';




?>