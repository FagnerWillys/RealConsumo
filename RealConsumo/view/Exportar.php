<?php

//if (!isset($_SESSION)) {
//    session_start();
//}
if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] === "OK") {
        require_once '../control/ADMControle.php';
        Processo('EXPORTACAO EXCEL');
        
    } else {
        require_once '../classes/Util.php';
        $utill = new Util();
        $utill->msgBox("Você não tem permissão para acessar está pagina Redirecionando....");
        $utill->redirecionamentopage('Login.php');
    }
} else {
    require_once '../classes/Util.php';
    $utill = new Util();
    $utill->msgBox("Você não tem permissão para acessar está pagina Redirecionando....");
    $utill->redirecionamentopage('Login.php');
}

?>