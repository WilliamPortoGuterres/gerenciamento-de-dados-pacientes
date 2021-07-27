<?php session_start();
include("controler/loginobrigatorio.php");
include("controler/conecta.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="/css/mycss.css">
    <title>Relatorios</title>
</head>

<body>
    <div class="container">
        <?php
        include("templates/nvbar.php");
        ?>
        <div class="row p-3">
            <div class="col-sm-5">
            </div>
            <div class="col-sm">
                <h1>Relatórios</h1>
            </div>
            <div class="col-sm-5">
            </div>
        </div>
        <div class="container">
<div class="container">
            <div class="row">
                <div class="col-sm mb-3">
                    <form action="relatorios/gerapdf.php" method="post">
                        <h5 class="btn btn-primary btn-lg btn-block">Relatório por data de entrada</h5>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="datainicio">Data de inicio</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mascaradata" name="datainicio" id="datainicio1" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <label for="datafinal">Data de final</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mb-3 mascaradata" name="datafinal" id="datafinal1" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="container">
                                <select name="ativoinativo" id="ativoinativo">
                                    <option value="Ativo">Ativos</option>
                                    <option value="Inativo">Inativos</option>
                                    <option value="ambos">Ambos</option>
                                </select>
                            </div>

                        </div>
                        <input type="submit" class="mb-3" value="Requisitar relatório PDF">
                    </form>
                </div>
                <div class="col-sm mb-3">
                    <form action="relatorios/gerapdf2.php" method="post">
                        <h5 class="btn btn-primary btn-lg btn-block">Relatório por TR e atividade no periodo</h5>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="datainicio">Data de inicio</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mascaradata" name="datainicio" id="datainicio2" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <label for="datafinal">Data de final</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mb-3 mascaradata" name="datafinal" id="datafinal2" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 ">
                            <div class="container">
                                <select name="ativoinativo" id="ativoinativo">
                                    <option value="Ativo">Ativos</option>
                                    <option value="Inativo">Inativos</option>
                                    <option value="ambos">Ambos</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="atendimentotr">TR</label>
                                <select type="select" class="form-control" id="atendimentotr" value="" name="atendimentotr" placeholder="">
                                    <?php
                                    // var_dump($result_usuarios);		echo "<br>" ;
                                    $result_usuarios4 = "SELECT nomecolaborador,id_colaboradores FROM `colaboradores` where atendimentotr like 'tr'";
                                    $resultado_usuarios4 = mysqli_query($conn, $result_usuarios4);
                                    while ($row_usuario4 = mysqli_fetch_assoc($resultado_usuarios4)) {
                                        //var_dump($result_usuarios2);

                                        echo  '<option value="' . $row_usuario4["id_colaboradores"] . '"  >' . $row_usuario4['nomecolaborador'] . '</option>';
                                        //var_dump($row_usuario);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="mb-3" value="Requisitar relatório PDF">
                    </form>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm">
                    <form action="relatorios/gerapdf3.php" method="post">
                        <h5 class="btn btn-primary btn-lg btn-block">Relatório geral quantitativo</h5>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="datainicio">Data de inicio</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mascaradata" name="datainicio" id="datainicio3" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <label for="datafinal">Data de final</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mb-3 mascaradata" name="datafinal" id="datafinal3" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                        </div>
                        <input type="submit" class="mb-3" value="Requisitar relatório PDF">
                    </form>
                </div>
                <div class="col-sm mb-5">
                    <form action="relatorios/gerapdf6.php" method="post">
                        <h5 class="btn btn-primary btn-lg btn-block">Relatório de atendimentos</h5>
                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="datainicio">Data de inicio</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mascaradata" name="datainicio" id="datainicio5" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                            <div class="col-sm mb-3">
                                <label for="datafinal">Data de final</label>
                                <div class="input-group datepicker">
                                    <input type="text" class="form-control calendario mb-3 mascaradata" name="datafinal" id="datafinal5" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                         <!--   <div class="container">
                                <select name="ativoinativo" id="ativoinativo">
                                    <option value="Ativo">Ativos</option>
                                    <option value="Inativo">Inativos</option>
                                    <option value="ambos">Ambos</option>
                                </select>
                            </div>-->
                            <div class="col-sm-9">
                                <label for="atendimento">Atendimento</label>
                                <select type="select" class="form-control" id="atendimento" value="" name="atendimento" placeholder="">
                                  <option value="">Todos</option>  
                                    <option value="acolhimento inicial">Acolhimento inicial</option>
                                    <option value="Atendimento psiquiátrico">Atendimento psiquiátrico</option>
                                    <option value="Atendimento clinico">Atendimento clinico</option>
                                    <option value="Assistente social">Assistente social</option>
                                    <option value="Atendimento psicológico">Atendimento psicológico</option>
                                    <option value="Assistencia social">Assistencia social</option>
                                    <option value="Enfermagem">Enfermagem</option>
                                    <option value="Terapeuta ocupacional">Terapeuta ocupacional</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="mb-3" value="Requisitar relatório PDF">
                    </form>
</div>
                </div>
            </div>
        </div>
        <?php
        include("templates/footer.php");
        include("script/script.php");
        ?>
        <script>
            $(function() {
                $(".calendario").datepicker({
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
                });
            });
        </script>

</body>

</html>