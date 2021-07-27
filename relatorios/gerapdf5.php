<?php	
include_once("../controler/conecta.php");


$datainicio=implode("-", array_reverse(explode("/", $_POST['datainicio'])));
$datafinal=implode("-", array_reverse(explode("/", $_POST['datafinal'])));
$id=$_POST['atendimento'];



if($id==""){
$adiciona2= '';
}else{
$adiciona2="and servicos.servico='$id'";
}



	$html = '<table  border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Nome</th>';
	$html .= '<th>CNS</th>';
	//$html .= '<th>Sexo</th>';
	//$html .= '<th>Atividade</th>';
	$html .= '<th>Atendimento</th>';
    $html .= '<th>Data do atendimento</th>';
    $html .= '<th>Colaborador</th>';

	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
$result_transacoes = "SELECT distinct `nome`,`cns`,`sexo`,`ativoinativo`,`servico`,`dataservico`,`nomecolaborador` FROM paciente INNER JOIN servicos ON
 paciente.paciente_id=servicos.paciente_id where  servicos.dataservico >= '$datainicio' and servicos.dataservico <='$datafinal' $adiciona2  order by `nome`";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['nome'] . "</td>";
		$html .= '<td>'.$row_transacoes['cns'] . "</td>";
		//$html .= '<td>'.$row_transacoes['sexo'] . "</td>";
	//	$html .= '<td>'.$row_transacoes['ativoinativo'] . "</td>";
        $html .= '<td>'.$row_transacoes['servico'] . "</td>";
        $html .= '<td>'.implode("/", array_reverse(explode("-", $row_transacoes['dataservico']))). "</td>";
        $html .= '<td>'.$row_transacoes['nomecolaborador'] . "</td>";
	}
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../script/dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4", "portrail");
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Relatório por atendimento e atividade </h1>

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