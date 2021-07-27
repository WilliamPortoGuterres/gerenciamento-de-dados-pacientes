<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include("controler/loginobrigatorio.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="mycss.css">
    <title>Listar pacientes</title>
</head>
<body>
    <div class="container">
        <?php
        include("templates/nvbar.php");
       
        ?>
        <br>
        <div class="container">
            <form action="#" method="post" id="form1">
                <div class="container">
                    <h3 class="text-center"> Localização de pacientes</h3><BR></BR>
                    <div class="row">
                        <div class="col-sm">
                            <label for="selecionador">Selecione o metodo de pesquisa</label>
                            <select name="selecionador" class="form-control" id="selecionador">
                                <option value="nome">Nome do paciente</option>
                                <option value="cns">CNS</option>
                                <option value="nomedamae">Nome da mãe</option>
                                <option value="sexo">Sexo</option>
                                <option value="situacaoderua">Situação de rua</option>
                                 <option value="numeroprontuario">Número do prontuário</option>
<option value="endereco">Endereço</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="localizador">Localizador</label>
                            <input type="text" class="form-control" name="localizador" id="localizador">
                        </div>
                        <div class="col-sm">
                        </div>
                    </div>
                </div>
            </form><BR></BR>
            <div class="row">
<div class="container">
               
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                               <th scope="col">Editar</th>
                                <th scope="col">Nome      </th>
                                <th scope="col">Sexo</th>
                                <th scope="col">CNS</th>
                                <th class="text-nowrap" scope="col">Situação de rua</th>
                                <th class="text-nowrap" scope="col">Ultima presença</th>
                                <th class="text-nowrap" scope="col">Data de nascimento</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Endereço</th>
                                <th class="text-nowrap" scope="col">Data de registro</th>
                            </tr>
                        </thead>
                        <tbody id="resultado">
                        </tbody>
                    </table>
                
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