<?php
session_start();
include_once("conecta.php");
$nomecolaborador = filter_input(INPUT_POST,'nomecolaborador',FILTER_SANITIZE_STRING);
$senhacolaborador = filter_input(INPUT_POST,'senhacolaborador',FILTER_SANITIZE_STRING);
$emailcolaborador = filter_input(INPUT_POST,'emailcolaborador',FILTER_SANITIZE_EMAIL);
$telefonecolaborador = filter_input(INPUT_POST,'telefonecolaborador',FILTER_SANITIZE_STRING);
$enderecocolaborador = filter_input(INPUT_POST,'enderecocolaborador',FILTER_SANITIZE_STRING);
$nickcolaborador = filter_input(INPUT_POST,'tr',FILTER_SANITIZE_STRING);
$funcaocolaborador = filter_input(INPUT_POST,'funcaocolaborador',FILTER_SANITIZE_STRING);
$cns = filter_input(INPUT_POST,'cns',FILTER_SANITIZE_STRING);
$cbo = filter_input(INPUT_POST,'cbo',FILTER_SANITIZE_STRING);
$atendimentotr = filter_input(INPUT_POST,'atendimentotr',FILTER_SANITIZE_STRING);



var_dump($_POST);echo "<br>";
//var_dump($sexo);echo"<br>";


$colaboradores= "INSERT INTO colaboradores (nomecolaborador,emailcolaborador,telefonecolaborador,enderecocolaborador,nickcolaborador,senhacolaborador,funcaocolaborador,cns,cbo,atendimentotr)
 VALUES ('$nomecolaborador','$emailcolaborador','$telefonecolaborador','$enderecocolaborador','$nickcolaborador','$senhacolaborador','$funcaocolaborador','$cns','$cbo','$atendimentotr')";
$resultado_usuario= mysqli_query($conn,$colaboradores);
if(mysqli_insert_id($conn)){
	$_SESSION["flag"] = "sucesso";
}else{
	$_SESSION["flag"] = "falha";
};
header("location:../cadastrodecolaboradores.php");die;

echo $colaboradores ;

?>