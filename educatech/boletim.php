<?php 
     require_once('modulos/media.php');
     require_once('modulos/turma.php');
     $listaDisciplinas = selecionarDisciplinasGerais();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/stylecard.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <title>Boletim</title>
    </head>
    <style>
        .disc{
            background: #6b5b90;
            width: 80%;
            min-height:  60px;
            overflow: auto;
            border: none;
            border-radius: 10px;
            padding: 15px;
            color: #f0ffffde;
            font-size: 12pt;
            box-shadow: 0px 10px 40px #00000056;
            box-sizing: border-box;
            margin-bottom: 35px;
            margin-left: auto;
            margin-right: auto;
        }
        
        h2{
            text-align: center;
            color: #f0ffffde;
            font-size: 26pt;
        }
        
        .coluna-03{
            width: 25%;
            float: left;
            word-wrap: break-word;
            text-align: center;
        }

    </style>

    <body>
        
        <?php require_once('cabecalho-aluno.php') ?>
        
        <h2>Nota Parcial</h2> <br>
        
    <?php 
        while($rsDisc = mysqli_fetch_array($listaDisciplinas)){ ?>
            <div class="disc">
                <h1> <?php echo($rsDisc['nomeDisciplina']); ?> </h1>
                <?php 
                    $idDisciplina = $rsDisc['idDisciplina'];
                    $idTurma = $dadosAluno['idTurma'];
                    $raAluno = $dadosAluno['raAluno'];
                    $boletim = verificarBoletim($idDisciplina, $idTurma, $raAluno);
                    
                    if(!mysqli_num_rows($boletim) == 0){ 
                        
                        while($rsBoletim = mysqli_fetch_array($boletim)){ ?>
                            <div class='coluna-03'>
                                <?php echo($rsBoletim['cicloBoletim']."º ciclo: ".$rsBoletim['nota']); ?>
                            </div>
                
                    <?php   } 
                        
                    } else {
                        echo("<p> Nenhuma nota foi lançada para essa disciplina. </p>");
                    }
                ?>
                
            </div>
    <?php  
        }
    ?>

    </body>
</html>