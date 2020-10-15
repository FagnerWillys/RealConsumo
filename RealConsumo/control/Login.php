<?php

//if (!isset($_SESSION)) {
//    session_start();
//}
require_once '../classes/Login.php';
require_once '../classes/Util.php';

function Processo($Processo) {
    //if (!isset($_SESSION)) {
    //    session_start();
    //}
    $util = new Util();
    switch ($Processo) {

        case 'login':
            if (@$_POST['ok'] == 'true') {
                $OPlogin = 10;
                $login2 = new Login();
                $login2->setLOGIN(md5(@$_POST['username']));
                $login2->setSENHA(md5(@$_POST['pass']));

                $data = $login2->consultar("SELECT * FROM login WHERE login = '" . $login2->getLOGIN() . "';");

                foreach ($data as $row) {
                    $passei = true;
                    $Login = new Login();
                    $Login->setLOGIN($row['LOGIN']);
                    $Login->setSENHA($row['SENHA']);
                    $Login->setStatus($row['p_status']);


                    if ($Login->getLOGIN() == $login2->getLOGIN()) {
                        //ACHOU LOGIN
                        if ($Login->getStatus()) {
                            if ($Login->getSENHA() == $login2->getSENHA()) {
                                $OPlogin = 0; //SENHA CORRETA LOGIN
                            } else {
                                $OPlogin = 1; //SENHA INCORRETA
                            }
                        } else {
                            $OPlogin = 2; //NÃO ATIVADO
                        }
                    }
                }
                if (empty($row)) {
                    $OPlogin = 3; //NÃO ACHOU O USUARIO 
                }
                switch ($OPlogin) {
                    case 0: //LOGIN
                        //INICIAR SESSÃO
                        $_SESSION['login'] = "OK";
                        $util->redirecionamentopage("TelaADM.php");
                        break;
                    case 1://SENHA INCORRETA
                        $util->msgBox("Senha Incorreta");
                        break;
                    case 2://NÃO ATIVADO
                        $util->msgBox("Usuario Desativado");
                        break;
                    case 3://NÃO ACHOU O USUARIO 
                        $util->msgBox("Usuario não Localizado");
                        break;
                }
            }
            break;
    }
}

?>
