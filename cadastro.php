<?php
session_start();
include("controler/loginobrigatorio.php");
include("controler/conecta.php");
date_default_timezone_set('America/Sao_Paulo'); 
$datapresenca = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mycss.css">
    <title>Cadastro</title>
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
                        <h4 class="btn btn-success">O paciente foi cadastrado </h4></div><div class="col-sm-4"></div>';
                } else {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-danger">O paciente não foi cadastrado </h4></div><div class="col-sm-4"></div>';
                };
                unset($_SESSION["flag"]);
            }
            ?>


            <div class="py-5 text-center">
                <!--<img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
                <h2>Formulário de cadastro de paciente</h2>
                <!--<p class="lead">Abaixo temos um exemplo de formulário construído com controles de formulário Bootstrap. Cada campo obrigatório possui um estado de validação que é ativado quando tenta-se enviar o formulário sem completá-lo.</p>-->
            </div>

            <div class="row">

                <div class="col-md order-md-1">

                    <form action="controler/cadastra.php" method="post">
                        <!--inicio do registro de paciente-->
                        <div class="row">
                            <div class="col-sm-7"></div>
                            <div class="col-md-2">

                                <label for="dataderegistro">Data de entrada</label>
                                <input type="data" class="form-control mascaradata" id="dataderegistro" placeholder="" name="dataderegistro" value="<?php echo  implode("/", array_reverse(explode("-", $datapresenca))); ?>">
                            </div>
                            <div class="col-md-3">
                                <!--   <div>
                                    <label for="numeroprontuario">N° do prontuário</label>
                                    <input type="text" class="form-control" id="numeroprontuario" name="numeroprontuario" placeholder="">
                                </div>-->


                                <div>
                                    <label for="atendimentotr">TR</label>
                                    <select type="select" class="form-control" id="atendimentotr" value="<?php echo $row_usuario['atendimentotr']; ?>" name="atendimentotr" placeholder="">
                                        <option value=""></option>
                                        <?php
                                        //var_dump($result_usuarios);		echo "<br>" ;
                                        $result_usuarios = "SELECT nomecolaborador,id_colaboradores FROM `colaboradores` where atendimentotr like 'tr'";
                                        $resultado_usuarios = mysqli_query($conn, $result_usuarios);
                                        while ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                                            //var_dump($result_usuarios2);
                                            echo  '<option value="' . $row_usuario['id_colaboradores'] . '">' . $row_usuario['nomecolaborador'] . '</option>';
                                            //var_dump($row_usuario);
                                        }

                                        ?>

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label for="nome">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um nome válido.
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">


                                <label for="sexo">Sexo</label>
                                <select type="select" class="form-control" id="sexo" name="sexo" placeholder="">
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                    <option value="trans">Trans</option>


                                </select>


                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cid">CID</label>
                                <select type="select" class="form-control" name="cid" id="cid">
                                    <option value=""></option>
                                    <option value="F10.2">F10.2</option>
                                    <option value="F12.2">F12.2</option>
                                    <option value="F14.2">F14.2</option>
                                    <option value="F17.2">F17.2</option>
                                    <option value="F19.2">F19.2</option>
                                    <option value="Outros">Outros</option>

                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7 mb-3">
                                <label for="nomedamae">Nome da Mãe</label>
                                <input type="text" class="form-control" id="nomedamae" name="nomedamae" placeholder="" value="">
                            </div>
                            <div class="col-sm-2 mb-3">
                                <label for="situacaoderua">Situação de rua</label>
                                <select type="select" class="form-control" id="situacaoderua" placeholder="" name="situacaoderua">
                                    <option value="não">Não</option>
                                    <option value="sim">Sim</option>
                                </select>
                            </div>
                            <div class="col-sm mb-3">
                                <label for="datadenascimento">Data de nascimento</label>
                                <input type="data" class="form-control mascaradata" id="datadenascimento" placeholder="" name="datanascimento">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="acompanhante">Acompanhante no momento do cadastro</label>
                                    <input type="text" class="form-control" id="acompanhante" name="acompanhante" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="responsavel">Responsável</label>
                                    <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="escolaridade">Escolaridade</label>
                                <select type="select" class="form-control mb-3" id="escolaridade" placeholder="" name="escolaridade">
                                    <option value="Não alfabetizado">Não alfabetizado</option>
                                    <option value="Fundamental incompleto">Fundamental incompleto</option>
                                    <option value="Fundamental completo">Fundamental completo</option>
                                    <option value="Médio incompleto">Médio incompleto</option>
                                    <option value="Médio completo">Médio completo</option>
                                    <option value="Médio mais tecnico">Médio mais tecnico</option>
                                    <option value="Superior">Superior</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="cns">CNS</label>
                                <div  id="respostacns"></div>
                                <input type="text" class="form-control cns" id="cns" placeholder="" name="cns">

                                <label for="telefone">Telefone convencional</label>
                                <input type="text" class="form-control telefone" id="telefone" placeholder="(00)00000-0000" name="telefone">

                            </div>
                            <div class="col-md-4 mb-3">
                                <div>
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="">
                                </div>

                                <label for="telefone2">Telefone celular</label>
                                <input type="text" class="form-control telefone" id="telefone2" placeholder="(00)00000-0000" name="telefone2">

                            </div>
                            <div class="col-md-4 mb-3">
                                <div>
                                    <label for="rg">RG</label>
                                    <input type="text" class="form-control rg" id="rg" name="rg" placeholder="">
                                </div>
                                <label for="ubsreferencia">UBS de refêrencia</label>
                                <select type="text" class="form-control" id="ubsreferencia" placeholder="" name="ubsreferencia">
                                    <option value=""></option>
                                    <option value="5ª Unidade CNES 2264234">5ª Unidade CNS 2264234</option>
                                    <option value="Belém Novo CNES 2264471">Belém Novo CNES 2264471</option>
                                    <option value="Chacara do Banco CNES 2264412">Chacara do Banco CNES 2264412</option>
                                    <option value="Chapeu do Sol CNES 7076584">Chapeu do Sol CNES 7076584</option>
                                    <option value="Clínica da Família CNES 2264404">Clínica da Família CNES 2264404</option>
                                    <option value="Lami CNES 2264560">Lami CNES 2264560</option>
                                    <option value="Macedonia CNES 2264609">Macedonia CNES 2264609</option>
                                    <option value="Modelo CNES 2264390">Modelo CNES 2264390</option>
                                    <option value="Núcleo Esperança CNES 797547">Núcleo Esperança CNES 797547</option>
                                    <option value="Paulo Viaro CNES 6676227">Paulo Viaro CNES 6676227</option>
                                    <option value="Pitinga CNES 2264749">Pitinga CNES 2264749</option>
                                    <option value="Ponta Grossa CNES 2264455">Ponta Grossa CNES 2264455</option>
                                    <option value="Restinga CNES 2264587">Restinga CNES 2264587</option>
                                    <option value="Rincão CNES 5007518">Rincão CNES 5007518</option>

                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="email">Email <span class="text-muted">(Opcional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="fulano@exemplo.com" name="email">
                                <div class="invalid-feedback">
                                    Por favor, insira um endereço de e-mail válido.
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div class="mb-3">
                                    <label for="estadocivil">Estado civil</label>
                                    <select type="text" class="form-control" id="estadocivil" name="estadocivil" placeholder="">
                                        <option value="Solteiro">Solteiro</option>
                                        <option value="Casado">Casado</option>
                                        <option value="União estável">União estável</option>
                                        <option value="Divorciado">Divorciado</option>
                                        <option value="Viúvo">Viúvo</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="nacionalidade">Nacionalidade</label>
                                    <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="naturalidade">Naturalidade</label>
                                    <input type="text" class="form-control" id="naturalidade" name="naturalidade" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="mb-3 col-md-9">
                                        <label for="cidade">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="Porto Alegre">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="uf">UF</label>
                                        <input type="text" class="form-control" id="uf" name="uf" placeholder="RS" value="RS">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="Restinga">
                                </div>
                                <div class="row">
                                    <div class="col-md-9 mb-3">
                                        <label for="endereco">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua">
                                        <select name="logradouro" id="logradouro">

                                        </select>


                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="numero">Nº</label>
                                        <input type="text" class="form-control" id="numero" name="numero" placeholder="nº ">
                                    </div>

                                </div>



                            </div>
                            <div class="col-md-6 mb-3">


                                <div class="mb-2">
                                    <label for="endereco2">Ponto de referência<span class="text-muted">(Opcional)</span></label>
                                    <textarea type="text" rows="4" class="form-control" id="endereco2" name="endereco2" placeholder=""></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="cep" placeholder="">
                                </div>

                            </div>

                            <div class="col-sm mb-3">
                            </div>
                            <div class="col-sm mb-3">
                            </div>
                            <div class="col-sm mb-3">
                            </div>
                        </div>
                        <div class="row">

                            <input type="hidden" name="tr" value="<?php echo $_SESSION['logado']; ?>">
                            <!-- <div class="col-md-2 mb-3">
                                <label for="dataentrada">Data de entrada</label>
                                <input type="data" class="form-control mascaradata" id="dataentrada" placeholder="" name="dataentrada" value="<?php echo date("dmY");; ?>">
                            </div>-->
                            <div class="col-md-2 mb-3">
                                <label for="tentativadesuicidio">Tentativa de suicídio</label>
                                <select name="tentativadesuicidio" class="form-control" id="tentativadesuicidio">
                                    <option value="não">NÃO</option>
                                    <option value="sim">SIM</option>
                                </select>
                            </div>
                            <div class="col-sm-5 mb-3">
                                <div class="mb-3">
                                    <label for="comorbidade">Comorbidade </label>
                                    <textarea type="text" rows="3" cols="30" class="form-control" id="comorbidade" name="comorbidade" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div class="mb-3">
                                    <label for="beneficio">Benefícios </label>
                                    <textarea type="text" rows="3" cols="30" class="form-control" id="beneficio" name="beneficio" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <div class="mb-3">
                                    <label for="grupos">Grupos </label>
                                    <textarea type="text" rows="3" cols="30" class="form-control" id="grupos" name="grupos" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="rede">Rede de apoio</label>
                                    <textarea type="text" class="form-control" id="rede" rows="3" cols="30" value="" name="rede" placeholder=""></textarea>
                                </div>
                                <div>
                                    <!--  <label for="atenddodia">Atendente do dia ?</label>
                                    <input type="text" class="form-control" id="atenddodia" name="atenddodia" placeholder="">
-->
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div>
                                    <label for="vd">Visita Domiciliar </label>
                                    <textarea type="text" rows="3" cols="32" class="form-control" id="vd" name="vd" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="encaminhamentoporvia">Encaminhamento por via</label>
                                    <select type="text" class="form-control" id="encaminhamentoporvia" name="encaminhamentoporvia" placeholder="">
                                        <option value=""></option>
                                        <option value="Atenção básica">Atenção básica</option>
                                        <option value="Emergência">Emergência</option>
                                        <option value="Hospital geral">Hospital geral</option>
                                        <option value="Hospital psiquiátrico">Hospital psiquiátrico</option>
                                        <option value="Outro caps">Outro caps</option>
                                        <option value="Assistência social">Assistência social</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="demandaespontanea">Demanda espontânea</label>
                                    <select type="text" class="form-control" id="demandaespontanea" name="demandaespontanea" placeholder="">
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- teste-->

                        <div class="row mb-5">
                            <div class="col-md"></div>
                            <div class="col-md-4">

                                <label for="especialidade">Atendimento a ser realizado</label>
                                <select type="select" onchange="AddInput()" class="form-control" id="especialidade" name="especialidade[]" placeholder="" value="">
                                    <option value=""></option>
                                    <option  value="Acolhimento inicial">Acolhimento inicial</option>
                                    <option  value="Atendimento psiquiátrico">Atendimento psiquiátrico</option>
                                    <option  value="Atendimento clínico">Atendimento clínico</option>
                                    <option  value="Assistente social">Assistente social</option>
                                    <option  value="Atendimento psicológico">Atendimento psicológico</option>
                                    <option  value="assistência social">Assistencia social</option>
                                    <option  value="Enfermagem">Enfermagem</option>
                                    <option  value="Terapeuta ocupacional">Terapeuta ocupacional</option>
                                    <option  value="Educador físico ">Educador físico </option>
                                    <option  value="permanência noturna">permanência noturna</option>
                                    <option  value="Oficineiro">Oficineiro</option>
                                </select>
                                <div id="marcadorespecialidade"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="nomecolaborador">Atendente disponível</label>
                                <select type="select" class="form-control " id="nomecolaborador" name="nomecolaborador[]" placeholder="" value="">
                                    <option value=""></option>
                                    <?php
                                    $result_usuarios2 = "SELECT nomecolaborador FROM `colaboradores` where funcaocolaborador like 'Colaborador'";
                                    //var_dump($result_usuarios);		echo "<br>" ;
                                    $resultado_usuarios2 = mysqli_query($conn, $result_usuarios2);
                                    while ($row_usuario2 = mysqli_fetch_assoc($resultado_usuarios2)) {
                                        //var_dump($result_usuarios2);
                                        echo  '<option value=' . $row_usuario2['nomecolaborador'] . '>' . $row_usuario2['nomecolaborador'] . '</option>';
                                        //var_dump($row_usuario);
                                    }

                                    ?>


                                </select>
                                <div id="marcadoratendente"></div>

                            </div>
                            <div class="col-md"></div>
                        </div>
                        <label for="relatorioimediato">Deseja relatório</label>
                        <select name="relatorioimediato" id="relatorioimediato" required="">
                             <option value=""></option>                     
                            <option value="SIM">SIM</option>
                            <option value="NÃO">NÃO</option>

                        </select>
 <div class="invalid-feedback">
                                    É obrigatório selecionar sim ou não.
                                </div>
                        <div class="row">
                            <div class="col-sm">

                            </div>
                            <div class="col-2-sm">

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
                            </div>
                            <div class="col-sm">

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