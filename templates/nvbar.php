


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="cadastro.php">Cadastro de pacientes</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administrativo
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="cadastrodecolaboradores.php">Cadastro de colaboradores</a>
          <a class="dropdown-item" href="listarcolaborador.php">Listar colaboradores</a>
          <a class="dropdown-item" href="relatorio.php">Relatorios</a>
        </div>
      </li>
<li class="nav-item dropdown  dropdown-menu-right">
        <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php if(isset($_SESSION["logado"])){  echo "Logado como " . $_SESSION["logado"];}else{echo "Não logado";} ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         
        <a class="dropdown-item btn btn-primary" href="controler/limparlogin.php">Sair</a>
        
        </div>
      </li>
      
    </ul>
  </div>
</nav>