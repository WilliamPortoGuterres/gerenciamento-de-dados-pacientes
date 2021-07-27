<?php

include("conecta.php");
$emailcolaborador = filter_input(INPUT_POST,'emailcolaborador',FILTER_SANITIZE_STRING);



	
		$result_usuarios = "SELECT  `emailcolaborador` FROM `colaboradores` WHERE `emailcolaborador`like'$emailcolaborador' " ;
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
//var_dump($resultado_usuarios);
while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   echo' 

      
      <p>O E-mail '. $row_usuario["emailcolaborador"] .' Já foi cadastrado</p>
      
'
;

			
}
			




	?>