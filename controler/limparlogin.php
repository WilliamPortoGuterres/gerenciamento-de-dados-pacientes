<?php 
if(!isset($_SESSION)){
session_start();
unset($_SESSION["logado"]);
unset($_SESSION["funcaocolaborador"]);


header("location:../index.php");die;

}
?>