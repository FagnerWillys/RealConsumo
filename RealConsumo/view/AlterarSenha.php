
<?php
//if (!isset($_SESSION)) {
//    session_start();
//}
?>
<!DOCTYPE html>
<head>
    <!--LICENCIADO, Arquivo de licença LICENSE startbootstrap-scrolling-nav-gh-pages-->
    <!-- CONFIGURAÇÃO BASICA -->
    <link rel="icon" type="imagem/png" href="../images/Logo.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Real Consumo</title>


    <!-- CONFIGURAÇÃO JS -->'

    <!-- JS VALIDAÇÃO -->'
    <script src="../js/Validacaoform.js"></script>
    <script src="../js/util.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/scrolling-nav.js"></script>

    <!-- CONFIGURAÇÃO CSS -->
    <!-- CSS Bootstrap-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../css/scrolling-nav.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/util.css" rel="stylesheet">
    <script>
        function Validaralterarsenha2(formulario) {
            if (!validar(formulario)) {
                return false;
            }

            formulario.ok.value = 'true';
            formulario.submit();

        }
    </script>

</head>
<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="TelaADM.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                    <div class="row">
                        <h2>Alterar Senha</h2> 
                    </div>
                    <br/>
                    <form id="form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Login">Login *</label>
                            <input name="Login" type="text" class="form-control" title="Campo Login Obrigatorio!" id="Login" aria-describedby="Login">
                        </div>
                        <div class="form-group">
                            <label for="SenhaAnt">Senha Atual*</label>
                            <input name="SenhaAnt" type="password" class="form-control" title="Campo Senha Atual Obrigatorio!" id="SenhaAnt" aria-describedby="SenhaAnt">
                        </div>
                        <div class="form-group">
                            <label for="SenhaNOV">Nova Senha *</label>
                            <input name="SenhaNOV" type="password" class="form-control" title="Campo Nova Senha Obrigatorio!" id="SenhaNOV" aria-describedby="SenhaNOV">
                        </div>
                        <br/>
                        <input name="ok" type="hidden" id="ok" value="false"/>
                        <input name="confirm" type="hidden" id="confirm" value="false"/>
                        <button type="submit" class="btn btn-primary" onclick="Validaralterarsenha2(form)" value="Visualizar">Requisitar</button>

                        <br/>
                        <br/>
                    </form> 
                    <?php
                    //if (!isset($_SESSION)) {
                     //   session_start();
                    //}
                    if (isset($_SESSION['login'])) {
                        if ($_SESSION['login'] === "OK") {
                            //CODIGO DA PAGINA
                            require_once '../control/ADMControle.php';
                            Processo('AlterarSenha');
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
        <span style="color: white; font-size: 10px;">Fonte: <a href="https://www.cedae.com.br/" target="_blank">https://www.cedae.com.br/</a></span>
        <!-- /.container -->
    </footer>
</body>

</html>
