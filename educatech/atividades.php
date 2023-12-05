<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);

    require_once('modulos/turma.php');

    if(isset($_GET['idTurma'])){
        $idTurma = $_GET['idTurma'];
    } else {
        header('location:index.php');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Atividades</title>
    <link rel="stylesheet" href="css/atividades.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    </head>
    
    <style>
        body {
          margin: 0;
          padding: 0;
          font-family: 'Noto Sans', sans-serif;
          background-color: #cfc2ef;
        }

        header {
          background-color: #6f427b;
          color: #fff;
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 10px 20px;
        }

        h1 {
          margin: 0;
          font-size: 28px;
        }

        nav ul {
          list-style: none;
          margin: 0;
          padding: 0;
          display: flex;
        }

        nav li {
          margin: 0 10px;
        }

        nav a {
          color: #fff;
          text-decoration: none;
          font-weight: bold;
        }

        main {
          max-width: 900px;
          margin: 0 auto;
          padding: 20px;
          background-color: #cfc2ef;
        }

        h2 {
          margin: 0;
          font-size: 24px;
          margin-bottom: 10px;
          color: #000;
          background-color: #54df89;
          border: none;
          border-radius: 10px;
          padding: 20px;
        }

        h3 {
          margin: 0;
          font-size: 20px;
          margin-bottom: 10px;
          color: #ffffff;
          border-radius: 10px;
        }

        p {
          margin: 0;
          font-size: 18px;
          margin-bottom: 10px;
          color: #000000;
          border: none;
          border-radius: 10px;

        }

        .data-entrega {
          color: #ffffff;
          font-size: 10px;
        }

        .atividades-list {
          list-style: none;
          margin-bottom: 20px;
          padding: 0;
        }

        .atividade-header {
          padding: 8px;
          border: none;
          border-radius: 10px;
          background-color: #6f427b;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .data-entrega {
          font-size: 14px;
          font-style: italic;
        }

        nav ul li:hover {
          background-color: #00ff88;
          text-decoration: none;
          border-bottom: 2px solid transparent;
          transition: border-bottom 0.3s ease;
        }

        nav ul li:hover a {
          color: #000;
          border-bottom: 2px solid #00ff88;
        }

    </style>
    
    <body>
        <header>
          <h1>Atividades</h1>
          <nav>
            <ul>
              <li><a href="area-do-aluno.php">Voltar</a></li>
              <li><a href="sair-sistema.php">Sair</a></li>
            </ul>
          </nav>
        </header>

        <main>
          <section>
            <h2>Atividades em Aberto</h2>
            <ul class="atividades-list">
                <br>

                <?php 
                    $tarefasEmAberto= selecionarTarefasEmAberto($idTurma);

                    if(!mysqli_num_rows($tarefasEmAberto) == 0){
                        while($rsTarefa = mysqli_fetch_array($tarefasEmAberto)){
                            $dt = date("d/m/Y", strtotime(str_replace('-','/',$rsTarefa['dataTarefa'])));
                ?>
                            <li>
                                <div class="atividade-header">
                                  <h3>Atividade de <?php echo($rsTarefa['nomeDisciplina']); ?></h3>
                                  <span class="data-entrega">Entrega até <?php echo($dt); ?></span>
                                </div>
                                <p><?php echo($rsTarefa['descTarefa']); ?></p>
                            </li> <br>
                 <?php  }
                    } else {
                        echo("Nenhum registro.");  
                    }
                ?>
            </ul>
          </section>
          <br>
          <section>
            <h2>Atividades Concluídas </h2>
            <ul class="atividades-list">
              <?php 
                    $tarefasVencidas= selecionarTarefasVencidas($idTurma);

                    if(!mysqli_num_rows($tarefasVencidas) == 0){
                        while($rsTarefa = mysqli_fetch_array($tarefasVencidas)){
                            $dt = date("d/m/Y", strtotime(str_replace('-','/',$rsTarefa['dataTarefa'])));
                ?>
                            <br>
                            <li>
                                <div class="atividade-header">
                                  <h3>Atividade de <?php echo($rsTarefa['nomeDisciplina']); ?></h3>
                                  <span class="data-entrega">Venceu em <?php echo($dt); ?></span>
                                </div>
                                <p><?php echo($rsTarefa['descTarefa']); ?></p>
                            </li> <br> 
                 <?php  }
                    } else {
                        echo("Nenhum registro.");  
                    }
                ?>
            </ul>
          </section>
        </main>
    </body>
</html>
