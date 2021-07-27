<?php
include_once("../controler/conecta.php");


$datainicio = implode("-", array_reverse(explode("/", $_POST['datainicio'])));
$datafinal = implode("-", array_reverse(explode("/", $_POST['datafinal'])));
$id = $_POST['atendimento'];



if ($id == "") {
    $adiciona2 = '';
} else {
    $adiciona2 = "and servicos.servico='$id'";
}



$html = '<table width="780"   border=1';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Nome</th>';

$html .= '<th colspan="6">Atendimento => Colaboradores</th>';

//$html .= '<th>Colaborador</th>';

$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_transacoes = "SELECT distinct `nome`,`paciente`.`paciente_id` FROM paciente INNER JOIN servicos ON
 paciente.paciente_id=servicos.paciente_id where  servicos.dataservico >= '$datainicio' and servicos.dataservico <='$datafinal' $adiciona2  order by `nome`";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
    $html .= '<tr><td rolspan="2">' . $row_transacoes['nome'] . "</td>";
    $nomeescap = $row_transacoes["paciente_id"];
    $cont = 1;
        $cont2 = 6;
    $extra = '';
    $extra2 = '';
    $result_transacoes2 =     "SELECT `servico`,`nomecolaborador` FROM `servicos` WHERE `paciente_id`LIKE '$nomeescap'";
    $resultado_trasacoes2 = mysqli_query($conn, $result_transacoes2);
    while ($row_transacoes2 = mysqli_fetch_assoc($resultado_trasacoes2)) {
        if ($cont > 6) {
            $html .= "<tr><td>Atendimentos extras do paciente a cima</td>";
            $cont = 1;
        }
        $html .= "$extra" . "<td style='WORD-BREAK:BREAK-ALL;'>" . $row_transacoes2['servico'] . " => " . $row_transacoes2['nomecolaborador'] . "</td>" . "$extra2";
        $cont++;
        $cont2--;
    }
    while ($cont2 > 0) {
        $html .= "$extra" . "<td style='WORD-BREAK:BREAK-ALL;'></td>" . "$extra2";
        $cont2--;
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
$dompdf->set_paper("A4", "landscape");
// Carrega seu HTML
$dompdf->load_html('
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
   
    <title>Relatorio</title>
<link rel="stylesheet" href="css/pdf.css">
</head>
<body>

<div class="landscape">
			<h1 style="text-align: center;">Relatório de atendimentos  </h1>

<h3 style="text-align: center;">Data de inicio ' . $_POST["datainicio"] . '<br> Data final ' . $_POST["datafinal"] . ' </h3>
			
' . $html . '
		</div>
    
</body>
</html>');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "relatorio_pacientes.pdf",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
