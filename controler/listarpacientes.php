
<?php

include("conecta.php");
date_default_timezone_set('America/Sao_Paulo');
$localizador = filter_input(INPUT_POST,'localizador',FILTER_SANITIZE_STRING);
$selecionador = filter_input(INPUT_POST,'selecionador',FILTER_SANITIZE_STRING);


	
		$result_usuarios = "SELECT `paciente_id`, `nome`, `sexo`, `situacaoderua`, `datadenascimento`,`ultimapresenca`, `cns`, `email`, `telefone`, `telefone2`, `escolaridade`, `cid`, `tentativadesuicidio`, `nomedamae`, `endereco`, `endereco2`, `dataderegistro`, `tr` FROM `paciente` WHERE `$selecionador`like'%$localizador%' " ;
//var_dump($result_usuarios);		echo "<br>" ;
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
//var_dump($resultado_usuarios);

while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
 
     // <td> <div  data-id='.$row_usuario["paciente_id"].'><button id="presenca1"class="btn btn-primary">presenca</button></div></td>
  echo' 
<tr >
      <td class="text-nowrap"><a  name="edicao" class="btn btn-sm btn-success" href="atendimento.php?id='.$row_usuario["paciente_id"].'">Presença</a><a  name="edicao" class="btn btn-sm btn-primary" href="editapaciente.php?id='.$row_usuario["paciente_id"].'">editar</a><a  name="edicao" class="btn btn-sm btn-warning" href="relatorios/gerapdf4.php?id='.$row_usuario["paciente_id"].'">Relatório</a></td>
      <td class="text-nowrap">'. $row_usuario["nome"] .'</td>
      <td>'. $row_usuario["sexo"] .'</td>
      <td class="text-nowrap">'. $row_usuario["cns"] .'</td>
      <td>'. $row_usuario["situacaoderua"] .'</td>
      <td>'. implode("/",array_reverse(explode("-",$row_usuario['ultimapresenca']))).'</td>
      <td>'. implode("/",array_reverse(explode("-",$row_usuario['datadenascimento']))).'</td>
      <td>'. $row_usuario["telefone"] .'</td>
      <td>'. $row_usuario["telefone2"] .'</td>
      <td class="text-nowrap">'. $row_usuario["endereco"] .'</td>
      <td>'. implode("/",array_reverse(explode("-",implode("-",array_reverse(explode(" ",$row_usuario['dataderegistro'])))))).'</td>
      
</tr>'
;
			

			//echo "<a type='button' class='btn btn-secondary' href='edit_produto.php?id=" . $row_usuario['paciente_id'] . "'>Editar</a><br><hr>";
;}

 ?>

	