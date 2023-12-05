<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);

    require_once('modulos/usuario.php');
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
        $dadosDocente = consultarDadosDocente($usuario['idUsuario']);
    } else {
        header('location:index.php');
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
        <title>Área Professor</title>
    </head>

    <style> 
        .row {
            display: flex;
            min-height: 50px;
            overflow: auto;
            justify-content: center;
            align-items: center;
        }

        .card {
            justify-content: center;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 10px 40px -12px #00ff8052;
            padding: 30px;
            margin: 20px;
            width: 400px;
            transition: all 0.3s ease-out;
        }

        .card a{
            text-decoration: none;
        }

        a { 
            color: #000000;
        } 

        a:active {
            color: rgb(0, 0, 0);
        }
        .card:hover {
            background-color: #ffffff;
            transform: translateY(-5px);
            cursor: pointer;
        }

        .green {
            border-left: 6px solid #3bb54a;
        }

        .pink{
            border-left: 6px solid #f359b5;
        }
        
        .image {
            float: right;
            max-width: 70px;
            max-height: 70px;
        }
    </style>
    <body>
          <div class="info">
            <img src="imagemusuario.png" alt="Foto usuario"  height="150" width="150">
            <br> PROFESSOR(A): <?php echo($dadosDocente['nomeUsuario']); ?> <br> ESCOLA: <?php echo($dadosDocente['nomeEscola']."   -   Tel.: ".$dadosDocente['telefoneEscola']); ?>
          <br> <?php echo($dadosDocente['enderecoEscola']); ?>
          </div>

        <div class="row">
            <div class="card green">
              <a href="turmas-do-professor.php" target='_blank'><h2>Turmas</h2></a>
              <p>Turmas</p>
              <img class="image" src="turmas.svg" alt="disciplinas" />
            </div>


            <div class="card pink">
              <a href="noticias.php" target='_blank'><h2>Notícias</h2></a>
              <p>Notícias</p>
              <img class="image" src="news.svg" alt="news" />
            </div>
          </div>

    </body>
</html>