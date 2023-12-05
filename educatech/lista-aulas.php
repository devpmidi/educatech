<?php 
    date_default_timezone_set('America/Sao_Paulo');
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    require_once('modulos/turma.php');
    require_once('modulos/aula.php');
    require_once('modulos/comentario.php');

    $idTurma = $_GET['idTurma'];
    $idDisciplina = $_GET['cod'];
    $nomeDisciplina = $_GET['disc'];
    
    $turma = buscarTurmaPorId($idTurma);
    $text = $turma['ciclo']."º ";
    $text .= $turma['turma']. " (";
    $text .= $turma['periodo'].")";

    $url= "idTurma=".$idTurma;
    $url .= "&disc=".$nomeDisciplina;
    $url .= "&cod=".$idDisciplina;
    $ra = "";
    $nomeContato = '';
    $modo = "";
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>  EducaTech - Todas as aulas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
        
    </head>

    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
            <?php
                require_once('cabecalho-usuario.php');
                if(isset($_SESSION['modo'])){
                    $modo = $_SESSION['modo'];
                }
                    
            ?>
        </div>
        
        <div id='container-branco'>
            
            <div class='linha'>
                <strong> Turma:  </strong> <?php echo($text); ?>
            </div>

	       <div class='linha'>
                 <strong> Disciplina: </strong> <?php echo($nomeDisciplina); ?>
            </div>
            
            <?php 
                if($modo == "docente"){ ?>
                    <div class='linha linha-link-aula'>
                        <strong> Links: </strong>
                        
                        <a href='turmas-do-professor.php' class='link-aula'>
                            Voltar 
                        </a>

                        <a href='aula.php?<?php echo($url); ?>' class='link-aula'>
                            Novo registro de aula
                        </a>
                        
                        <a href='media-alunos.php?<?php echo($url); ?>' class='link-aula'>
                            Atribuir média dos alunos
                        </a>
                    </div>
            <?php    } ?>
            
            <div class='linha header-titulo'>
                Aulas registradas
            </div>
  
            <?php 
                $listaAulas= buscarAulasPelaTurma($idDisciplina, $idTurma);

                if(!mysqli_num_rows($listaAulas) == 0){
                    while($rsAula = mysqli_fetch_array($listaAulas)){ ?>
                        <div class='linha-aulas'>
                            <div class='linha'>
                                <strong> Data: </strong> <?php echo($rsAula['dataAula']); ?>
                            </div>

                            <div class='linha text-aulas'>
                                <?php echo($rsAula['resumoAula']); ?>
                            </div>
                            
                            <div classs='linha'>
                                <div class='col-chamada'>
                                    Alunos (as) presentes:  
                                </div>
                                <?php 
                                    $listaPresenca = buscarListaDePresenca($rsAula['idAula']);
                                    
                                    if(!mysqli_num_rows($listaPresenca) == 0){
                                        while($rsPresenca = mysqli_fetch_array($listaPresenca)){ ?>
                                                                     
                                        <div class='col-chamada caixa-nome-aluno'>
                                            <strong> <?php echo($rsPresenca['raAluno']); ?> </strong> <?php echo($rsPresenca['nomeAluno']); ?>
                                        </div>
                                    
                                        <?php  }
                                    } else {
                                        echo("<div class='linha'>");
                                        echo("Nenhum registro.");
                                        echo("</div>");
                                    }
                                ?>
                                
                            </div>
                        </div>
             <?php  }
                } else {
                    echo("<div class='linha'>");
                    echo("Nenhum registro.");
                    echo("</div>");
                }
            ?>
            
            <div class='linha header-titulo ultima-linha-aulas'>
                Lista de tarefas
            </div>
            
            <?php 
                $listaTarefas= selecionarTarefasPelaTurmaDisciplina($idTurma, $idDisciplina); 
            
                if(!mysqli_num_rows($listaTarefas) == 0){
                    while($rsTarefa = mysqli_fetch_array($listaTarefas)){ ?>
                        <div class='linha-tarefas'>
                            <div class='linha'>
                                <strong> Data de vencimento:  </strong> <?php echo($rsTarefa['dataTarefa']); ?>   
                            </div>

                            <div class='linha text-aulas'>
                                <?php echo($rsTarefa['descTarefa']); ?> 
                            </div>

                            <div class='linha'>
                                <p> <strong> Referente a aula do dia <?php echo($rsTarefa['dataAula']); ?>   </strong> </p>
                            </div>
                        </div>
            <?php  }
                } else {
                    echo("<div class='linha'>");
                    echo("Nenhum registro.");
                    echo("</div>");
                }
            ?>
            <div class='linha header-titulo ultima-linha-aulas'>
                Comentários
            </div>
            
            <?php 
                $listaComentarios = selecionarComentarios($idTurma, $idDisciplina);
            
                if(!mysqli_num_rows($listaComentarios) == 0){
                    while($rsComentario = mysqli_fetch_array($listaComentarios)){ ?>
                        <div class='linha-comentarios'>
                            <div class='linha'>
                                <div class='coluna-03'>
                                    <strong> Data:  </strong> 
                                    <?php 
                                        $timestamp = strtotime($rsComentario['dataComentario']);
                                        echo date('d/m/Y H:i', $timestamp);
                                    ?> 
                                </div>

                                <div class='coluna-09'>
                                    <strong> Nome:  </strong> <?php echo($rsComentario['nomeContato']); ?> 
                                </div>
                            </div>

                            <div class='linha'>
                                <?php echo($rsComentario['comentario']); ?>
                            </div>
                        </div>
                        
            <?php  }
                } else {
                    echo("<div class='linha'>");
                    echo("Nenhum registro.");
                    echo("</div>");
                }
            ?>
            <br> 
            <div class='linha'>
                <br> <p> <strong> Novo comentário </strong></p> 
            </div>
            
            <form method="post" id='formComentario'>    
                <?php
                    if($modo == "docente"){
                        $opAluno = "disabled";
                        $opResp = "disabled";
                        $opDocente = "checked";
                        
                        $txtNome = "value='".$usuario['nomeUsuario']."'  readonly";
                    } else if($modo == "aluno"){
                        $opAluno = "checked";
                        $opResp = "disabled";
                        $opDocente = "disabled";
                        
                        $txtNome = "value='".$aluno['nomeAluno']."' readonly";
                        $ra = $aluno['raAluno'];
                    } else {
                        $opAluno = "disabled";
                        $opResp = "checked";
                        $opDocente = "disabled";
                        
                        $txtNome = "value=''";
                    }
                ?>
                
                <div class='linha'>
                    <div class='coluna-02'>
                        <input type="radio" name="tipoUserComentario" value="aluno" <?php echo($opAluno); ?>>
                         Aluno (a) 
                    </div>

                    <div class='coluna-02'>
                        <input type="radio" name="tipoUserComentario" value='responsavel' <?php echo($opResp); ?>> Responsável
                    </div>

                    <div class='coluna-02'>
                        <input type="radio" name="tipoUserComentario" value='docente' <?php echo($opDocente); ?>> Docente
                    </div>
                </div>
                
                <div class='linha'>
                    <div class='linha labels'>
                         Nome: 
                    </div>

                    <div class='linha'>
                        <input type='text' name="txtNome" class='inputs inputs-cad-usuario'  maxlength="50" required <?php echo($txtNome); ?>> 
                    </div>
                </div>

                <div class='linha labels'>
                    Mensagem: 
                </div>

                <div class='linha'>
                    <textarea name='txtComentario' required id='textarea-comentario'> </textarea>
                </div>
                
                <div class='linha'>
                    <input type='submit' name='btnSalvarComentario' id='btn-cad-comentario'  value="Adicionar novo comentário">
                </div>

            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['btnSalvarComentario'])){
        $nomeContato = $_POST['txtNome'];
        $comentario = trim($_POST['txtComentario']); // Remove espaços em branco
        $dataComentario = date('Y-m-d H:i:s');
        
        if(strlen($comentario) > 0){
            if($modo == "resp"){
                $nomeContato .= " (RESP. RA ".$ra.")";
            } else if($modo == "docente"){
                $nomeContato .= " (Docente)";
            }

            $sucesso = inserirComentario($nomeContato, $dataComentario, $_POST['txtComentario'], $idTurma, $idDisciplina);

            if(!$sucesso){
                header('location:erro.php');
            } else {
                echo('<script>');
                echo('alert("Comentário inserido com sucesso");');
                echo('window.location.href = "lista-aulas.php?' . $url . '";');
                echo('</script>'); 
            }
        } else {
            echo('<script>');
            echo('alert("Digite um comentario...");');
            echo('window.location.href = "lista-aulas.php?' . $url . '";');
            echo('</script>'); 
        }
    }
?>