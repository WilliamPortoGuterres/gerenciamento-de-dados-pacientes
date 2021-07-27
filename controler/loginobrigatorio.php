<?php

if (isset($_SESSION["logado"])){}else{
header("location:login.php");die;
}


?>