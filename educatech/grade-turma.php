<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);

    require_once('modulos/turma.php');
    require_once('modulos/aluno.php');
    
    $ciclo = $_GET['ciclo'];
    $turma = $_GET['turma'];
    $periodo = "";
    $dadosTurma=null;
    $idTurma = 0;
    $valueBtn = "";

?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - <?php echo($ciclo."º ".$turma); ?> </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
        
    </head>
    
    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php') ?>
        </div>
        
        <?php 
            $dadosTurma = buscarTurma($idEscola, $ciclo, $turma);
            
            if($dadosTurma == null){
                /*Cadastra a turma se ainda não existir no banco de dados*/
                if($turma == "C"){
                    $periodo = "TARDE";
                } else {
                    $periodo = "MANHÃ";
                }
                
                cadastrarTurma($idEscola, $ciclo, $turma, $periodo);
                $dadosTurma = buscarTurma($idEscola, $ciclo, $turma);
                
            } else {
                $periodo = $dadosTurma['periodo'];
                $valueBtn = "Salvar alterações";
                $idTurma = $dadosTurma['idTurma'];
            }
            
            /*Verifica se já possui a grade de horario no banco de dados
            ou se é um novo registro */
            $temRegistro = verificarHorariosAula($idTurma);
            if($temRegistro){
                $valueBtn = "Salvar alterações";
            } else {
                $valueBtn = "Salvar dados";
            }

        ?>
        
        <div id='container-branco'>
            
            <div id='alerta-mobile'>
                Algumas funcionalidades somente estão disponíveis para tela de computador.  
            </div>
            
            <div class='linha header-titulo header-form-aulas'>
                Horário das aulas  
            </div>
            <div class='header-tabela header-form-aulas'>
                <?php echo($ciclo."º CICLO TURMA: ".$turma); ?>
            </div>
            
            <form name='formHorarioAulas' method="post">
                
                <div id='form-horario-aulas'>
                    <div class='linha-tabela'>
                        <div class='coluna-02'>
                            <strong> HORÁRIO </strong>
                        </div>
                        <div class='coluna-02'>
                            <strong> SEGUNDA-FEIRA </strong>
                        </div>
                        <div class='coluna-02'>
                            <strong> TERÇA-FEIRA </strong>
                        </div>
                        <div class='coluna-02'>
                            <strong> QUARTA-FEIRA </strong>
                        </div>
                        <div class='coluna-02'>
                            <strong> QUINTA-FEIRA </strong>
                        </div>
                        <div class='coluna-02'>
                            <strong> SEXTA-FEIRA </strong>
                        </div>
                    </div>
    
                    <div class='linha-tabela linha-tabela-cor'>
                        <div class='coluna-02'>
                            <?php if($periodo == "MANHÃ"){ echo("7h10 às 8h00"); } else { echo("13h10 às 14h00"); } ?>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='segundaAula1' id='segundaAula1' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='tercaAula1' id='tercaAula1' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quartaAula1' id='quartaAula1' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quintaAula1' id='quintaAula1' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='sextaAula1' id='sextaAula1' class='selects-disciplinas' required>
                            </select>
                        </div>
                    </div>
    
                    <div class='linha-tabela'>
                        <div class='coluna-02'>
                            <?php if($periodo == "MANHÃ"){ echo("8h00 - 8h50"); } else { echo("14h00 às 14h50"); } ?>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='segundaAula2' id='segundaAula2' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='tercaAula2' id='tercaAula2' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quartaAula2' id='quartaAula2' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quintaAula2' id='quintaAula2' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='sextaAula2' id='sextaAula2' class='selects-disciplinas' required>
                            </select>
                        </div>
                    </div>
    
                    <div class='linha-tabela' id='linha-intervalo'>
                        <strong> INTERVALO - (<?php if($periodo == "MANHÃ"){ echo("	8h50 - 9h20"); } else { echo("14h50 às 15h10"); } ?>) </strong>
                    </div>  
    
                    <div class='linha-tabela'>
                        <div class='coluna-02'>
                            <?php if($periodo == "MANHÃ"){ echo("9h20 às 10h10"); } else { echo("15h10 ás 16h00"); } ?>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='segundaAula3' id='segundaAula3' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='tercaAula3' id='tercaAula3' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quartaAula3' id='quartaAula3' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quintaAula3' id='quintaAula3' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='sextaAula3' id='sextaAula3' class='selects-disciplinas' required>
                            </select>
                        </div>
                    </div>
    
                    <div class='linha-tabela linha-tabela-cor'>
                        <div class='coluna-02'>
                            <?php if($periodo == "MANHÃ"){ echo("10h10 às 11h00"); } else { echo("16h00 às 16h50"); } ?>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='segundaAula4' id='segundaAula4' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='tercaAula4' id='tercaAula4' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quartaAula4' id='quartaAula4' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quintaAula4' id='quintaAula4' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='sextaAula4' id='sextaAula4' class='selects-disciplinas' required>
                            </select>
                        </div>
                    </div>
    
                    <div class='linha-tabela'>
                        <div class='coluna-02'>
                        <?php if($periodo == "MANHÃ"){ echo("11h00 às 11h50"); } else { echo("16h50 às 17h40"); } ?>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='segundaAula5' id='segundaAula5' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='tercaAula5' id='tercaAula5' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quartaAula5' id='quartaAula5' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='quintaAula5' id='quintaAula5' class='selects-disciplinas' required>
                            </select>
                        </div>
    
                        <div class='coluna-02'>
                            <select name='sextaAula5' id='sextaAula5' class='selects-disciplinas' required>
                            </select>
                        </div>
                    </div>
                    
                </div>

                <div class='linha header-titulo'>
                    Professores (as)
                </div>
                
                <div id='form-disciplinas-professores'>
                    <?php require_once('form-disciplina-professor.php'); ?>
                    
                    <div class='linha'>
                        <input type='submit' name='btnTurma' class='btn-cad-escola'  value="<?php echo($valueBtn); ?>">
                    </div>
                </div> 
            
            </form>    
            
            <div class='linha' id='header-tabela-aluno'>
                Lista de alunos (as)
            </div>
            
            <div id='lista-alunos'>
                
                <?php 
                    $listaAlunos = consultarAlunosPorTurma($idTurma);
                    
                    if(!mysqli_num_rows($listaAlunos) == 0){
                        
                        while($rsAluno = mysqli_fetch_array($listaAlunos)){ 
                            $ra = $rsAluno['raAluno'];
                            ?>
                            <div class='linha-tabela-aluno'>
                                <a href='aluno.php?ra=<?php echo($ra); ?>' target='_blank'>
                                    <div class='coluna-03'>
                                        <strong> <?php echo($ra); ?> </strong>
                                    </div>
            
                                    <div class='coluna-06 coluna-nome'>
                                        <?php echo($rsAluno['nomeAluno']); ?>
                                    </div>
            
                                    <div class='coluna-03'>
                                        <?php echo($rsAluno['dataNascimento']); ?>
                                    </div>
                                </a>
                            </div> 
                <?php   }    
                    } else {
                        echo("<div class='linha-tabela-aluno'>");
                        echo("Nenhum aluno cadastrado para essa turma.");
                        echo("</div>");
                    }
                ?>
    
                
            </div>
            
        </div>

    </body>
    
    <script>
        window.addEventListener("load", (event) => {
            preencherSelect('#segundaAula1', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 1, 'segunda');
            preencherSelect('#segundaAula2', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 2, 'segunda');
            preencherSelect('#segundaAula3', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 3, 'segunda');
            preencherSelect('#segundaAula4', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 4, 'segunda');
            preencherSelect('#segundaAula5', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 5, 'segunda');
            
            preencherSelect('#tercaAula1', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 1, 'terca');
            preencherSelect('#tercaAula2', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 2, 'terca');
            preencherSelect('#tercaAula3', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 3, 'terca');
            preencherSelect('#tercaAula4', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 4, 'terca');
            preencherSelect('#tercaAula5', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 5, 'terca');
            
            preencherSelect('#quartaAula1', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 1, 'quarta');
            preencherSelect('#quartaAula2', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 2, 'quarta');
            preencherSelect('#quartaAula3', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 3, 'quarta');
            preencherSelect('#quartaAula4', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 4, 'quarta');
            preencherSelect('#quartaAula5', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 5, 'quarta');
            
            preencherSelect('#quintaAula1', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 1, 'quinta');
            preencherSelect('#quintaAula2', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 2, 'quinta');
            preencherSelect('#quintaAula3', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 3, 'quinta');
            preencherSelect('#quintaAula4', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 4, 'quinta');
            preencherSelect('#quintaAula5', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 5, 'quinta');
            
            preencherSelect('#sextaAula1', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 1, 'sexta');
            preencherSelect('#sextaAula2', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 2, 'sexta');
            preencherSelect('#sextaAula3', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 3, 'sexta');
            preencherSelect('#sextaAula4', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 4, 'sexta');
            preencherSelect('#sextaAula5', <?php echo($idTurma); ?>, <?php echo($ciclo);?>, 5, 'sexta');
        });
        
        function preencherSelect(nomeSelect, idTurma, ciclo, aula, dia){
            $.ajax({
                type: "POST",
                url: "preencher-select-disciplinas.php",
                data: {
                    idTurma: idTurma, 
                    ciclo: ciclo, 
                    aula: aula,
                    dia: dia
                }, 
                success: function(dados){
                    $(nomeSelect).html(dados);
                },
                error: function(err){//Em caso de erro
                  console.log(err);//Exibir o erro no console JS do navegador
                }
            });
        }
    </script>
</html>
<?php 
    if(isset($_POST['btnTurma'])){
        $valueBtn = $_POST['btnTurma'];
        
        /** Loop para percorrer os dias da semana **/
        for($j =1; $j <= 5; $j++){
            
            if($j ==1){
                $diaSemana = "segunda";
            } else if($j ==2){
                $diaSemana = "terca";
            } else if($j ==3){
                $diaSemana = "quarta";
            } else if($j ==4){
                $diaSemana = "quinta";
            } else {
                $diaSemana = "sexta";
            }
            
            /** Loop para percorrer as aulas **/
            for($aula=1; $aula <= 5; $aula++){
                
                $nomeSelect = $diaSemana."Aula".$aula;
                
                $idDisciplina = $_POST[$nomeSelect];
                
                if($ciclo < 6){
                    /* Fundamental II */
                    
                    $idRespFundI = $_POST["selectDisciplina1"];
                    $idDocenteAT = $_POST['selectDisciplina2']; // Artes
                    $idDocenteEF = $_POST["selectDisciplina4"]; // Educação Fisica
                    $idDocenteIG = $_POST["selectDisciplina8"]; // Ingles
                    
                    
                    if($idDisciplina == 4){
                        $idDocenteSelecionado = $idDocenteEF;
                    } else if($idDisciplina == 8){
                        $idDocenteSelecionado = $idDocenteIG;
                    } else if($idDisciplina == 2){
                        $idDocenteSelecionado = $idDocenteAT;
                    } else {
                        $idDocenteSelecionado =  $idRespFundI;
                    }
   
                } else {
                    $selectDisciplina = "selectDisciplina".$idDisciplina;
                    $idDocenteSelecionado = $_POST[$selectDisciplina];
                }
                
                if($valueBtn == 'Salvar dados'){
                    $sucessoCadastro = registrarHorarioAula($idTurma, $idDisciplina, $aula, $diaSemana, $idDocenteSelecionado);
                } else {
                    $sucessoEditar = alterarHorarioAula($idTurma, $idDisciplina, $aula, $diaSemana, $idDocenteSelecionado);
                }
            }
        }
        
        if($ciclo < 6){
            if($valueBtn == 'Salvar dados'){
                $sucessoCadastro = registrarDocenteResponsavel($idTurma, $_POST["selectDisciplina1"]);
            } else {
                $sucessoEditar = alterarDocenteResponsavel($idTurma, $_POST["selectDisciplina1"]);
            }
        }
        
        if($sucessoCadastro){
            echo('<script>');
            echo('alert("Dados salvos com sucesso!");');
            
            $dadosUrl = "ciclo=".$ciclo;
            $dadosUrl .= "&turma=".$turma;
            $url = "grade-turma.php?".$dadosUrl; 
            
            echo("window.location='$url'");
            echo('</script>');
        } else if($sucessoEditar){
            echo('<script>');
            echo('alert("Dados alterados com sucesso!");');
            
            $dadosUrl = "ciclo=".$ciclo;
            $dadosUrl .= "&turma=".$turma;
            $url = "grade-turma.php?".$dadosUrl; 
            
            echo("window.location='$url'");
            echo('</script>');
        }else {
            header('location:erro.php');
        } 

    }
    
?>


