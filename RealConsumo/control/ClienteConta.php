<?php

function Processo($Processo) {
    require_once ('classes/Conta.php');
    require_once ('classes/Endereco.php');
    require_once ('classes/Cliente.php');
    require_once ('classes/Util.php');
//    if (!isset($_SESSION)) {
//        session_start();
//    }
    $util = new Util();
    switch ($Processo) {
        case 'ClienteVAI':
            if (@$_POST['ok'] == 'true') {
                $Cliente = new Cliente();
                $Endereco = new Endereco();
                $Conta = new Conta();

                //CLIENTE
                $CNPJ = @$_POST['CNPJ'];
                $Email = @$_POST['Email'];

                //ENDERECO
                $CEP = @$_POST['CEP'];
                $N = @$_POST['N'];
                if (!is_numeric($N)) {
                    $N = 0;
                }
                $Complemento = @$_POST['Complemento'];

                //CONTA
                $LANT = @$_POST['LANT'];
                $LATU = @$_POST['LATU'];
                $tpResidencia = @$_POST['tpResidencia'];
                $Tarifa = @$_POST['Tarifa'];
                $Economias = @$_POST['Economias'];
                $ValorConta = @$_POST['VCONTA'];
                $DataConta = @$_POST['Data'];

                $Tarifa = $util->VirgulaporPonto($Tarifa);
                $Economias = $util->VirgulaporPonto($Economias);
                if (!is_numeric($Economias)) {
                    $Economias = 0;
                }
                $ValorConta = $util->VirgulaporPonto($ValorConta);

                $Conta->setLANT($LANT);
                $Conta->setLATU($LATU);
                $Conta->setTpResidencia($tpResidencia);
                $Conta->setTarifa($Tarifa);
                $Conta->setEconomias($Economias);
                $Conta->setValorConta($ValorConta);

                $ValorContaCALC = $Conta->CALCULAR();

                $V_AGUA = $Conta->getV_AGUA();
                $RECURSO_HIDROM = $Conta->getRECURSO_HIDROM();
                $TX_ANUAL = $Conta->getTX_ANUAL();
                $V_ESGOTO = $Conta->getV_ESGOTO();

                switch ($tpResidencia) {
                    case 1:
                        $tpResidencia = 'Residencial';
                        break;
                    case 2:
                        $tpResidencia = 'Comercial';
                        break;
                    case 3:
                        $tpResidencia = 'Misto';
                        break;
                }
//EDITAR
                $ENCONTROU = FALSE;
                $data = $Cliente->Consultar("SELECT Cli.CNPJ, Cli.Email, Cli.DataReg,"
                        . " E.CEP, E.Endereco, E.N_Predio, E.Complemento, E.Bairro, E.Municipio, E.UF,"
                        . " C.DATACONTA, C.LANT, C.LATU, C.tpResidencia, C.Tarifa, C.Economias, C.V_AGUA,"
                        . " C.RECURSO_HIDROM, C.TX_ANUAL, C.V_ESGOTO, C.ValorConta"
                        . " FROM endereco AS E INNER JOIN clientes AS Cli INNER JOIN conta AS C "
                        . "ON E.CNPJ = Cli.CNPJ and C.CNPJ = Cli.CNPJ and C.CEP = E.CEP; ");
                $CLIENTEPODE = true;
                $ENDERECOPODE = true;
                $CONTAPODE = true;
                $CNPJ = $util->RemoveMask($CNPJ);
                foreach ($data as $row) {
                    $CNPJ_BUSCA = $row['CNPJ'];
                    $CEP_BUSCA = $row['CEP'];
                    $DataConta_BUSCA = $row['DATACONTA'];

                    if ($CNPJ_BUSCA == $CNPJ) {
                        $CLIENTEPODE = false;
                    }
                    if ($CNPJ_BUSCA == $CNPJ && $CEP_BUSCA == $CEP) {
                        $ENDERECOPODE = false;
                    }
                    //DATA FORMATO SQL (DATACONTA E DATAREG)
                    if ($CNPJ_BUSCA == $CNPJ && $CEP_BUSCA == $CEP && $DataConta_BUSCA == $DataConta) {
                        $CONTAPODE = false;
                    }
                }
                //INCLUDENOVO
                if ($CLIENTEPODE) {
                    //MUDAR INSERT PARA INSERTAR DATAREG
                    $Cliente->incluir($CNPJ, $Email);
                } else {
                    $Cliente->alterar($CNPJ, $Email);
                }
                if ($ENDERECOPODE) {
                    //errobuscacep
                    $Endereco->incluir2($CNPJ, $CEP, $N, $Complemento);
                } else {
                    $Endereco->alterar($CNPJ, $CEP, $N, $Complemento);
                }
                if ($CONTAPODE) {
                    $Conta->incluir($DataConta, $CNPJ, $CEP, $LANT, $LATU, $tpResidencia, $Tarifa, $Economias, $V_AGUA, $RECURSO_HIDROM, $TX_ANUAL, $V_ESGOTO, $ValorConta);
                } else {
                    $Conta->alterara($DataConta, $CNPJ, $CEP, $LANT, $LATU, $tpResidencia, $Tarifa, $Economias, $V_AGUA, $RECURSO_HIDROM, $TX_ANUAL, $V_ESGOTO, $ValorConta);
                }
                //FIM DO CADASTRO
                $util->redirecionamentopage3('view/Resultado.php', $ValorContaCALC, $Conta->getValorConta());
            }

            break;
    }
}

?>
