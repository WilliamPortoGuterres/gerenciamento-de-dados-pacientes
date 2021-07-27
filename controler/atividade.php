<?php
include("conecta.php");

                                                                           
$paciente= "UPDATE `paciente` SET `ativoinativo`='Inativo' WHERE datediff( now(),`ultimapresenca`)>90 ";

$resultado_usuario= mysqli_query($conn,$paciente);
if(mysqli_affected_rows($conn)>0){

};




?>