<?php
session_start();
include_once("conecta.php");
$id=filter_input(INPUT_POST,'id_colaboradores',FILTER_SANITIZE_NUMBER_INT);
$nomecolaborador = filter_input(INPUT_POST,'nomecolaborador',FILTER_SANITIZE_STRING);
$nickcolaborador = filter_input(INPUT_POST,'tr',FILTER_SANITIZE_STRING);
$emailcolaborador = filter_input(INPUT_POST,'emailcolaborador',FILTER_SANITIZE_EMAIL);
$senhacolaborador = filter_input(INPUT_POST,'senhacolaborador',FILTER_SANITIZE_STRING);
$enderecocolaborador = filter_input(INPUT_POST,'enderecocolaborador',FILTER_SANITIZE_STRING);
$telefonecolaborador = filter_input(INPUT_POST,'telefonecolaborador',FILTER_SANITIZE_STRING);
$funcaocolaborador = filter_input(INPUT_POST,'funcaocolaborador',FILTER_SANITIZE_STRING);
$cns = filter_input(INPUT_POST,'cns',FILTER_SANITIZE_STRING);
$cbo = filter_input(INPUT_POST,'cbo',FILTER_SANITIZE_STRING);
$especialidade = filter_input(INPUT_POST,'especialidade',FILTER_SANITIZE_STRING);
$atendimentotr = filter_input(INPUT_POST,'atendimentotr',FILTER_SANITIZE_STRING);
echo $_POST["funcaocolaborador"];
var_dump($_POST);echo "<br>";
//$datadenascimento = implode("-",array_reverse(explode("/",$datadenascimento)));
//formato acima resolveu o problema de data do MySQL
// $datadenascimento= date('y/m/d', strtotime($datadenascimento));
var_dump($funcaocolaborador);echo"<br>";


                                                                           
$paciente= "UPDATE  colaboradores set `nomecolaborador`='$nomecolaborador',`nickcolaborador`='$nickcolaborador',`emailcolaborador`='$emailcolaborador',`senhacolaborador`='$senhacolaborador',
`enderecocolaborador`='$enderecocolaborador',`telefonecolaborador`='$telefonecolaborador',`funcaocolaborador`='$funcaocolaborador',`cns`='$cns',`cbo`='$cbo',`especialidade`='$especialidade',`atendimentotr`='$atendimentotr' where `id_colaboradores`like'$id'  ";
$resultado_usuario= mysqli_query($conn,$paciente);
if(mysqli_affected_rows($conn)>0){
	$_SESSION["flag"] = "sucesso";
}else{
	$_SESSION["flag"] = "falha";
};
header("location:../editacolaborador.php?id=$id");die;

var_dump($paciente);echo"<br>";

?>