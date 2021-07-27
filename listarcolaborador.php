<?php
session_start();
//var_dump($_SESSION);
include("controler/loginobrigatorio.php");
include("controler/limit.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <link rel="stylesheet" href="mycss.css">
<link rel="shortcut icon" href="/imagens/ibsaudeico.ico" />
    <title>Listar colaboradores</title>
</head>

<body>
    <div class="container">
        <?php
        include("templates/nvbar.php");
        include("controler/loginobrigatorio.php");
        ?>
        <br>
        <div class="container">
            <?php
            if (isset($_SESSION["flag"])) {
                if ($_SESSION["flag"] == "sucesso") {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-success">O colaborador foi apagado </h4></div><div class="col-sm-4"></div>';
                } else {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-danger">O colaborador não foi apagado </h4></div><div class="col-sm-4"></div>';
                };
                unset($_SESSION["flag"]);
            }
            ?>
            <form id="formcolaboradores">
                <div class="container">
                    <h3 class="text-center"> Localização de colaborador</h3><BR></BR>
                    <div class="row">
 <div class="col-sm">
                        </div>
                        <div class="col-sm">
                            <label for="localizadorcolaborador">Localizador</label>
                            <input type="text" class="form-control" name="localizadorcolaborador" id="localizadorcolaborador">
                        </div>
                        <div class="col-sm">
                        </div>
                    </div>
                </div>
            </form><BR></BR>
            <div class="row justify-content-sm-center">
                
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                        <table class="table table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Nome </th>
                                    <th scope="col">Nick</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Função</th>

                                </tr>
                            </thead>
                            <tbody id="resultadocolaborador">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm">
                    </div>
               
            </div>
            <?php
            include("templates/footer.php");
            ?>
        </div>

        <?php
        include("script/script.php")
        ?>
</body>

</html>