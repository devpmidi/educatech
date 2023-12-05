<?php require_once('modulos/turma.php') ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/stylecard.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <title>Disciplinas</title>
    </head>
    
    <style>
        h2{
            text-align: center;
            color: #13cecede;
            font-size: 30pt;
        }

        #tabel{
            text-align: center;
            font-size: 12pt;
            width: 85%;
            min-height: 100px;
            overflow: auto;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 40px;
            border: 1px;
            border-radius: 15px;
        }

        .coluna{
            height: 35px;
            padding: 10px;
        }
        
        .link-aula{
            color:darkblue;
        }
        
        #docentesFund1{
            width: 85%;
            min-height: 30px;
            overflow: auto;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
            font-size: 16px;
            color: #f0ffffde;
        }
        
        #docentesFund1 a{
            color: #f0ffffde;
        }
    </style>
    <body>
        <nav>
            <ul>
                <li><a href="area-do-aluno.php">Voltar</a></li>
                <li><a href="sair-sistema.php">Sair</a></li>
            </ul>
        </nav>
        <?php require_once('cabecalho-aluno.php') ?>

        <h2>DISCIPLINAS</h2>
        
        <table id="tabel">
            <colgroup>
                <col span="6" style="background-color:whitesmoke">
                <col style="background-color:whitesmoke">
            </colgroup>

            <tr>
                <td> <u>HORÁRIO</u><br><br>
                </td> 

                 <td> <u>SEGUNDA </u><br><br>
                 </td> 

                <td> <u>TERÇA </u><br><br>
                 </td> 

                <td> <u>QUARTA</u><br><br>
                </td> 

                <td> <u>QUINTA </u><br><br>
                 </td> 

                <td> <u>SEXTA</u><br><br>
                 </td> 
            </tr>

            <?php 
                $diaSemana = array("segunda", "terca", "quarta", "quinta", "sexta");
                $linha = 1;
                $coluna = 1;

                for($linha; $linha <= 5; $linha++){  ?> 
                    <tr>
                        <!-- Coluna dos horarios -->
                        <td class='coluna'> 
                            <?php 
                                if($linha == 1){
                                    if($dadosAluno['periodo'] == "MANHÃ"){
                                        echo("07h20 - 8h10<br><br>");
                                    } else {
                                        echo("13h – 13h50<br><br>");
                                    }
                                } else if($linha == 2){
                                    if($dadosAluno['periodo'] == "MANHÃ"){
                                        echo("8h10 às 9h00<br><br>");
                                    } else {
                                        echo("13h50 – 14h40<br><br>");
                                    }
                                } else if($linha == 3){
                                    if($dadosAluno['periodo'] == "MANHÃ"){
                                        echo("9h00 às 9h50<br><br>");
                                    } else {
                                        echo("13h50 – 14h<br><br>");
                                    }
                                } else if($linha == 4){
                                    if($dadosAluno['periodo'] == "MANHÃ"){
                                        echo("10h20 às 11h10<br><br>");
                                    } else {
                                        echo("15h50 – 16h40 <br><br>");
                                    }
                                } else {
                                    if($dadosAluno['periodo'] == "MANHÃ"){
                                        echo("11h10 às 12h00<br><br>");
                                    } else {
                                        echo("16h40 – 17h30 <br><br>");
                                    }
                                }

                            ?>
                     </td> 
                        <?php 
                            for($coluna; $coluna <= 5; $coluna++){
                                 $gradeTurma = consultarDisciplinaPelaAula($idTurma, $linha, $diaSemana[$coluna-1]); ?>

                                <td class='coluna'> 
                                    <?php 
                                        if($gradeTurma == null){
                                            echo("S/N");
                                        } else if($ciclo < 6){
                                            echo($gradeTurma['nomeDisciplina']);
                                        } else {
                                            $url = "lista-aulas.php?idTurma=".$idTurma;
                                            $url .= "&disc=".$gradeTurma['nomeDisciplina'];
                                            $url .= "&cod=".$gradeTurma['idDisciplina'];
                                    ?>
                                    
                                            <a href='<?php echo($url); ?>' class='link-aula' target="_blank"> 
                                                <?php echo($gradeTurma['nomeDisciplina']); ?>
                                            </a>
                                            <p> Prof.(a) <?php echo strstr($gradeTurma['nomeUsuario'], ' ', true); ?> </p>
                                </td> 
                        <?php 
                                }
                            }
                            $coluna=1;
                        ?>
                    </tr>
            <?php 
                     if($linha == 3){ ?>
                        <tr>
                            <td class='coluna'>   
                                <?php
                                    if(!$gradeTurma == null){
                                        if($gradeTurma['periodo'] == "MANHÃ"){
                                            echo("9h50 às 10h20<br><br");
                                        } else {
                                            echo("15h30 – 15h50<br><br");
                                        }
                                    } else {
                                        echo("Intervalo");
                                    }
                                ?>
                            </td> 

                            <td> Intervalo </td> 
                            <td> Intervalo </td> 
                            <td> Intervalo </td> 
                            <td> Intervalo </td> 
                            <td> Intervalo </td> 
                        </tr>
           <?php      }
                }
            ?>
        </table>
        
        <?php if($ciclo < 6 && $gradeTurma != null){ 
            $docenteResponsavel = selecionarRespTurma($idTurma);
            $docenteEF = selecionarDocentesFund($idTurma, 4);
            $docenteIG = selecionarDocentesFund($idTurma, 8);
            $docenteAT = selecionarDocentesFund($idTurma, 2);
    
            $urlFund = "lista-aulas.php?idTurma=".$idTurma."&disc=Educação básica (Fundamental I)
&cod=1";
            $urlEF = "lista-aulas.php?idTurma=".$idTurma."&disc=Educação Fisica&cod=4";
            $urlIG = "lista-aulas.php?idTurma=".$idTurma."&disc=Língua inglesa&cod=8";
            $urlAT = "lista-aulas.php?idTurma=".$idTurma."&disc=Artes&cod=2";
        
        ?>
            <div id="docentesFund1">
                <p> 
                    Prof.(a) responsável: <?php echo($docenteResponsavel['nomeUsuario']); ?> 
                    <a href='<?php echo($urlFund); ?>' target='_blank'>  (Ver aulas) </a>
                </p>

                <p>
                    Educação Fisica: <?php echo($docenteEF['nomeUsuario']); ?> 
                    <a href='<?php echo($urlEF); ?>' target='_blank'>  (Ver aulas) </a>
                </p>

                <p>
                    Inglês:  <?php echo($docenteIG['nomeUsuario']); ?>
                    <a href='<?php echo($urlIG); ?>' target='_blank'>  (Ver aulas) </a>
                </p>
                <p>
                    Artes: <?php echo($docenteAT['nomeUsuario']); ?>
                    <a href='<?php echo($urlAT); ?>' target='_blank'>  (Ver aulas) </a>
                </p>
            </div>
        <?php      
            }
        ?>
        <footer>
            <p>&copy; 2023 Disciplinas da turma</p>
        </footer>
    </body>
</html>