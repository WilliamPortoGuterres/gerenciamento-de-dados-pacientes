<?php
session_start();
include("controler/loginobrigatorio.php");
include("controler/limit.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/mycss.css">
  <title>Cadastro de colaboradores</title>
</head>

<body>
    <div class="container">
        <?php
        include("templates/nvbar.php");
        ?>
        <div class="container">
            <?php
            if (isset($_SESSION["flag"])) {
                if ($_SESSION["flag"] == "sucesso") {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-success">O colaborador foi cadastrado </h4></div><div class="col-sm-4"></div>';
                } else {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-danger">O colaborador não foi cadastrado </h4></div><div class="col-sm-4"></div>';
                };
                unset($_SESSION["flag"]);
            }
            ?>
            <div class="py-5 text-center">
                <!--<img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
                <h2>Cadastro de colaboradores</h2>
                <!--<p class="lead">Abaixo temos um exemplo de formulário construído com controles de formulário Bootstrap. Cada campo obrigatório possui um estado de validação que é ativado quando tenta-se enviar o formulário sem completá-lo.</p>-->
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7 order-md-1">

                    <form action="controler/cadastracolaboradores.php" method="post">
                        <!--inicio do registro de paciente-->

                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="nomecolaborador">Nome Completo</label>
                                <input type="text" class="form-control" id="nomecolaborador" name="nomecolaborador" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um nome válido.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="tr">Nick</label>
                                <div id="respostatr"></div>
                                <input type="text" class="form-control" id="tr" name="tr" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um Nick válido.
                                </div>
                            </div>
                            <div class="col-md mb-1">
                                <label for="senhacolaborador">Senha</label>
                                <input type="text" class="form-control" id="senhacolaborador" name="senhacolaborador" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir uma senha válida.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="cbo">CBO</label>
                                <input type="text" class="form-control cbo" id="cbo" name="cbo" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir o CBO.
                                </div>
                            </div>

                            <div class="col-md mb-1">
                                <label for="cns">CNS</label>
                                <input type="text" class="form-control cns" id="cns" name="cns" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir o CNS.
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="emailcolaborador">E-mail</label>
                                <div id="respostaemail"></div>
                                <input type="email" class="form-control" id="emailcolaborador" name="emailcolaborador" placeholder="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um E-mail válido.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="enderecocolaborador">Endereço Completo</label>
                                <input type="text" class="form-control" id="enderecocolaborador" name="enderecocolaborador" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um endereço válido.
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-1">
                                <label for="funcaocolaborador">Função </label>
                                <select type="select" class="form-control" id="funcaocolaborador" name="funcaocolaborador" placeholder="" value="" required="">
                                    
                                    <option value="colaborador">Colaborador</option>
                                    <option value="administrador">Administrador</option>
                                    <!--<option value="nao">Estagiário</option>-->

                                </select>
                            </div>
 <div class="col-md-2 mb-1">
                                <label for="atendimentotr">TR </label>
                                <select type="select" class="form-control" id="atendimentotr" name="atendimentotr" placeholder="" value="" >
                                    <option value="">Não</option>
                                    <option value="tr">Sim</option>
                                    
                                    <!--<option value="nao">Estagiário</option>-->

                                </select>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="especialidade">Especialidade</label>
                                <select type="select" class="form-control" id="especialidade" name="especialidade" placeholder="" value="" >
                                    <option value=""></option>
                                    <option value="Atendimento psiquiátrico">Psiquiátra</option>
                                    <option value="Atendimento clinico">Clinico</option>
                                    <option value="Assistente social">Assistente social</option>
                                    <option value="Atendimento psicológico">Psicólogo</option>
                                    <option value="Assistencia social">Assistencia social</option>
                                    <option value="Enfermagem">Enfermagem</option>
                                    <option value="Técnico de enfermagem"> Técnico de enfermagem</option>
                                    <option value="Terapeuta ocupacional">Terapeuta ocupacional</option>
                                    <option value="Educador físico">Educador físico </option>
                                     <option value="Oficineiro">Oficineiro</option>
                                    <option value="permanência noturna">permanência noturna</option>
                                    <!--<option value="nao">Estagiário</option>-->

                                </select>
                            </div>
                            <div class="col-md mb-1">
                                <label for="telefonecolaborador">Telefone</label>
                                <input type="text" class="form-control telefone" id="telefonecolaborador" name="telefonecolaborador" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um Telefone válido.
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-sm-4 mb-1 mt-3">
                                <button id="btncadastracolaborador" class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
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