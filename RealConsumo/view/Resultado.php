

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
        <style>
            .resultado{
                text-align: center;
            }
        </style>

    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="Intencoes.html">Nossas Intenções</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="about">
            <center><figure>
                    <img src="../images/Logotipo.jpg " width="400" height="200">
                </figure></center>
            <br>        
            <div class="container">
                <div class="resultado">
                    <h2> Resultado: </h2><br>
                    <h3>
                        <?php
                        if (isset($_SESSION['usuario'])) {
                            if ($_SESSION['usuario'] === "OK") {
                                //CODIGO DA PAGINA
                                $ValorCalculado = @$_GET['ok'];
                                $ValorCobrado = @$_GET['ok1'];
                                $ValorCalculado = floor($ValorCalculado*100)/100;
                                $ValorCobrado = floor($ValorCobrado*100)/100;
                                
                                if ($ValorCalculado > 0 || $ValorCobrado > 0) {
                                    echo "Sua conta é de: R$: " . number_format($ValorCobrado, 2, ',', '') . " <br/>";
                                    echo "Valor estimado para sua conta é de R$: " . number_format($ValorCalculado, 2, ',', '') . " <br/>";
                                } else {
                                    echo 'Dados Inconclusivos reveja as informações passadas';
                                }
                                session_destroy();
                                //FECHAR USUARIO
                            } else {
                                require_once '../classes/Util.php';
                                $utill = new Util();
                                $utill->redirecionamentopage('../index.php');
                            }
                        } else {
                            require_once '../classes/Util.php';
                            $utill = new Util();
                            $utill->redirecionamentopage('../index.php');
                        }


                        //if (!isset($_SESSION)) {
                        //    session_start();
                        //}

                        
                        ?>
                    </h3>
                </div>
            </div>

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
            <span style="color: white; font-size: 10px;">Fonte: <a href="https://www.cedae.com.br/" target="_blank">https://www.cedae.com.br/</a></span>
            <!-- /.container -->
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
