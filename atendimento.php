<?php
session_start();
include("controler/loginobrigatorio.php");
include("controler/limit.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/mycss.css">
    <title>Atendimento</title>
</head>

<body>
    <div class="container">
        <?php
        include("templates/nvbar.php");
        ?>
        <div class="container">
            <?php
            if (isset($_SESSION["flag3"])) {
                if ($_SESSION["flag3"] == "sucesso") {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-success">O paciente foi cadastrado </h4></div><div class="col-sm-4"></div>';
                } else {
                    echo ' <div class="col-sm-4"></div> <div class="container col-sm-4">
                        <h4 class="btn btn-danger">O paciente não foi cadastrado </h4></div><div class="col-sm-4"></div>';
                };
                unset($_SESSION["flag3"]);
            }
            date_default_timezone_set('America/Sao_Paulo');
            include("controler/conecta.php");
            $datapresenca = date("Y-m-d");
            //var_dump($_GET);
            //var_dump($ultimpresenca);
            $id = $_GET['id'];

            $identificadordeedicao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $result_usuarios = "SELECT * FROM `paciente` WHERE `paciente_id`like'$identificadordeedicao' ";
            //var_dump($result_usuarios);		echo "<br>" ;
            $resultado_usuarios = mysqli_query($conn, $result_usuarios);
            if ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                //var_dump($row_usuario);

            };
            $date1 = date_create_from_format('Y-m-d', $row_usuario["datadenascimento"]);
            $date2 = date_create_from_format('Y-m-d', date('Y-m-d'));
            $diff = (array) date_diff($date1, $date2);
            //var_dump($date2);
            //var_dump($date1);
            //echo $diff['y'];


            ?>
            <div class="py-5 text-center">
                <!--<img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
                <h2>Atendimento de pacientes</h2>
                <!--<p class="lead">Abaixo temos um exemplo de formulário construído com controles de formulário Bootstrap. Cada campo obrigatório possui um estado de validação que é ativado quando tenta-se enviar o formulário sem completá-lo.</p>-->
            </div>

            <form id="atendimentopresenca" action="controler/presenca.php" method="post">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 ">
                        <input type="hidden" name="id" value="<?php echo $row_usuario['paciente_id']; ?>">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" readonly value="<?php echo $row_usuario['nome']; ?>">
                        <label for="">CNS</label>
                        <input type="text" class="form-control" readonly value="<?php echo $row_usuario['cns']; ?>">
                        <label for="">Última presença</label>
                        <input type="text" class="form-control" readonly value="<?php echo  implode("/", array_reverse(explode("-", $row_usuario['ultimapresenca']))); ?>">
                        <label for="">Idade</label>
                        <input type="text" class="form-control" readonly value="<?php echo $diff['y'] . ' anos'; ?>">
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-md"></div>
                    <div class="col-md">
                        <label for="especialidade">Atendimento a ser realizado</label>
                        <select type="select" onchange="AddInput()" class="form-control" id="especialidade" name="especialidade[]" placeholder="" value="">
                            <option value=""></option>
                            <option   value="Acolhimento inicial">Acolhimento inicial</option>
                            <option   value="Atendimento psiquiátrico">Atendimento psiquiátrico</option>
                            <option   value="Atendimento clinico">Atendimento clinico</option>
                            <option   value="Assistente social">Assistente social</option>
                            <option   value="Atendimento psicológico">Atendimento psicológico</option>
                            <option   value="Assistencia social">Assistencia social</option>
                            <option   value="Enfermagem">Enfermagem</option>
                            <option   value="Terapeuta ocupacional">Terapeuta ocupacional</option>
                            <option   value="Educador físico ">Educador físico </option>
                            <option   value="permanência noturna">permanência noturna</option>
                            <option   value="Oficineiro">Oficineiro</option>
                        </select>
                        <div id="marcadorespecialidade"></div>
                    </div>
                    <div class="col-md">
                        <label for="nomecolaborador">Atendente disponível</label>
                        <select type="select" class="form-control " id="nomecolaborador" name="nomecolaborador[]" placeholder="" value="">
                            <option value=""></option>
                            <?php
                            $result_usuarios2 = "SELECT nomecolaborador FROM `colaboradores` where funcaocolaborador like 'Colaborador'";
                            //var_dump($result_usuarios);		echo "<br>" ;
                            $resultado_usuarios2 = mysqli_query($conn, $result_usuarios2);
                            while ($row_usuario2 = mysqli_fetch_assoc($resultado_usuarios2)) {
                                //var_dump($result_usuarios2);
                                echo  '<option value=' . $row_usuario2['nomecolaborador'] . '>' . $row_usuario2['nomecolaborador'] . '</option>';
                                //var_dump($row_usuario);
                            }

                            ?>


                        </select>
                        <div id="marcadoratendente"></div>

                    </div>
                    <div class="col-md"></div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Presença e atendimento</button>
                    </div>
                    <div class="col-md-4"></div>

                </div>



            </form>

            <?php
            include("templates/footer.php");
            ?>
        </div>

        <?php
        include("script/script.php")
        ?>

</body>

</html>