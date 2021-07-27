<?php
session_start();

include_once("conecta.php");
$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
$nomedamae = filter_input(INPUT_POST,'nomedamae',FILTER_SANITIZE_STRING);
$sexo = filter_input(INPUT_POST,'sexo',FILTER_SANITIZE_STRING);
$situacaoderua = filter_input(INPUT_POST,'situacaoderua',FILTER_SANITIZE_STRING);
$datadenascimento = $_POST["datanascimento"];
$dataderegistro = $_POST["dataderegistro"];
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
$numero=filter_input(INPUT_POST,'numero',FILTER_SANITIZE_STRING);
$relatorios=$_POST['relatorioimediato'];


//var_dump($datadenascimento);echo "<br>";
$datadenascimento = implode("-",array_reverse(explode("/",$datadenascimento)));
$dataderegistro = implode("-",array_reverse(explode("/",$dataderegistro)));
//formato acima resolveu o problema de data do MySQL
// $datadenascimento= date('y/m/d', strtotime($datadenascimento));
//var_dump($datadenascimento);echo"<br>";


$paciente= "INSERT INTO paciente (nome,nomedamae,sexo,situacaoderua,datadenascimento,cns,email,telefone,telefone2,escolaridade,cid,tentativadesuicidio,endereco,endereco2,tr,comorbidade,grupos,beneficio,numeroprontuario,acompanhante,responsavel,cpf,rg,ubsreferencia,estadocivil,nacionalidade,naturalidade,bairro,cidade,cep,atendimentotr,vd,encaminhamentoporvia,demandaespontanea,rede,ativoinativo,dataderegistro) 
VALUES ('$nome','$nomedamae','$sexo','$situacaoderua','$datadenascimento','$cns','$email','$telefone','$telefone2','$escolaridade','$cid','$tentativadesuicidio','$endereco    n° $numero','$endereco2','$tr','$comorbidade','$grupos','$beneficio','$numeroprontuario','$acompanhante','$responsavel','$cpf','$rg','$ubsreferencia','$estadocivil','$nacionalidade','$naturalidade','$bairro','$cidade','$cep','$atendimentotr','$vd','$encaminhamentoporvia','$demandaespontanea','$rede','Ativo','$dataderegistro')";

$resultado_usuario= mysqli_query($conn,$paciente);
if(mysqli_insert_id($conn)){
	$_SESSION["flag"] = "sucesso";
}else{
	$_SESSION["flag"] = "falha";
};

$atender="SELECT `paciente_id` FROM `paciente` WHERE `nome`like '$nome'ORDER BY `paciente`.`paciente_id` DESC LIMIT 1";
$id_usuario_presenca= mysqli_query($conn,$atender);
if ($row_usuario2 = mysqli_fetch_row ($id_usuario_presenca)){

$id_usuario_presenca=$row_usuario2;
}


$especialidade = $_POST['especialidade'];
$nomecolaborador = $_POST['nomecolaborador'];

//var_dump( $id_usuario_presenca);
//var_dump($especialidade);
//var_dump($nomecolaborador);
if(count($especialidade)>1&&count($nomecolaborador)>1){

foreach ($_POST['especialidade'] as $index=>$value ) {

   if($especialidade[$index]!='' &&  $nomecolaborador[$index]!=''){
   

        $paciente3 = " INSERT INTO `servicos`( `dataservico`, `paciente_id`,`servico`,`nomecolaborador`) VALUES ('$dataderegistro','$id_usuario_presenca[0]','$especialidade[$index]','$nomecolaborador[$index]')  ";
        $resultado_usuario3 = mysqli_query($conn, $paciente3);
        if (mysqli_insert_id($conn)) {
            $_SESSION["flag3"] = "sucesso";
        } else {
            $_SESSION["flag3"] = "falha";
        };
    }else{}
}
$paciente = " INSERT INTO `presenca`( `datapresenca`, `paciente_id`) VALUES ('$dataderegistro','$id_usuario_presenca[0]')  ";
$resultado_usuario = mysqli_query($conn, $paciente);
if (mysqli_insert_id($conn)) {
    $_SESSION["flag2"] = "sucesso";
} else {
    $_SESSION["flag2"] = "falha";
};

}
if($relatorios=='SIM'){
header("location:../relatorios/gerapdf4.php?id=$id_usuario_presenca[0]");
}else{
header("location:../cadastro.php");die;
}

//var_dump($_POST);
//var_dump($paciente);
//var_dump($paciente3);
?>