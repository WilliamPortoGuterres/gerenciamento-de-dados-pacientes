<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="shortcut icon" href="/imagens/ibsaudeico.ico" >
<link rel="stylesheet" href="/css/mycss.css">


    <title>logar</title>
</head>
<body>
<div class="container">
  <?php
        include("templates/nvbar.php");
        ?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
<br><br><br>
<form action="controler/verificalogin.php" method="post">
        <div class="text-center ">
           <!-- <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
            <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
            <label for="nick" class="sr-only">Nick </label>
            <input type="text" name="nick" id="nick" class="form-control" placeholder="Seu Nick " required="" autofocus="">
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required="">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </div>
</form>
<br><br>
    </div>
    <div class="col-sm-4"></div>
</div>
  <?php
        include("templates/footer.php");
        ?>

</div>

<?php
include("script/script.php")
?>
</body>
</html>
