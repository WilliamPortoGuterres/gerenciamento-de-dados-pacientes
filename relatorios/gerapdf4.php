<?php	
include_once("../controler/conecta.php");


$id= $_GET['id'];

	

	$result_transacoes = "SELECT * FROM paciente where paciente_id like '$id' ";
	
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	if($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
        $date1 = date_create_from_format('Y-m-d', $row_transacoes["datadenascimento"]);
        $date2 = date_create_from_format('Y-m-d', $row_transacoes["dataderegistro"]);
        $diff = (array) date_diff($date1, $date2);
	}
	
	
	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../script/dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	$dompdf->set_base_path('../css');
	// Carrega seu HTML
	$dompdf->load_html('
	<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pdf.css">
  <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>

<body>
<img src="../imagens/logo_ibsaude.jpeg"  alt="imagem ibsaúde" >
    <div class="tamanhototal center">
        <h3 class="espaco">ACOLHIMENTO INICIAL</h3>

        
        <ul>
            <li>
                Data de entrada:&nbsp;&nbsp;' . implode("/", array_reverse(explode("-", $row_transacoes['dataderegistro']))).'
            </li>
            <li class="espaco alinharesquerda">
                Prontuário N°:&nbsp;&nbsp;' . $row_transacoes["numeroprontuario"].'

            </li>
        </ul>
        <table class="borda larguratotal">
            <tr>
                <td colspan="4" class="larguratotal borda">
                    <p>Nome:&nbsp;&nbsp;' .  $row_transacoes["nome"].'</p>
                </td>

            </tr>
            <tr>
                <td colspan="2" class="meialargura">
                    <p>Demanda espontanea:&nbsp;&nbsp;' . $row_transacoes["demandaespontanea"].'</p>
                </td>
                <td colspan="2" class="meialargura">
                    <p>Encaminhamento por via:&nbsp;&nbsp;'. $row_transacoes["encaminhamentoporvia"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>Acompanhante:&nbsp;&nbsp;' . $row_transacoes["acompanhante"].'</p>
                </td>

            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>Nome da mãe:&nbsp;&nbsp;' . $row_transacoes["nomedamae"].'</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="meialargura">
                    <p>Data de nascimento:&nbsp;&nbsp;' . implode("/", array_reverse(explode("-", $row_transacoes['datadenascimento']))).' </p>
                </td>
                <td colspan="1" class="quartodelargura">
                    <p>Idade:&nbsp;&nbsp;'. $diff['y'].'</p>
                </td>
                <td colspan="1" class="quartodelargura">
                    <p>Sexo:&nbsp;&nbsp;'. $row_transacoes["sexo"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="meialargura">
                    <p>RG:&nbsp;&nbsp;'. $row_transacoes["rg"].'</p>
                </td>
                <td colspan="2" class="meialargura">
                    <p>CPF:&nbsp;&nbsp;'. $row_transacoes["cpf"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="meialargura">
                    <p>CNS:&nbsp;&nbsp;'. $row_transacoes["cns"].'</p>
                </td>
                <td colspan="2" class="meialargura">
                    <p>Estado civil:&nbsp;&nbsp;'. $row_transacoes["estadocivil"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>Naturalidade:&nbsp;&nbsp;'. $row_transacoes["naturalidade"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>Endereço:&nbsp;&nbsp;'. $row_transacoes["endereco"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="meialargura">
                    <p>Bairro:&nbsp;&nbsp;'. $row_transacoes["bairro"].'</p>
                </td>
                <td colspan="1" class="quartodelargura">
                    <p>Cidade:&nbsp;&nbsp;'. $row_transacoes["cidade"].'</p>
                </td>
                <td colspan="1" class="quartodelargura">
                    <p>CEP:&nbsp;&nbsp;'. $row_transacoes["cep"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>Situação de rua:&nbsp;&nbsp;'. $row_transacoes["situacaoderua"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>Ponto de referência:&nbsp;&nbsp;'. $row_transacoes["endereco2"].'</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p>UBS referencia:&nbsp;&nbsp;'. $row_transacoes["ubsreferencia"].'</p>
                </td>

            </tr>
            <tr>
                <td colspan="4" class="larguratotal">
                    <p >Telefones:&nbsp;&nbsp;'. $row_transacoes["telefone"].','. $row_transacoes["telefone2"].'</p>
                </td>
            </tr>
          <tr>
                <td colspan="4" rows="3" class="larguratotal obs">
                    <p>Observações:&nbsp;&nbsp;'. $row_transacoes["comorbidade"].',&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row_transacoes["beneficio"].'</p>
                </td>
            </tr>


        </table>




    </div>


</body>

</html>

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