<?php	
include_once("../controler/conecta.php");

$ativoinativo=$_POST['ativoinativo'];
$datainicio=implode("-", array_reverse(explode("/", $_POST['datainicio'])));
$datafinal=implode("-", array_reverse(explode("/", $_POST['datafinal'])));
$id=$_POST['atendimentotr'];

if($ativoinativo=='ambos'){
$adiciona='';
}else{
$adiciona="and paciente.ativoinativo like '$ativoinativo'";
}




	$html = '<table  border=1';	
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
	
$result_transacoes = "SELECT distinct `nome`,`cns`,`sexo`,`ativoinativo`,`atendimentotr` FROM paciente INNER JOIN presenca ON
 paciente.paciente_id=presenca.paciente_id where  presenca.datapresenca >= '$datainicio' and presenca.datapresenca <='$datafinal'and paciente.atendimentotr='$id' $adiciona ";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['nome'] . "</td>";
		$html .= '<td>'.$row_transacoes['cns'] . "</td>";
		$html .= '<td>'.$row_transacoes['sexo'] . "</td>";
		$html .= '<td>'.$row_transacoes['ativoinativo'] . "</td>";
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
			<h1 style="text-align: center;">Relatório por TR e atividade no periodo</h1>

<h3 style="text-align: center;">Data de inicio '.$_POST["datainicio"].'<br> Data final '.$_POST["datafinal"].' </h3>
			
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