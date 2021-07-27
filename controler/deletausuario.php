<?php
session_start();
include('conecta.php');
$id=$_POST['id_colaboradores'];

var_dump($id);
$colaborador= "DELETE  FROM `colaboradores` WHERE `id_colaboradores`='$id' and `funcaocolaborador`!='administrador'  "   ;
$resultado_usuario= mysqli_query($conn,$colaborador);
if(mysqli_affected_rows($conn)>0){
	$_SESSION["flag"] = "sucesso";
}else{
	$_SESSION["flag"] = "falha";
};

//var_dump($colaborador);
var_dump($_SESSION["flag"]);


header("location:../listarcolaborador.php");die;






?>