<?php
session_start();
include("controler/loginobrigatorio.php");
include("controler/conecta.php");
include("controler/limit.php");
$identificadordeedicao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_usuarios = "SELECT * FROM `colaboradores` WHERE `id_colaboradores`like'$identificadordeedicao' ";

//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);

if ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="/css/mycss.css">
  <title>Editor de colaboradores</title>
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
                        <h4 class="btn btn-success">O colaborador foi atualizado </h4></div><div class="col-sm-4"></div>';
                } else {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-danger">O colaborador não foi atualizado </h4></div><div class="col-sm-4"></div>';
                };
                unset($_SESSION["flag"]);
            }
            ?>
            <div class="py-5 text-center">
                <!--<img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
                <h2>Editor de colaboradores</h2>
                <!--<p class="lead">Abaixo temos um exemplo de formulário construído com controles de formulário Bootstrap. Cada campo obrigatório possui um estado de validação que é ativado quando tenta-se enviar o formulário sem completá-lo.</p>-->
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 order-md-1">

                    <form action="controler/atualizacolaborador.php" method="post">
                        <!--inicio do registro de colborador-->

                        <input type="hidden" name="id_colaboradores" value="<?php echo $row_usuario["id_colaboradores"]; ?>">

                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="nomecolaborador">Nome do colaborador</label>
                                <input type="text" class="form-control" id="nomecolaborador" name="nomecolaborador" placeholder="" value="<?php echo $row_usuario["nomecolaborador"]; ?>">




                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="tr">Nick</label>
                                <div id="respostatr"></div>
                                <input type="text" class="form-control" id="tr" name="tr" placeholder="" value="<?php echo $row_usuario["nickcolaborador"]; ?>" required="">
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
                            <div class="col-md mb-1">
                                <label for="cbo">CBO</label>

                                <input type="text" class="form-control cbo" id="cbo" name="cbo" placeholder="" value="<?php echo $row_usuario["cbo"]; ?>" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir o CBO.
                                </div>
                            </div>
                            <div class="col-md mb-1">
                                <label for="cns">CNS</label>

                                <input type="text" class="form-control cns" id="cns" name="cns" placeholder="" value="<?php echo $row_usuario["cns"]; ?>" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir o CNS.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="emailcolaborador">E-mail</label>
                                <p id="respostaemail"></p>
                                <input type="email" class="form-control" id="emailcolaborador" name="emailcolaborador" placeholder="" value="<?php echo $row_usuario["emailcolaborador"]; ?>" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um E-mail válido.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-1">
                                <label for="funcaocolaborador">Função </label>
                                <select type="select" class="form-control" id="funcaocolaborador" placeholder="" name="funcaocolaborador" value="<?php echo $row_usuario["funcaocolaborador"]; ?>">
                                    <option value="administrador" <?= ($row_usuario['funcaocolaborador'] == 'administrador') ? 'selected' : '' ?>>Administrador</option>
                                   
                                    <option value="colaborador" <?= ($row_usuario['funcaocolaborador'] == 'colaborador') ? 'selected' : '' ?>>Colaborador</option>
                                    <!--<option value="estagiario" <?= ($row_usuario['funcaocolaborador'] == 'estagiario') ? 'selected' : '' ?>>Estagiário</option>-->
                                </select>
                            </div>
<div class="col-md-3 mb-1">
                                <label for="atendimentotr">TR </label>
                                <select type="select" class="form-control" id="atendimentotr" name="atendimentotr" placeholder="" value="<?php echo $row_usuario["atendimentotr"]; ?>" >
                                    <option value="" <?= ($row_usuario['atendimentotr'] == '') ? 'selected' : '' ?>>Não</option>
                                    <option value="tr" <?= ($row_usuario['atendimentotr'] == 'tr') ? 'selected' : '' ?>>Sim</option>
                                    
                                    <!--<option value="nao">Estagiário</option>-->

                                </select>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="especialidade">Especialidade</label>
                                <select type="select" class="form-control" id="especialidade" name="especialidade" placeholder="" value="<?php echo $row_usuario["especialidade"]; ?>">
                                    <option value="" <?= ($row_usuario['especialidade'] == '') ? 'selected' : '' ?>></option>
                                    <option value="Atendimento psiquiátrico" <?= ($row_usuario['especialidade'] == 'Atendimento psiquiátrico') ? 'selected' : '' ?>>Psiquiátra</option>
                                    <option value="Atendimento clinico" <?= ($row_usuario['especialidade'] == 'aAtendimento clínico') ? 'selected' : '' ?>> Clínico</option>
                                    <option value="Assistente social" <?= ($row_usuario['especialidade'] == 'Assistente social') ? 'selected' : '' ?>>Assistênte social</option>
                                    <option value="Atendimento psicológico" <?= ($row_usuario['especialidade'] == 'Atendimento psicológico') ? 'selected' : '' ?>> Psicólogo</option>
                                    <option value="Educador físico" <?= ($row_usuario['especialidade'] == 'Educador físico') ? 'selected' : '' ?>>Educador físico</option>
                                    <option value="Enfermagem" <?= ($row_usuario['especialidade'] == 'Enfermagem') ? 'selected' : '' ?>>Enfermagem</option>
                                    <option value="Técnico de enfermagem" <?= ($row_usuario['especialidade'] == 'Técnico de enfermagem') ? 'selected' : '' ?>>Técnico de enfermagem</option>
                                    <option value="Terapeuta ocupacional" <?= ($row_usuario['especialidade'] == 'Terapeuta ocupacional') ? 'selected' : '' ?>>Terapeuta ocupacional</option>
                                    <option value="Educador físico"<?= ($row_usuario['especialidade'] == 'Educador físico') ? 'selected' : '' ?>>Educador físico</option>
                                    <option value="permanência noturna"<?= ($row_usuario['especialidade'] == 'permanência noturna') ? 'selected' : '' ?>>permanência noturna</option>
                                    <option value="Oficineiro"<?= ($row_usuario['especialidade'] == 'Oficineiro') ? 'selected' : '' ?>>Oficineiro</option>
                                    <!--<option value="nao">Estagiário</option>-->

                                </select>
                            </div>
                            <div class="col-md mb-1">
                                <label for="telefonecolaborador">Telefone</label>
                                <input type="text" class="form-control" id="telefonecolaborador" name="telefonecolaborador" placeholder="" value="<?php echo $row_usuario["telefonecolaborador"]; ?>" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um Telefone válido.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md mb-1">
                                <label for="enderecocolaborador">Endereço Completo</label>
                                <input type="text" class="form-control" id="enderecocolaborador" name="enderecocolaborador" placeholder="" value="<?php echo $row_usuario["enderecocolaborador"]; ?>" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um endereço válido.
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-sm-4 mb-1 mt-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Atualizar</button>
                            </div>
                        </div>
         <div class="row justify-content-md-center">
                            <div class="col-sm-4 mb-1 mt-3">
                    </form>
                    <form action="controler/deletausuario.php" method="post">
                        <input type="hidden" name="id_colaboradores" value="<?php echo $row_usuario["id_colaboradores"]; ?>">
                        <button class="btn btn-danger btn-lg btn-block" onclick='return pergunta();' type="submit">Apagar usuário</button>
                    </form>
                </div>
            </div>
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
<script>
function pergunta(){ 
   // retorna true se confirmado, ou false se cancelado
   return confirm('Tem certeza que quer enviar este pedido?');
}</script>
</body>

</html>