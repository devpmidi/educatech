<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);
    require_once('modulos/usuario.php'); 
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Minhas turmas </title>
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
            <div class='linha header-titulo'>
                Turmas lecionadas
            </div>
            
            <?php 
                $lista = selecionarTurmasLecionadas($usuario['idUsuario']);
                $listaFund = verificarTurmaLecionadaFund($usuario['idUsuario']);
                
                if(!mysqli_num_rows($listaFund) == 0){
                    $turma = mysqli_fetch_array($listaFund);
                    $text = $turma['ciclo']."º ";
                    $text .= $turma['turma'];
                    $url= "idTurma=".$turma['idTurma'];
                    $url .= "&disc=FUNDAMENTAL";
                    $url .= "&cod=1"; ?>
                    
                    <div class='linha linha-borda-prof'>
                        <div class='col-lista-prof'>
                            <a href='lista-aulas.php?<?php echo($url); ?>' class='link-azul'>
                                <?php echo($text); ?>
                            </a>
                        </div>

                        <div class='col-10-lista'>
                            <strong> Ensino fundamental  </strong> 
                        </div>
                    </div>
               <?php } else if(!mysqli_num_rows($lista) == 0){

                    while($turma = mysqli_fetch_array($lista)){ 
                        $text = $turma['ciclo']."º ";
                        $text .= $turma['turma'];
                        $url= "idTurma=".$turma['idTurma'];
                        $url .= "&disc=".$turma['nomeDisciplina'];
                        $url .= "&cod=".$turma['idDisciplina'];
            ?>
                        <div class='linha linha-borda-prof'>
                            <div class='col-lista-prof'>
                                <a href='lista-aulas.php?<?php echo($url); ?>' class='link-azul'>
                                    <?php echo($text); ?>
                                </a>
                            </div>

                            <div class='col-10-lista'>
                                <strong> Disciplina:  </strong> <?php echo($turma['nomeDisciplina']); ?>
                            </div>
                        </div>
            <?php  
                    }
                } else {
                    echo("<div class='linha'>");
                    echo("Nenhum cadastro encontrado.");
                    echo("</div>");
                }
            ?>
        </div>
    </body>
</html> 