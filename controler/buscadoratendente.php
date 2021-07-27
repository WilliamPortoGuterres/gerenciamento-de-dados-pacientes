  <?php
include('conecta.php');
                        $result_usuarios2 = "SELECT nomecolaborador FROM `colaboradores` where funcaocolaborador like 'Colaborador'";
                        //var_dump($result_usuarios);		echo "<br>" ;
                        $resultado_usuarios2 = mysqli_query($conn, $result_usuarios2);
                        while ($row_usuario2 = mysqli_fetch_assoc($resultado_usuarios2)) {
                            //var_dump($result_usuarios2);
                            echo  '<option value=' . $row_usuario2['nomecolaborador'] . '>' . $row_usuario2['nomecolaborador'] . '</option>';
                            //var_dump($row_usuario);
                        }

                        ?>