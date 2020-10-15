
<?php
//if (!isset($_SESSION)) {
//    session_start();
//}
?>
<!DOCTYPE html>
<html>
    <head>
        <!--LICENCIADO, Arquivo de licença LICENSE startbootstrap-scrolling-nav-gh-pages-->
        <!-- CONFIGURAÇÃO BASICA -->
        <link rel="icon" type="imagem/png" href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Real Consumo</title>


        <!-- CONFIGURAÇÃO JS -->

        <!-- JS VALIDAÇÃO -->
        <script src="js/Validacaoform.js"></script>
        <script src="js/util.js"></script>
        <!-- Bootstrap JS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/scrolling-nav.js"></script>

        <!-- CONFIGURAÇÃO CSS -->
        <!-- CSS Bootstrap-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/scrolling-nav.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/util.css" rel="stylesheet">
        <style>
            h1, h2{
                text-align: center;
            }
            .Negrito{
                font-weight: bold;
            }
        </style>
        <script>
            function check(div) {
                if (div.checked === true) {
                    document.getElementById('submit').disabled = false;
                } else {
                    document.getElementById('submit').disabled = true;
                }
            }
        </script>
    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Inicio</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="view/Intencoes.html">Nossas Intenções</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="bg-primary text-white">
            <div class="container text-center">
                <h1>Você já verificou sua conta de água?</h1>
                <p  class="lead">Nosso objetivo é responder a essa pregunta por meio de dados referentes à conta de abastecimento de água/esgoto. Desse modo, calcularemos com você. 
                    <a style="color: skyblue;" class="nav-item" href="#about">vamos começar? </a> 
                    <br> O calculo só é valido para <span class="Negrito">TIPO DE FATURAMENTO MÍNIMO</span> 
                </p>
                <iframe width="320" height="180" src="https://www.youtube.com/embed/gqzybOCQQfQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </header>
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h1>Formulário</h1>
                        <br/>
                        <h2>Dados Cadastrais</h2>
                        <hr/>
                        <form id="form" name="form" method="post" action="">
                            <div class="form-group">

                                <label for="CNPJ">CNPJ *</label>
                                <input name="CNPJ" type="text" class="form-control" title="Campo CNPJ Obrigatorio!" id="CNPJ" aria-describedby="CNPJHelp" placeholder="Exemplo: 00.000.000/0000-00">

                            </div>
                            <div class="form-group">  

                                <label for="Email">Email *</label>
                                <input name="Email" type="email" class="form-control" title="Campo Email Obrigatorio!" id="Email" aria-describedby="emailHelp" placeholder="Exemplo: Seu email">

                            </div>
                            <div class="form-group">

                                <label for="CEP">CEP *</label>
                                <input name="CEP" type="text" class="form-control" title="Campo CEP Obrigatorio!" id="CEP" placeholder="Exemplo: 00000-000" size="10" maxlength="9" onblur="pesquisacep(this.value);">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero">N° *</label>
                                    <input name="N" type="text" title="Campo N° Obrigatorio!" class="form-control" id="numero" placeholder="Exemplo: 100">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="complemento">Complemento</label>
                                    <input name="Complemento" type="text" class="form-control" id="complemento" placeholder="Exemplo: APT 102">
                                </div>
                            </div>


                            <br/>
                            <h2>Dados da Conta</h2>
                            <hr/>
                            <h5 style="text-align: center;">Hidrômetro</h5>
                            <br/>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="L_ANT">Leitura Anterior * <a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <input title="Campo Leitura Anterior Obrigatorio!" name="LANT" type="number" step="1.00" class="form-control" id="L_ANT" placeholder="Exemplo: 300023"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="L_ATU">Leitura Atual * <a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <input title="Campo Leitura Atual Obrigatorio!" name="LATU" type="number" class="form-control" id="L_ATU" placeholder="Exemplo: 600033">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="TPResidencia">Tipo de Residência * <a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <select name="tpResidencia" id="TPResidencia" class="form-control">
                                        <option value="1"  selected="">Residencial</option>
                                        <option value="2">Comercial</option>
                                        <option value="3">Misto</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="Tarifa">Tarifa de Consumo em R$ * <a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <input title="Campo Leitura Tarifa de Consumo da 1° Faixa em R$ Obrigatorio!" name="Tarifa" type="text" class="form-control" id="Tarifa" placeholder="Exemplo: 9,000">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="VCONTA">Valor da Conta em R$ * <a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <input title="Valor da Conta em R$ é Obrigatorio!" name="VCONTA" type="text" class="form-control" id="Economias" placeholder="Exemplo: 230,43">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="Economias">N° de Economias <a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <input title="Economias e Campo Obrigatorio" name="Economias" type="text" class="form-control" id="Economias" placeholder="Exemplo: 3">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Data">Data de Vencimento*<a href="https://www.cedae.com.br/conheca_sua_conta#dnn_ctr544_HtmlModule_lblContent" target="_blank">Não Achou?</a></label>
                                    <input title="Campo Data da Conta Obrigatorio!" name="Data" type="date" class="form-control" id="Data" placeholder="Exemplo: 06/12/2020">
                                </div>

                            </div>
                            <br>
                            <input id='aceito' type="checkbox" name="aceito" value="aceito" onclick='check(this)'> Eu aceito os <a href="Politica_de_Privacidade/politica_de_privacidade.pdf" target="_blank">Termos Politica de Privacidade</a>.<br>
                            <br>
                            <button  type="submit" id="submit" class="btn btn-primary" onclick="ValidarCliente(form);" disabled="true">Enviar</button>
                            <input name="ok" type="hidden" id="ok" value="false"/>

                        </form>
                        <?php
                        $_SESSION['usuario'] = "OK";
                        require_once 'control/ClienteConta.php';
                        Processo('ClienteVAI');
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white"> Para Mais Infomações Acesse: <br>
                    <a href="https://www.youtube.com/playlist?list=PLnnobB6ZXmrhnAdqh9o-YJ4uitsUYw7vO" target="_blank">
                        <img src="images/Youtube.png" width="40"> Katia Cavalcante - Advogada e Administradora
                    </a>
                </p>
            </div>
            <span style="color: white; font-size: 10px;">Fonte: <a href="https://www.cedae.com.br/" target="_blank">https://www.cedae.com.br/</a></span>
            <!-- /.container -->
        </footer>
    </body>
</html>
