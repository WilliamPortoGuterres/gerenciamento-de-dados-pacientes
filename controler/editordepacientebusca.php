<?php

include("conecta.php");
$identificadordeedicao = filter_input(INPUT_GET, 'identificadordeedicao', FILTER_SANITIZE_NUMBER_INT);



	
		$result_usuarios = "SELECT  `nome`, `sexo`, `situacaoderua`, `datadenascimento`, `cns`, `email`, `telefone`, `telefone2`, `escolaridade`, `cid`, `tentativadesuicidio`, `nomedamae`, `endereco`, `endereco2`, `dataderegistro`, `tr` FROM `paciente` WHERE `paciente_id`like'$identificadordeedicao' " ;
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
//var_dump($resultado_usuarios);

while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
 
var_dump($row_usuario);
 /* echo' 
<tr>
      <th scope="row">'. $row_usuario["paciente_id"] .'</th>
      <td>'. $row_usuario["nome"] .'</td>
      <td>'. $row_usuario["sexo"] .'</td>
      <td>'. $row_usuario["cns"] .'</td>
      <td>'. $row_usuario["situacaoderua"] .'</td>
      <td>'. date('d/m/Y', strtotime($row_usuario['datadenascimento'])).'</td>
      <td>'. $row_usuario["telefone"] .'</td>
      <td>'. $row_usuario["telefone2"] .'</td>
      <td>'. $row_usuario["endereco"] .'</td>
      <td>'. date('d/m/Y', strtotime($row_usuario['dataderegistro'])).'</td>
</tr>'
;*/
			

			//echo "<a type='button' class='btn btn-secondary' href='edit_produto.php?id=" . $row_usuario['paciente_id'] . "'>Editar</a><br><hr>";
;}
?>
 

	