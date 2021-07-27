<?php
date_default_timezone_set('America/Sao_Paulo');
include("conecta.php");
$datapresenca = date("Y-m-d");
//var_dump($_GET);
//var_dump($ultimpresenca);
var_dump($_POST);
echo '<br><br><br><br>';
$id = $_POST['id'];
$especialidade = $_POST['especialidade'];
$nomecolaborador = $_POST['nomecolaborador'];
//$id=$_GET['id'];                                          
//$paciente= "UPDATE  paciente set `ultimapresenca`='$ultimpresenca' where `paciente_id`like'$id'  ";
$paciente = " INSERT INTO `presenca`( `datapresenca`, `paciente_id`) VALUES ('$datapresenca','$id')  ";
$resultado_usuario = mysqli_query($conn, $paciente);
if (mysqli_insert_id($conn)) {
    $_SESSION["flag2"] = "sucesso";
} else {
    $_SESSION["flag2"] = "falha";
};
var_dump($paciente);
var_dump($_SESSION["flag2"]);
var_dump($resultado_usuario);
echo "<br>";
$paciente2 = "UPDATE  `paciente` set `ultimapresenca`='$datapresenca',`ativoinativo`='Ativo' where `paciente_id`like'$id'   ";
$resultado_usuario2 = mysqli_query($conn, $paciente2);
if (mysqli_affected_rows($conn)) {
    $_SESSION["flag"] = "sucesso";
} else {
    $_SESSION["flag"] = "falha";
};

var_dump($paciente2);
var_dump($_SESSION["flag"]);
var_dump($resultado_usuario2);

echo "<br>";




foreach ($_POST['especialidade'] as $index=>$value ) {

   if($especialidade[$index]=='' ||  $nomecolaborador[$index]==''){
   }else{

        $paciente3 = " INSERT INTO `servicos`( `dataservico`, `paciente_id`,`servico`,`nomecolaborador`) VALUES ('$datapresenca','$id','$especialidade[$index]','$nomecolaborador[$index]')  ";
        $resultado_usuario3 = mysqli_query($conn, $paciente3);
        if (mysqli_insert_id($conn)) {
            $_SESSION["flag3"] = "sucesso";
        } else {
            $_SESSION["flag3"] = "falha";
        };



}

}









header("location:../atendimento.php?id='.$id.'");die;
