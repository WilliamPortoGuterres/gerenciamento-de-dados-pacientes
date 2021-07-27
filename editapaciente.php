<?php
session_start();
include("controler/loginobrigatorio.php");
include("controler/conecta.php");
$identificadordeedicao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_usuarios = "SELECT * FROM `paciente` WHERE `paciente_id`like'$identificadordeedicao' ";
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
if ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
    //var_dump($row_usuario);
}
$result_usuarios2 = "SELECT distinct`datapresenca` FROM `presenca` WHERE `paciente_id`like'$identificadordeedicao' ";
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios2 = mysqli_query($conn, $result_usuarios2);
//while comentado poi so funciona uma vez
/*while ($row_usuario2 = mysqli_fetch_assoc($resultado_usuarios2)) {
//var_dump($row_usuario2);
echo"$row_usuario2[datapresenca]"."<BR>";
}*/
$result_usuarios3 = "SELECT COUNT(distinct`datapresenca`) FROM `presenca` WHERE `paciente_id`like'$identificadordeedicao' ";
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios3 = mysqli_query($conn, $result_usuarios3);
if ($row_usuario3 = mysqli_fetch_assoc($resultado_usuarios3)) {
    //var_dump($row_usuario3);
 // echo $row_usuario3["COUNT(distinct`datapresenca`)"];
}
//echo $result_usuarios2;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <link rel="stylesheet" href="/css/mycss.css">
 <title>Editor de pacientes</title>
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
                        <h4 class="btn btn-success">O paciente foi atualizado </h4></div><div class="col-sm-4"></div>';
                } else {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-danger">Não houve atualização no cadastro do paciente </h4></div><div class="col-sm-4"></div>';
                };
                unset($_SESSION["flag"]);
            }
            ?>



            <div class="py-5 text-center">
                <!--<img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
                <h2>Formulário de atualização de paciente</h2>
                <!--<p class="lead">Abaixo temos um exemplo de formulário construído com controles de formulário Bootstrap. Cada campo obrigatório possui um estado de validação que é ativado quando tenta-se enviar o formulário sem completá-lo.</p>-->
            </div>

            <div class="row">

                <div class="col-md order-md-1">

                    <form action="controler/atualizapaciente.php" method="post">
                        <!--inicio do registro de paciente-->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <label for="dataderegistro">Data de entrada</label>
                                <input type="data" name="dataderegistro" class="form-control mascaradata" id="dataderegistro" value="<?php echo implode("/", array_reverse(explode("-", $row_usuario['dataderegistro'])))  ?>" placeholder="" >

                            </div>

                            <div class="col-md-3">
                                <div>
                                    <label for="atendimentotr">TR</label>
                                    <select type="select" class="form-control" id="atendimentotr" value="<?php echo $row_usuario['atendimentotr']; ?>" name="atendimentotr" placeholder="">
                                        <option value=""></option>
                                        <?php
                                        // var_dump($result_usuarios);		echo "<br>" ;
                                        $result_usuarios4 = "SELECT nomecolaborador,id_colaboradores FROM `colaboradores` where atendimentotr like 'tr'";
                                        $resultado_usuarios4 = mysqli_query($conn, $result_usuarios4);
                                        while ($row_usuario4 = mysqli_fetch_assoc($resultado_usuarios4)) {
                                            //var_dump($result_usuarios2);
                                            if ($row_usuario4['id_colaboradores'] == $row_usuario['atendimentotr']) {
                                                $key = 'selected';
                                            } else {
                                                $key = '';
                                            };
                                            echo  '<option value="' . $row_usuario4["id_colaboradores"] . '" ' . $key . ' >' . $row_usuario4['nomecolaborador'] . '</option>';
                                            //var_dump($row_usuario);
                                        }

                                        ?>
                                    </select>
                                    <?php
                                    //var_dump($row_usuario4['nomecolaborador']);
                                    //var_dump($row_usuario['atendimentotr']);

                                    ?>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div>
                                    <label for="ativoinativo">Atividade</label>
                                    <input type="text" class="form-control" id="ativoinativo" name="ativoinativo" value="<?php echo $row_usuario['ativoinativo']; ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div>
                                    <label for="numeroprontuario">N° do prontuário</label>
                                    <input type="text" class="form-control" id="numeroprontuario" name="numeroprontuario" value="<?php echo $row_usuario['numeroprontuario']; ?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <input type="hidden" name="paciente_id" value="<?php echo $row_usuario['paciente_id']; ?>">
                                <label for="nome">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="" value="<?php echo $row_usuario['nome']; ?>" required="">
                                <div class="invalid-feedback">
                                    É obrigatório inserir um nome válido.
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">


                                <label for="sexo">Sexo</label>
                                <select type="select" class="form-control" id="sexo" name="sexo" placeholder="" value="<?php echo $row_usuario['sexo']; ?>">
                                    <option value="masculino" <?= ($row_usuario['sexo'] == 'masculino') ? 'selected' : '' ?>>Masculino</option>
                                    <option value="feminino" <?= ($row_usuario['sexo'] == 'feminino') ? 'selected' : '' ?>>Feminino</option>
                                    <option value="trans" <?= ($row_usuario['sexo'] == 'trans') ? 'selected' : '' ?>>Trans</option>


                                </select>


                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cid">CID</label>
                                <select type="select" class="form-control" name="cid" id="cid" value="<?php echo $row_usuario['cid']; ?>">
                                    <option value="" <?= ($row_usuario['demandaespontanea'] == '') ? 'selected' : '' ?>></option>
                                    <option value="F10.2" <?= ($row_usuario['cid'] == 'F10.2') ? 'selected' : '' ?>>F10.2</option>
                                    <option value="F12.2" <?= ($row_usuario['cid'] == 'F12.2') ? 'selected' : '' ?>>F12.2</option>
                                    <option value="F14.2" <?= ($row_usuario['cid'] == 'F14.2') ? 'selected' : '' ?>>F14.2</option>
                                    <option value="F17.2" <?= ($row_usuario['cid'] == 'F17.2') ? 'selected' : '' ?>>F17.2</option>
                                    <option value="F19.2" <?= ($row_usuario['cid'] == 'F19.2') ? 'selected' : '' ?>>F19.2</option>
                                    <option value="Outros" <?= ($row_usuario['cid'] == 'Outros') ? 'selected' : '' ?>>Outros</option>

                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7 mb-3">
                                <label for="nomedamae">Nome da Mãe</label>
                                <input type="text" class="form-control" id="nomedamae" name="nomedamae" placeholder="" value="<?php echo $row_usuario['nomedamae']; ?>">
                            </div>
                            <div class="col-sm-2 mb-3">
                                <label for="situacaoderua">Situação de rua</label>
                                <select type="select" class="form-control" id="situacaoderua" placeholder="" name="situacaoderua" value="<?php echo $row_usuario['situacaoderua']; ?>">
                                    <option value="não" <?= ($row_usuario['situacaoderua'] == 'não') ? 'selected' : '' ?>>Não</option>
                                    <option value="sim" <?= ($row_usuario['situacaoderua'] == 'sim') ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                            <div class="col-sm mb-3">
                                <label for="datadenascimento">Data de nascimento</label>
                                <input type="data" class="form-control mascaradata" id="datadenascimento" placeholder="" value="<?php echo implode("/", array_reverse(explode("-", $row_usuario['datadenascimento'])))  ?>" name="datanascimento">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="acompanhante">Acompanhante no momento do cadastro</label>
                                    <input type="text" class="form-control" id="acompanhante" name="acompanhante" value="<?php echo $row_usuario['acompanhante']; ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="responsavel">Responsável</label>
                                    <input type="text" class="form-control" id="responsavel" name="responsavel" value="<?php echo $row_usuario['responsavel']; ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="escolaridade">Escolaridade</label>
                                <select type="select" class="form-control mb-3" id="escolaridade" placeholder="" name="escolaridade" value="<?php echo $row_usuario['escolaridade']; ?>">
                                    <option value="Não alfabetizado" <?= ($row_usuario['escolaridade'] == 'Não alfabetizado') ? 'selected' : '' ?>>Não alfabetizado</option>
                                    <option value="Fundamental incompleto" <?= ($row_usuario['escolaridade'] == 'Fundamental incompleto') ? 'selected' : '' ?>>Fundamental incompleto</option>
                                    <option value="Fundamental completo" <?= ($row_usuario['escolaridade'] == 'Fundamental completo') ? 'selected' : '' ?>>Fundamental completo</option>
                                    <option value="Médio incompleto" <?= ($row_usuario['escolaridade'] == 'Médio incompleto') ? 'selected' : '' ?>>Médio incompleto</option>
                                    <option value="Médio completo" <?= ($row_usuario['escolaridade'] == 'Médio completo') ? 'selected' : '' ?>>Médio completo</option>
                                    <option value="Médio mais tecnico<?= ($row_usuario['escolaridade'] == 'Médio mais tecnico') ? 'selected' : '' ?>">Médio mais tecnico</option>
                                    <option value="Superior" <?= ($row_usuario['escolaridade'] == 'Superior') ? 'selected' : '' ?>>Superior</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="cns">CNS</label>
                                <input type="text" class="form-control cns" id="cns" placeholder="" value="<?php echo $row_usuario['cns']; ?>" name="cns">

                                <label for="telefone">Telefone convencional</label>
                                <input type="text" class="form-control telefone" id="telefone" placeholder="(00)00000-0000" value="<?php echo $row_usuario['telefone']; ?>" name="telefone">

                            </div>
                            <div class="col-md-4 mb-3">
                                <div>
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo $row_usuario['cpf']; ?>" placeholder="">
                                </div>

                                <label for="telefone2">Telefone celular</label>
                                <input type="text" class="form-control telefone" id="telefone2" value="<?php echo $row_usuario['telefone2']; ?>" placeholder="(00)00000-0000" name="telefone2">

                            </div>
                            <div class="col-md-4 mb-3">
                                <div>
                                    <label for="rg">RG</label>
                                    <input type="text" class="form-control rg" id="rg" value="<?php echo $row_usuario['rg']; ?>" name="rg" placeholder="">
                                </div>
                                <label for="ubsreferencia">UBS de refêrencia</label>
                                <select type="text" class="form-control" id="ubsreferencia" placeholder="" name="ubsreferencia" value="<?php echo $row_usuario['ubsreferencia']; ?>">
                                    <option value=""></option>
                                    <option value=" 5ª Unidade CNES 2264234"<?= ($row_usuario['ubsreferencia'] == '5ª Unidade CNES 2264234') ? 'selected' : '' ?>>5ª Unidade CNS 2264234</option>
                                    <option value="Belém Novo CNES 2264471" <?= ($row_usuario['ubsreferencia'] == 'Belém Novo CNES 2264471') ? 'selected' : '' ?>>Belém Novo CNES 2264471</option>
                                    <option value="Chacara do Banco CNES 2264412" <?= ($row_usuario['ubsreferencia'] == 'Chacara do Banco CNES 2264412') ? 'selected' : '' ?>>Chacara do Banco CNES 2264412</option>
                                    <option value="Chapeu do Sol CNES 7076584" <?= ($row_usuario['ubsreferencia'] == 'Chapeu do Sol CNES 7076584') ? 'selected' : '' ?>>Chapeu do Sol CNES 7076584</option>
                                    <option value="Clínica da Família CNES 2264404" <?= ($row_usuario['ubsreferencia'] == 'Clínica da Família CNES 2264404') ? 'selected' : '' ?>>Clínica da Família CNES 2264404</option>
                                    <option value="Lami CNES 2264560" <?= ($row_usuario['ubsreferencia'] == 'Lami CNES 2264560') ? 'selected' : '' ?>>Lami CNES 2264560</option>
                                    <option value="Macedonia CNES 2264609" <?= ($row_usuario['ubsreferencia'] == 'Macedonia CNES 2264609') ? 'selected' : '' ?>>Macedonia CNES 2264609</option>
                                    <option value="Modelo CNES 2264390" <?= ($row_usuario['ubsreferencia'] == 'Modelo CNES 2264390') ? 'selected' : '' ?>>Modelo CNES 2264390</option>
                                    <option value="Núcleo Esperança CNES 797547" <?= ($row_usuario['ubsreferencia'] == 'Núcleo Esperança CNES 797547') ? 'selected' : '' ?>>Núcleo Esperança CNES 797547</option>
                                    <option value="Paulo Viaro CNES 6676227" <?= ($row_usuario['ubsreferencia'] == 'Paulo Viaro CNES 6676227') ? 'selected' : '' ?>>Paulo Viaro CNES 6676227</option>
                                    <option value="Pitinga CNES 2264749" <?= ($row_usuario['ubsreferencia'] == 'Pitinga CNES 2264749') ? 'selected' : '' ?>>Pitinga CNES 2264749</option>
                                    <option value="Ponta Grossa CNES 2264455" <?= ($row_usuario['ubsreferencia'] == 'Ponta Grossa CNES 2264455') ? 'selected' : '' ?>>Ponta Grossa CNES 2264455</option>
                                    <option value="Restinga CNES 2264587" <?= ($row_usuario['ubsreferencia'] == 'Restinga CNES 2264587') ? 'selected' : '' ?>>Restinga CNES 2264587</option>
                                    <option value="Rincão CNES 5007518" <?= ($row_usuario['ubsreferencia'] == 'Rincão CNES 5007518') ? 'selected' : '' ?>>Rincão CNES 5007518</option>

                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="email">Email <span class="text-muted">(Opcional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="fulano@exemplo.com" value="<?php echo $row_usuario['email']; ?>" name="email">
                                <div class="invalid-feedback">
                                    Por favor, insira um endereço de e-mail válido.
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div class="mb-3">
                                    <label for="estadocivil">Estado civil</label>
                                    <select type="text" class="form-control" id="estadocivil" name="estadocivil" value="<?php echo $row_usuario['estadocivil']; ?> placeholder="">
                                        <option value=" Solteiro"<?= ($row_usuario['estadocivil'] == 'Solteiro') ? 'selected' : '' ?>>Solteiro</option>
                                        <option value="Casado" <?= ($row_usuario['estadocivil'] == 'Casado') ? 'selected' : '' ?>>Casado</option>
                                        <option value="União estável" <?= ($row_usuario['estadocivil'] == 'União estável') ? 'selected' : '' ?>>União estável</option>
                                        <option value="Divorciado" <?= ($row_usuario['estadocivil'] == 'Divorciado') ? 'selected' : '' ?>>Divorciado</option>
                                        <option value="Viúvo" <?= ($row_usuario['estadocivil'] == 'Viúvo') ? 'selected' : '' ?>>Viúvo</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="nacionalidade">Nacionalidade</label>
                                    <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" value="<?php echo $row_usuario['nacionalidade']; ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="naturalidade">Naturalidade</label>
                                    <input type="text" class="form-control" id="naturalidade" name="naturalidade" value="<?php echo $row_usuario['naturalidade']; ?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $row_usuario['endereco']; ?>" placeholder="Rua , nº 0">
                                </div>
                                <div class="mb-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $row_usuario['bairro']; ?>" placeholder="Bairro">
                                </div>
                                <div class="mb-3">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row_usuario['cidade']; ?>" placeholder="Cidade">
                                </div>



                            </div>
                            <div class="col-md-6 mb-3">


                                <div class="mb-3">
                                    <label for="endereco2">Ponto de referência<span class="text-muted">(Opcional)</span></label>
                                    <textarea type="text" rows="4" class="form-control" id="endereco2" name="endereco2" placeholder=""><?php echo $row_usuario['endereco2']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="cep" value="<?php echo $row_usuario['cep']; ?>" placeholder="">
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
                                <select name="tentativadesuicidio" class="form-control" value="<?php echo $row_usuario['tentativasuicidio']; ?>" id="tentativadesuicidio">
                                    <option value="não" <?= ($row_usuario['tentativadesuicidio'] == 'não') ? 'selected' : '' ?>>NÃO</option>
                                    <option value="sim" <?= ($row_usuario['tentativadesuicidio'] == 'sim') ? 'selected' : '' ?>>SIM</option>
                                </select>
                                <label for="quantidadepresenca">Dias de presença</label>
                                <input type="text" readonly name="quantidadepresenca" class="form-control" id="quantidadepresenca" value="<?php echo $row_usuario3["COUNT(distinct`datapresenca`)"]; ?>">
                                <label for="presenca">Presente na data</label>
                                <textarea name="presenca" readonly class="form-control" id="presenca" cols="13" rows="2"><?PHP while ($row_usuario2 = mysqli_fetch_assoc($resultado_usuarios2)) {
                                                                                                                                //var_dump($row_usuario2);
                                                                                                                                echo implode("/", array_reverse(explode("-", $row_usuario2['datapresenca'])));
                                                                                                                                // echo "$row_usuario2[datapresenca]";
                                                                                                                                echo "\n";
                                                                                                                            } ?></textarea>

                            </div>
                            <div class="col-sm-5 mb-3">
                                <div class="mb-3">
                                    <label for="comorbidade">Comorbidade </label>
                                    <textarea type="text" rows="5" cols="30" class="form-control" id="comorbidade" name="comorbidade" value="" placeholder=""><?php echo $row_usuario['comorbidade']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div class="mb-3">
                                    <label for="beneficio">Benefícios </label>
                                    <textarea type="text" rows="5" cols="30" class="form-control" id="beneficio" value="" name="beneficio" placeholder=""><?php echo $row_usuario['beneficio']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <div class="mb-3">
                                    <label for="grupos">Grupos </label>
                                    <textarea type="text" rows="3" cols="30" class="form-control" id="grupos" value="" name="grupos" placeholder=""><?php echo $row_usuario['grupos']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="rede">Rede de apoio</label>
                                    <textarea type="text" class="form-control" id="rede" rows="3" cols="30" value="" name="rede" placeholder=""><?php echo $row_usuario['rede']; ?></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div>
                                    <label for="vd">Visita Domiciliar </label>
                                    <textarea type="text" rows="3" cols="32" class="form-control" id="vd" value="" name="vd" placeholder=""><?php echo $row_usuario['vd']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <div>
                                    <label for="encaminhamentoporvia">Encaminhamento por via</label>
                                    <select type="text" class="form-control" id="encaminhamentoporvia" name="encaminhamentoporvia" placeholder="" value="<?php echo $row_usuario['encaminhadoporvia']; ?>">
                                        <option value=""></option>
                                        <option value="Atenção básica" <?= ($row_usuario['encaminhamentoporvia'] == 'Atenção básica') ? 'selected' : '' ?>>Atenção básica</option>
                                        <option value="Emergência" <?= ($row_usuario['encaminhamentoporvia'] == 'Emergência') ? 'selected' : '' ?>>Emergência</option>
                                        <option value="Hospital geral" <?= ($row_usuario['encaminhamentoporvia'] == 'Hospital geral') ? 'selected' : '' ?>>Hospital geral</option>
                                        <option value="Holpital psquiátrico" <?= ($row_usuario['encaminhamentoporvia'] == 'Holpital psquiátrico') ? 'selected' : '' ?>>Holpital psquiátrico</option>
                                        <option value="Outro caps" <?= ($row_usuario['encaminhamentoporvia'] == 'Outro caps') ? 'selected' : '' ?>>Outro caps</option>
                                        <option value="Assistencia social" <?= ($row_usuario['encaminhamentoporvia'] == 'Assistencia social') ? 'selected' : '' ?>>Assistencia social</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="demandaespontanea">Demanda espontânea</label>
                                    <select type="text" class="form-control" id="demandaespontanea" name="demandaespontanea" placeholder="" value="<?php echo $row_usuario['demandaespontanea']; ?>">
                                        <option value="Sim" <?= ($row_usuario['demandaespontanea'] == 'Sim') ? 'selected' : '' ?>>Sim</option>
                                        <option value="Não" <?= ($row_usuario['demandaespontanea'] == 'Não') ? 'selected' : '' ?>>Não</option>

                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm">

                            </div>
                            <div class="col-2-sm">

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Atualiza</button>
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