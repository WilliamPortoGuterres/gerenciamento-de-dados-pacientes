<?php
session_start();
include("conecta.php");
$nick = filter_input(INPUT_POST,'nick',FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);

//var_dump($_POST);

	
		$result_usuarios = "SELECT `nickcolaborador`,`funcaocolaborador` FROM `colaboradores` WHERE `nickcolaborador`='$nick' AND `senhacolaborador`='$senha'" ;
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);
$resultado_usuarios= mysqli_fetch_assoc($resultado_usuarios);
echo $result_usuarios; 
//var_dump($resultado_usuarios);

       $_SESSION["logado"]=$resultado_usuarios["nickcolaborador"]; 
       $_SESSION["funcaocolaborador"]=$resultado_usuarios["funcaocolaborador"]; 
var_dump($_SESSION);
$nick=null;
$senha=null;
header("location:../index.php");die;


?>