
<?php
//if (!isset($_SESSION)) {
//    session_start();
//}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!--Criador ColorLib-->
        <title>RealConsumo - Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="imagem/png" href="../images/Logo.png" />  
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/css/util.css">
        <link rel="stylesheet" type="text/css" href="../CONFIG_LOGIN/css/main.css">
        <!--===============================================================================================-->
        <style>
            #Retornar{
                color: yellow;
                font-size: 20px;
            }
            #Retornar:hover{
                color: white;
                transition: 0.5s;
            }
        </style>
        <script>
            function login(formulario) {
                if (!validar(formulario)) {
                    return false;
                }

                formulario.ok.value = 'true';
                formulario.submit();

            }
        </script>
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('../CONFIG_LOGIN/images/bg-01.jpg');">
                <div class="wrap-login100 p-t-30 p-b-50">
                    <span class="login100-form-title p-b-41">
                        <center>
                            <a id="Retornar" href="../index.php">
                                Retornar ao Inicio?
                            </a>

                        </center>
                        Login da Conta Administrativa
                    </span>
                    <form id="form" method="POST" class="login100-form validate-form p-b-33 p-t-5">

                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" title="Campo Nome de Usuário Obrigatório!" type="text" name="username" placeholder="Nome de Usuário">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" title="Campo Senha Obrigatório!" type="password" name="pass" placeholder="Senha">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        </div>
                        <input name="ok" type="hidden" id="ok" value="false"/>
                        <div class="container-login100-form-btn m-t-32">
                            <button type="submit" onclick="login(form)" class="login100-form-btn">
                                Login
                            </button>

                        </div>

                    </form>
                </div>

            </div>

        </div>


        <div id="dropDownSelect1"></div>
        <?php
        //if (!isset($_SESSION)) {
        //    session_start();
        //}

        require_once '../control/Login.php';
        Processo('login');
        ?> 
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/vendor/bootstrap/js/popper.js"></script>
        <script src="../CONFIG_LOGIN/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/vendor/daterangepicker/moment.min.js"></script>
        <script src="../CONFIG_LOGIN/vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="../CONFIG_LOGIN/js/main.js"></script>
        <!--===============================================================================================-->
        <script src="../js/Validacaoform.js"></script>
        <script src="../js/util.js"></script>
    </body>
</html>