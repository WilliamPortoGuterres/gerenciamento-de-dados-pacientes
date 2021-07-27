<?php
session_start();
include_once("conecta.php");
$id=filter_input(INPUT_POST,'paciente_id',FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
$nomedamae = filter_input(INPUT_POST,'nomedamae',FILTER_SANITIZE_STRING);
$sexo = filter_input(INPUT_POST,'sexo',FILTER_SANITIZE_STRING);
$situacaoderua = filter_input(INPUT_POST,'situacaoderua',FILTER_SANITIZE_STRING);
$datadenascimento = $_POST["datanascimento"];
$cns = filter_input(INPUT_POST,'cns',FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
$telefone = filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_STRING);
$telefone2 = filter_input(INPUT_POST,'telefone2',FILTER_SANITIZE_STRING);
$escolaridade = filter_input(INPUT_POST,'escolaridade',FILTER_SANITIZE_STRING);
$cid = filter_input(INPUT_POST,'cid',FILTER_SANITIZE_STRING);
$tentativadesuicidio = filter_input(INPUT_POST,'tentativadesuicidio',FILTER_SANITIZE_STRING);
$endereco = filter_input(INPUT_POST,'endereco',FILTER_SANITIZE_STRING);
$endereco2 = filter_input(INPUT_POST,'endereco2',FILTER_SANITIZE_STRING);
$tr = filter_input(INPUT_POST,'tr',FILTER_SANITIZE_STRING);
$comorbidade =trim( filter_input(INPUT_POST,'comorbidade',FILTER_SANITIZE_STRING));
$grupos = filter_input(INPUT_POST,'grupos',FILTER_SANITIZE_STRING);
$beneficio = filter_input(INPUT_POST,'beneficio',FILTER_SANITIZE_STRING);
$rede = filter_input(INPUT_POST,'rede',FILTER_SANITIZE_STRING);
$numeroprontuario = filter_input(INPUT_POST,'numeroprontuario',FILTER_SANITIZE_STRING);
$acompanhante = filter_input(INPUT_POST,'acompanhante',FILTER_SANITIZE_STRING);
$responsavel = filter_input(INPUT_POST,'responsavel',FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST,'cpf',FILTER_SANITIZE_STRING);
$rg = filter_input(INPUT_POST,'rg',FILTER_SANITIZE_STRING);
$ubsreferencia = filter_input(INPUT_POST,'ubsreferencia',FILTER_SANITIZE_STRING);
$estadocivil = filter_input(INPUT_POST,'estadocivil',FILTER_SANITIZE_STRING);
$nacionalidade = filter_input(INPUT_POST,'nacionalidade',FILTER_SANITIZE_STRING);
$naturalidade = filter_input(INPUT_POST,'naturalidade',FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST,'bairro',FILTER_SANITIZE_STRING);
$cidade = filter_input(INPUT_POST,'cidade',FILTER_SANITIZE_STRING);
$cep = filter_input(INPUT_POST,'cep',FILTER_SANITIZE_STRING);
$atendimentotr = filter_input(INPUT_POST,'atendimentotr',FILTER_SANITIZE_STRING);
$vd = filter_input(INPUT_POST,'vd',FILTER_SANITIZE_STRING);
$encaminhamentoporvia = filter_input(INPUT_POST,'encaminhamentoporvia',FILTER_SANITIZE_STRING);
$demandaespontanea = filter_input(INPUT_POST,'demandaespontanea',FILTER_SANITIZE_STRING);
$dataderegistro = $_POST["dataderegistro"];
//var_dump($datadenascimento);echo "<br>";
$datadenascimento = implode("-",array_reverse(explode("/",$datadenascimento)));
$dataderegistro = implode("-",array_reverse(explode("/",$dataderegistro)));
//formato acima resolveu o problema de data do MySQL
// $datadenascimento= date('y/m/d', strtotime($datadenascimento));
//var_dump($_POST);echo"<br>";


                                                                           
$paciente= "UPDATE  paciente set `nome`='$nome',`nomedamae`='$nomedamae',`sexo`='$sexo',`situacaoderua`='$situacaoderua',
`datadenascimento`='$datadenascimento',`cns`='$cns',`email`='$email',`telefone`='$telefone',`telefone2`='$telefone2',
`escolaridade`='$escolaridade',`cid`='$cid',`tentativadesuicidio`='$tentativadesuicidio',`endereco`='$endereco',
`endereco2`='$endereco2',`tr`='$tr',`comorbidade`='$comorbidade',`grupos`='$grupos',`beneficio`='$beneficio',`numeroprontuario`='$numeroprontuario'
,`acompanhante`='$acompanhante',`responsavel`='$responsavel',`cpf`='$cpf',`rg`='$rg',`ubsreferencia`='$ubsreferencia',`estadocivil`='$estadocivil',
`nacionalidade`='$nacionalidade',`naturalidade`='$naturalidade',`bairro`='$bairro',`cidade`='$cidade',`cep`='$cep',`atendimentotr`='$atendimentotr',`vd`='$vd',
`encaminhamentoporvia`='$encaminhamentoporvia',`demandaespontanea`='$demandaespontanea',`rede`='$rede',`dataderegistro`='$dataderegistro' where `paciente_id`like'$id'  ";

$resultado_usuario= mysqli_query($conn,$paciente);
if(mysqli_affected_rows($conn)>0){
	$_SESSION["flag"] = "sucesso";
}else{
	$_SESSION["flag"] = "falha";
};
header("location:../editapaciente.php?id=$id");die;
echo $paciente;
//var_dump($paciente);echo"<br>";

?>