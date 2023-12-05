<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_GET['modo'])){
        $_SESSION['modo'] = $_GET['modo'];
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/stylecard.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <title>Área Aluno</title>
    </head>
    
    <style>
        h1{
            color: #ffffff;
            position: absolute;
            top: 170px;
            left: 40%;
        }
        
        .row {
            min-height: 200px;
            overflow: auto;
            justify-content: center;
            align-items: center;
            margin-top: 70px;
            width: 100%;
        }

        .card {
            justify-content: center;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 10px 40px -12px #00ff8052;
            margin-left: 2%;
            width: 16%;
            transition: all 0.3s ease-out;
            height: 200px;
            float: left;
            padding-left: 15px;
        }

        .card a{
            text-decoration: none;
        }

        .card:hover {
            background-color: #ffffff;
            transform: translateY(-5px);
            cursor: pointer;
        }

        .card p {
            color: #000000;
            font-size: 16px;
        }

        .image {
            float: right;
            max-width: 70px;
            max-height: 70px;
        }

        .blue {
            border-left: 6px solid #4895ff;
        }

        .green {
            border-left: 6px solid #3bb54a;
        }

        .red {
            border-left: 6px solid #b3404a;
        }

        .pink{
            border-left: 6px solid #f359b5;
        }

        .orange{
            border-left: 6px solid #f38435;
        }
        
        a { 
          color: currentColor;
        } 

        a:link, a:visited, a:hover {
          color: #000000;
        }

        a:active {
           color: rgb(0, 0, 0);
        }
        
        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            .card {
                float: none;
                width: 80%;
                height: 150px;
                margin-bottom: 40px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .card h2{
                font-size: 20px;
            }
            
            .card p {
                display: none;
            }
            
            .image {
                float: right;
                max-width: 100px;
                max-height: 100px;
            }
        }
    </style>
    <body>
        <?php require_once('cabecalho-aluno.php') ?>
        
        <div class="row">
            <div class="card green">
              <a href="atividades.php?idTurma=<?php echo($idTurma); ?>"><h2>Atividades</h2></a>
              <p>Atividades</p>
              <img class="image" src="atividades.svg" alt="atividades" />
            </div>

            <div class="card orange">
              <a href="disciplinas.php"><h2>Disciplinas</h2></a>
              <p>Disciplinas</p>
              <img class="image" src="disciplinas.svg" alt="disciplinas" />
            </div>

            <div class="card blue">
              <a href="cardapio.php"><h2>Cardapio</h2></a>
              <p>Cardapio</p>
              <img class="image" src="cardapio.svg" alt="cardapio" />
            </div>

            <div class="card red">
              <a href="boletim.php" target="_blank"> <h2>Boletim</h2> </a>
              <p>Boletim</p>
              <img class="image" src="boletim.svg" alt="boletim" />

            </div>

            <div class="card pink">
              <a href="noticias.php" target='_blank'><h2>Notícias</h2></a>
              <p>Notícias</p>
              <img class="image" src="news.svg" alt="news" />
            </div>
          </div>

    </body>
</html>