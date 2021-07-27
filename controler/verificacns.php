<?php

include("conecta.php");
$cns = filter_input(INPUT_POST,'cns',FILTER_SANITIZE_STRING);



	

		$result_usuarios = "SELECT  `cns` FROM `paciente` WHERE `cns`like'$cns' " ;
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
//var_dump($resultado_usuarios);
while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   echo' 

      
      <p class="btn btn-danger">O CNS '. $row_usuario["cns"] .' Já foi cadastrado</p>
      
'
;

			
}
			




	?>