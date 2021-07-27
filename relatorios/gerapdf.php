<?php	
include_once("../controler/conecta.php");

$ativoinativo=$_POST['ativoinativo'];
$datainicio=implode("-", array_reverse(explode("/", $_POST['datainicio'])));
$datafinal=implode("-", array_reverse(explode("/", $_POST['datafinal'])));

$result_quant_transacoes = "SELECT count(*)  FROM paciente where dataderegistro >= '$datainicio' and dataderegistro <='$datafinal'";
	$resultado_quant_trasacoes = mysqli_query($conn, $result_quant_transacoes);
if($row_quant_transacoes = mysqli_fetch_assoc($resultado_quant_trasacoes)){
$total_pacientes=$row_quant_transacoes['count(*)'];
};
$result_quant_ativos_transacoes = "SELECT count(*)  FROM paciente where ativoinativo like 'Ativo' and  dataderegistro >= '$datainicio' and dataderegistro <='$datafinal'";
	$resultado_quant_ativos_trasacoes = mysqli_query($conn, $result_quant_ativos_transacoes);
if($row_quant_ativos_transacoes = mysqli_fetch_assoc($resultado_quant_ativos_trasacoes)){
$total_pacientes_ativos=$row_quant_ativos_transacoes['count(*)'];
$total_pacientes_inativos=$total_pacientes-$total_pacientes_ativos;
};





	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Nome</th>';
	$html .= '<th>CNS</th>';
	$html .= '<th>Sexo</th>';
	$html .= '<th>atividade</th>';
	$html .= '<th>TR</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
if($ativoinativo=='ambos'){
$result_transacoes = "SELECT * FROM paciente where 
 dataderegistro >= '$datainicio' and dataderegistro <='$datafinal' ";
}else{
	$result_transacoes = "SELECT * FROM paciente where ativoinativo like '$ativoinativo' and dataderegistro >= '$datainicio' and dataderegistro <='$datafinal' ";
}	
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['nome'] . "</td>";
		$html .= '<td>'.$row_transacoes['cns'] . "</td>";
		$html .= '<td>'.$row_transacoes['sexo'] . "</td>";
		$html .= '<td>'.$row_transacoes['ativoinativo'] . "</td>";
$id=$row_transacoes['atendimentotr'];
$result_transacoes2 = "SELECT `nomecolaborador` FROM colaboradores where  id_colaboradores='$id' ";
$resultado_trasacoes2 = mysqli_query($conn, $result_transacoes2);
	if($row_transacoes2 = mysqli_fetch_assoc($resultado_trasacoes2)){

		$html .= '<td>'.$row_transacoes2['nomecolaborador'] . "</td></tr>";		
	}
		
	}
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../script/dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Relatório por data de inscrição</h1>
<h3 style="text-align: center;">Total de pacientes '.$total_pacientes.'  <br>   ativos '.$total_pacientes_ativos.'  <br>   inativos '.$total_pacientes_inativos.'</h3>
<h3 style="text-align: center;">Data de inicio '.$_POST["datainicio"].' Data final '.$_POST["datafinal"].' </h3>
			
'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio_pacientes.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>