
<?php

include("conecta.php");

$localizador = filter_input(INPUT_POST,'localizador',FILTER_SANITIZE_STRING);
    
		$result_usuarios = "SELECT `id_colaboradores`, `nomecolaborador`,`nickcolaborador`,`emailcolaborador`,`enderecocolaborador`,`telefonecolaborador`,`funcaocolaborador` FROM `colaboradores` where `nomecolaborador`like '%$localizador%'" ;
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
//var_dump($resultado_usuarios);

while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   echo' 
<tr >
      <td ><a  name="edicao" class="btn btn-primary" href="editacolaborador.php?id='.$row_usuario["id_colaboradores"].'">editar</a></td>
      <td class="text-nowrap">'. $row_usuario["nomecolaborador"] .'</td>
      <td>'. $row_usuario["nickcolaborador"] .'</td>
      <td>'. $row_usuario["emailcolaborador"] .'</td>
      <td class="text-nowrap">'. $row_usuario["enderecocolaborador"] .'</td>
      <td>'. $row_usuario["telefonecolaborador"] .'</td>
      <td>'. $row_usuario["funcaocolaborador"] .'</td>
      
</tr>'

			
;}

 

      //<td>'. date('d/m/Y', strtotime($row_usuario['dataderegistro'])).'</td>
     // <td>'. date('d/m/Y', strtotime($row_usuario['ultimapresenca'])).'</td>
      //<td>'. date('d/m/Y', strtotime($row_usuario['datadenascimento'])).'</td>
?>


