<?php
    require_once('modulos/cardapio-noticia.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/stylecard.css">
    <title>Cardápio</title>
</head>
    
<style>
    #view-cardapio{
        width: 80%;
        min-height: 100px;
        overflow: auto;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 80px;
    }
    
    #view-cardapio img{
        width: 100%;
    }
    
    h2{
        text-align: center;
        color: #13cecede;
        font-size: 30pt;
    }
    
    #linha{
        width: 60%;
        min-height: 35px;
        padding: 25px;
        background-color: #dcdcdc;
        font-size: 20px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 8px;
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
    
    <h2>CARDÁPIO</h2>
    
    <?php
        $cardapio = selecionarCardapio($dadosAluno['idEscola']);
        if($cardapio != null){ ?>
            <div id='view-cardapio'>
                <img src='img-cardapio/<?php echo($cardapio['imgCardapio']); ?>'>
            </div>
        <?php
        } else { ?>
            <div id='linha'>
                O servidor não possui um cardápio de refeições disponível, entre em contato com a escola para mais informações.
            </div>
        <?php
        }
    ?>
    <footer>
        <p>&copy; 2023 Cardápio escolar</p>
    </footer>
</body>
</html>