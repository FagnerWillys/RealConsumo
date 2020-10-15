
<?php
//if (!isset($_SESSION)) {
//    session_start();
//}
?>
<!DOCTYPE html>
<html>
    <head>
        <!--LICENCIADO, Arquivo de licença LICENSE startbootstrap-scrolling-nav-gh-pages-->
        <link rel="icon" type="imagem/png" href="../images/Logo.png" />  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset = "utf-8">
        <title>Real Consumo</title>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/scrolling-nav.css" rel="stylesheet">


    </head>
    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container">
                <span class="navbar-brand js-scroll-trigger" style="color: greenyellow">Bem Vindo Administrador!</span>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="Intencoes.html">Nossas Intenções</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="../control/Sair.php">Sair</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <form id="form" name="form" method="post" action="">
                            <h2>Opções</h2>
                            <input type="radio" id="GerenciarClientes" name="Opcao" value="1" checked="">
                            <label for="GerenciarClientes">Gerenciar Clientes</label><br>
                            <input type="radio" id="AcessoCliente" name="Opcao" value="2">
                            <label for="AcessoCliente">Acessar como cliente</label><br>
                            <input type="radio" id="AlterarSenha" name="Opcao" value="3">
                            <label for="AlterarSenha">Alterar Senha</label>

                            <br/>

                            <button type="submit" class="btn btn-primary" onclick="validar(document.form);">Requisitar</button>
                            <input name="ok" type="hidden" id="ok" value="true"/>
                            <?php
                            //if (!isset($_SESSION)) {
                            //    session_start();
                            //}
                            if (isset($_SESSION['login'])) {
                                if ($_SESSION['login'] === "OK") {
                                    require_once('../control/ADMControle.php');
                                    Processo('Redirecionamento');
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



                        </form>

                    </div>
                </div>
            </div>
            <hr/>
        </section>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white"> Para Mais Infomações Acesse: <br>
                    <a href="https://www.youtube.com/playlist?list=PLnnobB6ZXmrhnAdqh9o-YJ4uitsUYw7vO" target="_blank">
                        <img src="../images/Youtube.png" width="40"> Katia Cavalcante - Advogada e Administradora
                    </a>
                </p>
            </div>
            <!-- /.container -->
            <span style="color: white; font-size: 10px;">Fonte: <a href="https://www.cedae.com.br/" target="_blank">https://www.cedae.com.br/</a></span>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom JavaScript for this theme -->
        <script src="js/scrolling-nav.js"></script>

    </body>

</html>
