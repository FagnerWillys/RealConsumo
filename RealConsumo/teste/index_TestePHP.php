<!DOCTYPE html>
<html>
    <head>
        <!-- CONFIGURAÇÃO BASICA -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>TESTE PHP</title>

        <script>

            function validarFULL(formulario) {
                alert('ENTROU NO JAVASCRIPT');
                formulario.ok.value = 'true';
                formulario.submit();
            }
        </script>


        <style>
            h1{
                text-align: center;
            }
        </style>
    </head>

    <body id="page-top">
                        <h1>TESTE PHP ACESSO BD</h1>
                        <form id="form" name="form" method="post" action="">
                            <div class="form-group col-md-6">
                                <label for="teste1">Insert Dado 1*</label>
                                <input title="Campo Insert Dado 1 Obrigatorio!" name="teste1" type="text" class="form-control" id="teste1" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="teste2">Insert Dado 2*</label>
                                <input name="teste2" type="text" class="form-control" id="teste2" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tpComando">Tipo de Comando * </label>
                                <select name="tpComando" id="TPResidencia" class="form-control">
                                    <option value="1"  selected="">Insert</option>
                                    <option value="2">Update</option>
                                    <option value="3">Delete ALL</option>
                                    <option value="4">Select</option>
                                </select>
                            </div>


                    <button  class="btn btn-primary" onclick="validarFULL(form);">Enviar</button>
                    <input name="ok" type="hidden" id="ok" value="false"/>

                    </form>
                    <?php
                    require_once '../control/Teste.php';
                    Processo('Teste');
                    ?>
</body>
</html>
