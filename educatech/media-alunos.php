<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);
    require_once('modulos/usuario.php'); 
    require_once('modulos/turma.php');
    require_once('modulos/aluno.php');
    require_once('modulos/media.php');

    $idTurma = $_GET['idTurma'];
    $idDisciplina = $_GET['cod'];
    $nomeDisciplina = $_GET['disc'];

    $turma = buscarTurmaPorId($idTurma);
    $text = $turma['ciclo']."º ";
    $text .= $turma['turma']. " (";
    $text .= $turma['periodo'].")";
    $ano = date('Y');

    /*Verifica se tem alunos cadastrados na turma*/
    $listaAlunos = consultarAlunosPorTurma($idTurma);
    if(mysqli_num_rows($listaAlunos) == 0){
        echo('<script>');
        echo('alert("Não tem alunos cadastrados na turma. ");');
        echo('window.location="turmas-do-professor.php"');
        echo('</script>');
    }

    if(isset($_POST['btnCadMedia'])){
        $cicloBoletim = $_POST['selectBimestre'];
        $idUsuario = $_POST['idUsuario'];
        
        if(isset($_POST['opDisciplina'])){
            $idDiscMedia = $_POST['opDisciplina'];
        } else {
            $idDiscMedia = $idDisciplina;
        }
        
        $validarBoletim = validarCicloBoletim($ano, $idTurma, $idDiscMedia, $cicloBoletim);
        
        if($validarBoletim){
            echo('<script>');
            echo('alert("Já foi registrado notas dessa turma para esse bimestre, escolha outra opção. ");');
            echo('</script>');
        } else {
            
            while($rsAluno = mysqli_fetch_array($listaAlunos)){ 
                $ra = $rsAluno['raAluno'];
                $nota = $_POST[$ra];

                $sucesso = registrarMedia($ra, $cicloBoletim, $nota, $ano,  $idDiscMedia, $idUsuario, $idTurma);
                $idDisciplina = $_GET['cod'];
            }    

            if($sucesso){
                echo('<script>');
                echo('alert("Dados salvos com sucesso! ");');
                $url = "window.location='lista-aulas.php?idTurma=".$idTurma."&disc=".$nomeDisciplina."&cod=".$idDisciplina."'";
                echo($url);
                echo('</script>');
            } else {
                header("erro.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Média da turma </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    </head>

    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php') ?>
        </div>
        
        <div id='container-branco'>
            
            <div class='linha'>
                <?php echo(date('d/m/Y')." : Atribuir média da turma "); ?>
                <p>  <a href='turmas-do-professor.php' class='link-aula'>
                    Voltar para página Inicial
                </a> </p>
            </div>
            
            <div class='linha header-titulo'>
               <?php echo("Disciplina de ".$nomeDisciplina."   - Turma ".$text); ?>  
            </div>
            <form name='formMediaAlunos' method="post">
                <div class="linha">
                    <div class='coluna-02'>
                        <div class="linha"> 
                            <label for='selectBimestre'> Escolha o bimestre: </label> 
                        </div>
                        <select name='selectBimestre' id='select-escola' required>
                            <option value="" selected disabled> Selecione </option> 
                            <option value="1">  1º </option>
                            <option value="2">  2º </option>
                            <option value="3">  3º </option>
                            <option value="4">  4º </option>
                        </select>
                    </div>
                </div>
  
                <?php if($idDisciplina == 1){ ?> 
                    <div class="linha"> 
                        <label for='opDisciplina'> Disciplina: </label> 
                    </div>
                        <?php 
                            $listaDisciplinas = selecionarDisciplinasGeraisFund1();

                            while($disciplina = mysqli_fetch_array($listaDisciplinas)){ ?>   

                                <div class='linha'>
                                    <input type="radio" name="opDisciplina" value="<?php echo($disciplina['idDisciplina']); ?>">
                                    <?php echo($disciplina['nomeDisciplina']); ?>
                                </div>            
              
                <?php   }
    
                        echo("<br> <br>");
                    }

                ?>
                <div class='linha' style="margin-bottom:20px">
                    <strong> Para cada aluno, calcule a nota com base nas avaliações realizadas ao longo do período. </strong>
                </div>
                
                <div class='linha' id='header-tabela-presenca'>
                    Lista de alunos
                </div>
                
                <div id='lista-presenca'>
                    <?php 
                        while($rsAluno = mysqli_fetch_array($listaAlunos)){ 
                            $ra = $rsAluno['raAluno'];
                            ?>
                            <div class='linha-tabela-aluno'>
                                <div class='coluna-04'>
                                    <strong> <?php echo($ra); ?> </strong>
                                </div>

                                <div class='coluna-06'>
                                    <?php echo($rsAluno['nomeAluno']); ?>
                                </div>

                                <div class='coluna-01'>
                                    <input type='number' name="<?php echo($ra); ?>" min="0" max="10" required class='inputs-cad-escola' value="0">
                                    
                                </div>
                            </div> 
                    <?php   }  ?>
                      
                </div>
                
                <div class='linha'>
                    <input type='submit' name='btnCadMedia' class='btn-voltar' value="Salvar dados">
                </div>
                
                <input type='hidden' name='idUsuario' value="<?php echo($usuario['idUsuario']);?>">
            </form>
        </div>
    </body>
</html>


