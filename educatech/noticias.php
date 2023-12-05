<?php
    require_once('modulos/cardapio-noticia.php');
    
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Notícias da Escola</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/noticias.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    </head>

    <body id='body-fundo-escuro'>

        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php') ?>
        </div>

        <header> <h1>Mural de noticias </h1> </header>
        <main>
            <section class="news-section">

                <?php
                    $lista = selecionarNoticias($idEscola);
                    if(!mysqli_num_rows($lista) == 0){
                        while($noticia = mysqli_fetch_array($lista)){ ?>
                            
                            <article class="news-item">
                                <h3> <?php 
                                        $dt = date("d/m/Y", strtotime(str_replace('-','/',$noticia['dataNoticia'])));
                            
                                        $text = $dt." ".$noticia['tituloNoticia'];
                                        echo($text); 
                                    ?>
                                </h3>
                                <p><?php echo($noticia['descNoticia']); ?></p>
                            </article>
            <?php  
                    }
                } else {
                    echo("<div class='linha'>");
                    echo("Nenhum cadastro encontrado.");
                    echo("</div>");
                }
            ?>
            </section>
          </main>
    </body>
</html>
