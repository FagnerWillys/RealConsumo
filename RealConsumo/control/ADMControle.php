<?php

//if (!isset($_SESSION)) {
//    session_start();
//}
require_once '../classes/Cliente.php';
require_once '../classes/Endereco.php';
require_once '../classes/Util.php';
require_once '../classes/Export.php';
require_once '../classes/Conta.php';
require_once '../classes/Login.php';

function Processo($Processo) {
    $util = new Util();
    //if (!isset($_SESSION)) {
    //    session_start();
    //}
    if (isset($_SESSION['login'])) {
        if ($_SESSION['login'] === "OK") {
            //CODIGO DA PAGINA

            switch ($Processo) {

                case 'Redirecionamento':
                    if (@$_POST['ok'] == 'true') {
                        $Opcao = @$_POST['Opcao'];
                        switch ($Opcao) {
                            case 1:
                                $util->redirecionamentopage('Gclientes.php');
                                break;
                            case 2:
                                $util->redirecionamentopage('../index.php');
                                break;
                            case 3:
                                $util->redirecionamentopage('AlterarSenha.php');
                                break;
                        }
                    }
                    break;
                case 'VerificaArquivo':
                    if (@$_POST['ok'] == 'true') {
                        $escolha = @$_POST['escolha'];
                        switch ($escolha) {
                            case 'Importar':


                                if (!empty($_FILES['arquivo']['tmp_name'])) {
                                    $arquivo = new DomDocument();
                                    $arquivo->load($_FILES['arquivo']['tmp_name']);
                                    $linhas = $arquivo->getElementsByTagName("Row");
                                    $primeira_linha = true;

                                    foreach ($linhas as $linha) {
                                        if ($primeira_linha == false) {
                                            $Cliente = new Cliente();
                                            $Endereco = new Endereco();
                                            $Util = new Util();

                                            $CNPJ = null;
                                            $Email = null;
                                            $CEP = null;
                                            $N_Predio = null;
                                            $Complemento = null;
                                            $check = true;

                                            if (!empty($linha->getElementsByTagName("Data")->item(0)->nodeValue)) {
                                                $CNPJ = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                                            } else {
                                                $check = false;
                                            }
                                            if (!empty($linha->getElementsByTagName("Data")->item(1)->nodeValue)) {
                                                $Email = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                                            } else {
                                                $check = false;
                                            }
                                            if (!empty($linha->getElementsByTagName("Data")->item(2)->nodeValue)) {
                                                $CEP = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                                            } else {
                                                $check = false;
                                            }
                                            if (!empty($linha->getElementsByTagName("Data")->item(3)->nodeValue)) {
                                                $N_Predio = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                                            } else {
                                                $check = false;
                                            }
                                            if (!empty($linha->getElementsByTagName("Data")->item(4)->nodeValue)) {
                                                $Complemento = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                                            } else {
                                                $check = false;
                                            }


                                            //VISAO
                                            if ($check) {
                                                $Cliente2 = new Cliente();
                                                $Endereco2 = new Endereco();
                                                echo "<br> CNPJ = " . $Cliente2->maskcnpj($CNPJ);
                                                echo "<br> Email = " . $Email;
                                                echo "<br> CEP = " . $Endereco2->maskCEP($CEP);
                                                echo "<br> Complemento = " . $Complemento;
                                                echo "<br> N_Predio = " . $N_Predio;
                                                echo "<hr>";
                                            }
                                            //CONSULTAR SE REGISTRO EXISTE
                                            $data = $Cliente->Consultar("SELECT * FROM endereco AS E INNER JOIN clientes AS Cli ON E.CNPJ = Cli.CNPJ");

                                            $CLIENTEPODE = true;
                                            $ENDERECOPODE = true;
                                            $CNPJ = $util->RemoveMask($CNPJ);
                                            foreach ($data as $row) {
                                                $CNPJ_BUSCA = $row['CNPJ'];
                                                $CEP_BUSCA = $row['CEP'];
                                                if ($CNPJ_BUSCA == $CNPJ) {
                                                    $CLIENTEPODE = false;
                                                }
                                                if ($CNPJ_BUSCA == $CNPJ && $CEP_BUSCA == $CEP) {
                                                    $ENDERECOPODE = false;
                                                }
                                            }
                                            //Inserir o usuário no BD
                                            if ($check) {
                                                if ($CLIENTEPODE) {
                                                    $Cliente->incluir($Util->RemoveMask($CNPJ), $Email);
                                                } else {
                                                    $Cliente->alterar($Util->RemoveMask($CNPJ), $Email);
                                                }
                                                if ($ENDERECOPODE) {
                                                    $Endereco->incluir2($Util->RemoveMask($CNPJ), $Util->RemoveMask($CEP), $N_Predio, $Complemento);
                                                } else {
                                                    $Endereco->alterar($Util->RemoveMask($CNPJ), $Util->RemoveMask($CEP), $N_Predio, $Complemento);
                                                }
                                            }
                                        }
                                        $primeira_linha = false;
                                    }
                                } else {
                                    $util->msgBox('Arquivo não selecionado ou vazio!');
                                }

                                break;
                            case 'ImportarEXP':


                                if (!empty($_FILES['arquivo']['tmp_name'])) {
                                    $arquivo = new DomDocument();
                                    $arquivo->load($_FILES['arquivo']['tmp_name']);
                                    $linhas = $arquivo->getElementsByTagName("Row");
                                    $primeira_linha = true;

                                    foreach ($linhas as $linha) {
                                        if ($primeira_linha == false) {
                                            $Cliente = new Cliente();
                                            $Endereco = new Endereco();
                                            $Conta = new Conta();
                                            $Util = new Util();

                                            $CNPJ = null;
                                            $Email = null;
                                            $DataReg = null;
                                            $CEP = null;
                                            $Bairro = null;
                                            $Enderecoo = null;
                                            $Municipio = null;
                                            $Complemento = null;
                                            $N_Predio = null;
                                            $UF = null;
                                            $LANT = null;
                                            $LATU = null;
                                            $TpResidencia = null;
                                            $Tarifa = null;
                                            $Economias = null;
                                            $V_AGUA = null;
                                            $RECURSO_HIDROM = null;
                                            $TX_ANUAL = null;
                                            $V_ESGOTO = null;
                                            $ValorConta = null;
                                            $DataConta = null;
                                            $ContaCalc = null;
                                            $check = true;

                                            if (!empty($linha->getElementsByTagName("Data")->item(0)->nodeValue)) {
                                                $CNPJ = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(1)->nodeValue)) {
                                                $Email = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(2)->nodeValue)) {
                                                $DataReg = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(3)->nodeValue)) {
                                                $CEP = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(4)->nodeValue)) {
                                                $Bairro = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(5)->nodeValue)) {
                                                $Enderecoo = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(6)->nodeValue)) {
                                                $Municipio = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(7)->nodeValue)) {
                                                $Complemento = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(8)->nodeValue)) {
                                                $N_Predio = $linha->getElementsByTagName("Data")->item(8)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(9)->nodeValue)) {
                                                $UF = $linha->getElementsByTagName("Data")->item(9)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(10)->nodeValue)) {
                                                $LANT = $linha->getElementsByTagName("Data")->item(10)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(11)->nodeValue)) {
                                                $LATU = $linha->getElementsByTagName("Data")->item(11)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(12)->nodeValue)) {
                                                $TpResidencia = $linha->getElementsByTagName("Data")->item(12)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(13)->nodeValue)) {
                                                $Tarifa = $linha->getElementsByTagName("Data")->item(13)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(14)->nodeValue)) {
                                                $Economias = $linha->getElementsByTagName("Data")->item(14)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(15)->nodeValue)) {
                                                $V_AGUA = $linha->getElementsByTagName("Data")->item(15)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(16)->nodeValue)) {
                                                $RECURSO_HIDROM = $linha->getElementsByTagName("Data")->item(16)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(17)->nodeValue)) {
                                                $TX_ANUAL = $linha->getElementsByTagName("Data")->item(17)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(18)->nodeValue)) {
                                                $V_ESGOTO = $linha->getElementsByTagName("Data")->item(18)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(19)->nodeValue)) {
                                                $ValorConta = $linha->getElementsByTagName("Data")->item(19)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(20)->nodeValue)) {
                                                $DataConta = $linha->getElementsByTagName("Data")->item(20)->nodeValue;
                                            } else {
                                                $check = false;
                                            }

                                            if (!empty($linha->getElementsByTagName("Data")->item(21)->nodeValue)) {
                                                $ContaCalc = $linha->getElementsByTagName("Data")->item(21)->nodeValue;
                                            } else {
                                                $check = false;
                                            }


                                            //VISAO
                                            if ($check) {
                                                $Cliente2 = new Cliente();
                                                $Endereco2 = new Endereco();
                                                echo "<br> CNPJ = " . $Cliente2->maskcnpj($CNPJ);
                                                echo "<br> Email = " . $Email;
                                                $DataReg = $util->PREPARAEXCELPARASQL($DataReg);
                                                echo "<br> DataReg = " . $Cliente->maskDataParaHTML($DataReg);
                                                echo "<br> CEP = " . $Endereco2->maskCEP($CEP);
                                                echo "<br> Bairro = " . $Bairro;
                                                echo "<br> Endereço = " . $Enderecoo;
                                                echo "<br> Municipio = " . $Municipio;
                                                echo "<br> Complemento = " . $Complemento;
                                                echo "<br> N_Predio = " . $N_Predio;
                                                echo "<br> UF = " . $UF;
                                                echo "<br> LANT = " . $LANT;
                                                echo "<br> LATU = " . $LATU;
                                                echo "<br> TpResidencia = " . $TpResidencia;
                                                echo "<br> Tarifa = " . number_format($Tarifa, 3, ',', '');
                                                echo "<br> Economias = " . $Economias;
                                                echo "<br> V_AGUA = " . number_format($V_AGUA, 2, ',', '');
                                                echo "<br> RECURSO_HIDROM = " . number_format($RECURSO_HIDROM, 3, ',', '');
                                                echo "<br> TX_ANUAL = " . number_format($TX_ANUAL, 3, ',', '');
                                                echo "<br> V_ESGOTO = " . number_format($V_ESGOTO, 2, ',', '');
                                                echo "<br> ValorConta = " . number_format($ValorConta, 2, ',', '');
                                                $DataConta = $util->PREPARAEXCELPARASQL($DataConta);
                                                echo "<br> DataConta = " . $Cliente->maskDataParaHTML($DataConta);
                                                echo "<br> ContaCalc = " . number_format($ContaCalc, 2, ',', '');
                                                echo "<hr>";
                                            }
                                            //CONSULTAR SE REGISTRO EXISTE
                                            $data = $Cliente->Consultar("SELECT Cli.CNPJ, Cli.Email, Cli.DataReg,"
                                                    . " E.CEP, E.Endereco, E.N_Predio, E.Complemento, E.Bairro, E.Municipio, E.UF,"
                                                    . " C.DATACONTA , C.LANT, C.LATU, C.tpResidencia, C.Tarifa, C.Economias, C.V_AGUA,"
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
                                            //Inserir o usuário no BD
                                            if ($check) {
                                                if ($CLIENTEPODE) {
                                                    //MUDAR INSERT PARA INSERTAR DATAREG
                                                    $Cliente->incluirEXP($Util->RemoveMask($CNPJ), $Email, $DataReg);
                                                } else {
                                                    $Cliente->alterarEXP($Util->RemoveMask($CNPJ), $Email, $DataReg);
                                                }
                                                if ($ENDERECOPODE) {
                                                    $Endereco->incluirEXP($Util->RemoveMask($CNPJ), $Util->RemoveMask($CEP), $N_Predio, $Complemento, $Enderecoo, $Bairro, $Municipio, $UF);
                                                } else {
                                                    $Endereco->alterarEXP($Util->RemoveMask($CNPJ), $Util->RemoveMask($CEP), $N_Predio, $Complemento, $Enderecoo, $Bairro, $Municipio, $UF);
                                                }
                                                if ($CONTAPODE) {
                                                    $Conta->incluir($DataConta, $Util->RemoveMask($CNPJ), $Util->RemoveMask($CEP), $LANT, $LATU, $TpResidencia, $Util->VirgulaporPonto($Tarifa), $Util->VirgulaporPonto($Economias), $Util->VirgulaporPonto($V_AGUA), $Util->VirgulaporPonto($RECURSO_HIDROM), $Util->VirgulaporPonto($TX_ANUAL), $Util->VirgulaporPonto($V_ESGOTO), $Util->VirgulaporPonto($ValorConta));
                                                } else {
                                                    $Conta->alterara($DataConta, $Util->RemoveMask($CNPJ), $Util->RemoveMask($CEP), $LANT, $LATU, $TpResidencia, $Util->VirgulaporPonto($Tarifa), $Util->VirgulaporPonto($Economias), $Util->VirgulaporPonto($V_AGUA), $Util->VirgulaporPonto($RECURSO_HIDROM), $Util->VirgulaporPonto($TX_ANUAL), $Util->VirgulaporPonto($V_ESGOTO), $Util->VirgulaporPonto($ValorConta));
                                                }
                                            }
                                        }
                                        $primeira_linha = false;
                                    }
                                } else {
                                    $util->msgBox('Arquivo não selecionado ou vazio!');
                                }

                                break;
                            case 'Exportar':
                                $util->redirecionamentopage('Exportar.php');
                                break;
                            case 'Limpar':
                                $Aprovado = @$_POST['confirm'];
                                if ($Aprovado == "True") {
                                    $Cliente = new Cliente();
                                    $Cliente->Limpar();
                                }
                                break;
                        }
                    }
                    break;
                case 'EXPORTACAO EXCEL':
                    $Cliente = new Cliente();
                    $Endereco = new Endereco();
                    $Conta = new Conta();
                    $i = 0;
                    //EDITAR
                    $data = $Cliente->Consultar("SELECT Cli.CNPJ, Cli.Email, Cli.DataReg,"
                            . " E.CEP, E.Endereco, E.N_Predio, E.Complemento, E.Bairro, E.Municipio, E.UF,"
                            . " C.DATACONTA, C.LANT, C.LATU, C.tpResidencia, C.Tarifa, C.Economias, C.V_AGUA,"
                            . " C.RECURSO_HIDROM, C.TX_ANUAL, C.V_ESGOTO, C.ValorConta"
                            . " FROM endereco AS E INNER JOIN clientes AS Cli INNER JOIN conta AS C "
                            . "ON E.CNPJ = Cli.CNPJ and C.CNPJ = Cli.CNPJ and C.CEP = E.CEP; ");

                    $dataEXP = [];
                    foreach ($data as $row) {
                        $Cliente->setCNPJ($row['CNPJ']);
                        $Cliente->setEmail($row['Email']);
                        $Cliente->setDataReg($row['DataReg']);

                        $Endereco->setCNPJ($Cliente->getCNPJ());
                        $Endereco->setCEP($row['CEP']);
                        $Endereco->setBairro($row['Bairro']);
                        $Endereco->setEndereco($row['Endereco']);
                        $Endereco->setMunicipio($row['Municipio']);
                        $Endereco->setComplemento($row['Complemento']);
                        $Endereco->setN_Predio($row['N_Predio']);
                        $Endereco->setUF($row['UF']);

                        $Conta->setLANT($row['LANT']);
                        $Conta->setLATU($row['LATU']);
                        $Conta->settpResidencia($row['tpResidencia']);
                        $Conta->setTarifa($row['Tarifa']);
                        $Conta->setEconomias($row['Economias']);
                        $Conta->setV_AGUA($row['V_AGUA']);
                        $Conta->setRECURSO_HIDROM($row['RECURSO_HIDROM']);
                        $Conta->setTX_ANUAL($row['TX_ANUAL']);
                        $Conta->setV_ESGOTO($row['V_ESGOTO']);
                        $Conta->setValorConta($row['ValorConta']);
                        $Conta->setDataConta($row['DATACONTA']);

                        //CLIENTE
                        $dataEXP[$i]['CNPJ'] = $Cliente->getCNPJ();
                        $dataEXP[$i]['Email'] = $Cliente->getEmail();
                        $dataEXP[$i]['DataReg'] = '="' . $Cliente->maskDataParaHTML($Cliente->getDataReg()) . '"';

                        //ENDERECO
                        $dataEXP[$i]['CEP'] = $Endereco->getCEP();
                        $dataEXP[$i]['Bairro'] = $Endereco->getBairro();
                        $dataEXP[$i]['Endereco'] = $Endereco->getEndereco();
                        $dataEXP[$i]['Municipio'] = $Endereco->getMunicipio();
                        $dataEXP[$i]['Complemento'] = $Endereco->getComplemento();
                        $dataEXP[$i]['N_Predio'] = $Endereco->getN_Predio();
                        $dataEXP[$i]['UF'] = $Endereco->getUF();

                        //CONTA
                        $dataEXP[$i]['LANT'] = $Conta->getLANT();
                        $dataEXP[$i]['LATU'] = $Conta->getLATU();
                        $dataEXP[$i]['tpResidencia'] = $Conta->gettpResidencia();
                        $dataEXP[$i]['Tarifa'] = $util->PontoporVirgula($Conta->getTarifa());
                        $dataEXP[$i]['Economias'] = $util->PontoporVirgula($Conta->getEconomias());
                        $dataEXP[$i]['V_AGUA'] = $util->PontoporVirgula($Conta->getV_AGUA());
                        $dataEXP[$i]['RECURSO_HIDROM'] = $util->PontoporVirgula($Conta->getRECURSO_HIDROM());
                        $dataEXP[$i]['TX_ANUAL'] = $util->PontoporVirgula($Conta->getTX_ANUAL());
                        $dataEXP[$i]['V_ESGOTO'] = $util->PontoporVirgula($Conta->getV_ESGOTO());
                        $dataEXP[$i]['ValorConta'] = $util->PontoporVirgula($Conta->getValorConta());
                        $dataEXP[$i]['DataConta'] = '="' . $Cliente->maskDataParaHTML($Conta->getDataConta()) . '"';
                        $dataEXP[$i]['ContaCalc'] = $util->PontoporVirgula($Conta->CALCULAR());
                        $i++;
                    }
                    if (empty($row)) {
                        $util->msgBox('Tabela sem Registro');
                        $util->redirecionamentopage('Gclientes.php');
                    } else {
                        $export = new Export();
                        $export->excel('Lista de Clientes, Enderecos e Contas', 'Lista de Clientes', $dataEXP);
                    }
                    break;

                case 'AlterarSenha':
                    if (@$_POST['ok'] == 'true') {
                        $OPlogin = 10;
                        $login2 = new Login();
                        $login2->setLOGIN(md5(@$_POST['Login']));
                        $login2->setSENHA(md5(@$_POST['SenhaAnt']));
                        $Nova_Senha = md5(@$_POST['SenhaNOV']);

                        if ($login2->getSENHA() == $Nova_Senha) {
                            $util->msgBox('sua senha atual não pode ser igual a senha nova.');
                        } else {
                            $AcessoUSR = new Login();
                            $data = $AcessoUSR->consultar("SELECT * FROM login WHERE login = '" . $login2->getLOGIN() . "';");

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
                                case 0: //ALTERAR SENHA
                                    $Login->alterar($login2->getLOGIN(), $Nova_Senha, $login2->getSENHA());
                                    $util->msgBox("Senha Alterada com Sucesso");
                                    break;
                                case 1://SENHA INCORRETA
                                    $util->msgBox("Senha Incorreta");
                                    break;
                                case 2://NÃO ATIVADO
                                    $util->msgBox("Usuario desativado operação de alteração de senha cancelada");
                                    break;
                                case 3://NÃO ACHOU O USUARIO 
                                    $util->msgBox("Usuario não Localizado");
                                    break;
                            }
                        }
                    }
                    break;
            }
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
}

?>
