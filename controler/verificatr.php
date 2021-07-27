<?php

include("conecta.php");
$tr = filter_input(INPUT_POST,'tr',FILTER_SANITIZE_STRING);



	
//tr no BD é nickcolaborador
		$result_usuarios = "SELECT  `nickcolaborador` FROM `colaboradores` WHERE `nickcolaborador`like'$tr' " ;
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
//var_dump($resultado_usuarios);
while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   echo' 

      
      <p>O Nick '. $row_usuario["nickcolaborador"] .' Já foi cadastrado</p>
      
'
;

			
}
			




	?>