<?php	
include_once("../controler/conecta.php");


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
$result_quant_total_transacoes = "SELECT count(*)  FROM paciente ";
	$resultado_quant_total_trasacoes = mysqli_query($conn, $result_quant_total_transacoes);
if($row_quant_total_transacoes = mysqli_fetch_assoc($resultado_quant_total_trasacoes)){
$total_geral_pacientes=$row_quant_total_transacoes['count(*)'];
};
$result_quant_ativos_transacoes = "SELECT count(*)  FROM paciente where ativoinativo like 'Ativo' ";
	$resultado_quant_ativos_trasacoes = mysqli_query($conn, $result_quant_ativos_transacoes);
if($row_quant_ativos_transacoes = mysqli_fetch_assoc($resultado_quant_ativos_trasacoes)){
$total_geral_pacientes_ativos=$row_quant_ativos_transacoes['count(*)'];
$total_geral_pacientes_inativos=$total_geral_pacientes-$total_geral_pacientes_ativos;
};
$result_atendimentos_transacoes = "SELECT distinct count(paciente.nome) FROM paciente INNER JOIN servicos ON paciente.paciente_id=servicos.paciente_id where servicos.dataservico >= '$datainicio' and servicos.dataservico <='$datafinal' and servicos.servico != '' ";
	$resultado_atendimentos_trasacoes = mysqli_query($conn, $result_atendimentos_transacoes);
if($row_atendimentos_transacoes = mysqli_fetch_assoc($resultado_atendimentos_trasacoes)){

$atendimentos=$row_atendimentos_transacoes;
};
$result_paciente_atendimentos_transacoes = "SELECT  count(distinct paciente.nome) FROM paciente INNER JOIN servicos ON paciente.paciente_id=servicos.paciente_id where servicos.dataservico >= '$datainicio' and servicos.dataservico <='$datafinal' and servicos.servico != '' ";
	$resultado_paciente_atendimentos_trasacoes = mysqli_query($conn, $result_paciente_atendimentos_transacoes);
if($row_paciente_atendimentos_transacoes = mysqli_fetch_assoc($resultado_paciente_atendimentos_trasacoes)){

$atendimentos_pacientes=$row_paciente_atendimentos_transacoes;
};



	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../script/dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Relatório quantitativo geral</h1>
<h3 style="text-align: center;">Total de pacientes até a data hoje </h3>
<p style="text-align: center;">Total de pacientes '.$total_geral_pacientes.'</p> 
<p style="text-align: center;">Ativos '.$total_geral_pacientes_ativos.'</p>	
<p style="text-align: center;">Inativos '.$total_geral_pacientes_inativos.'</p>



<h3 style="text-align: center;">Total de pacientes entre as datas </h3>
<h3 style="text-align: center;">Data de inicio '.$_POST["datainicio"].'<br> Data final '.$_POST["datafinal"].' </h3>

<p style="text-align: center;">Total de pacientes '.$total_pacientes.'</p> 
<p style="text-align: center;">Ativos '.$total_pacientes_ativos.'</p>	
<p style="text-align: center;">Inativos '.$total_pacientes_inativos.'</p>



<h3 style="text-align: center;">Total de pacientes que receberam atendimento entre as datas </h3>
<h3 style="text-align: center;">Data de inicio '.$_POST["datainicio"].' <br>Data final '.$_POST["datafinal"].' </h3>
<p style="text-align: center;">Total de pacientes receberam atendimento '.$atendimentos_pacientes["count(distinct paciente.nome)"].'</p> <br>
			

<h3 style="text-align: center;">Total de atendimentos entre as datas </h3>
<h3 style="text-align: center;">Data de inicio '.$_POST["datainicio"].' Data final '.$_POST["datafinal"].' </h3>
<p style="text-align: center;">Total de atendimentos realizados '.$atendimentos["count(paciente.nome)"].'</p> <br>
			

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