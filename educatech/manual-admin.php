<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Tutorial do sistema </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
    </head>
    
    <script> 
         function alterarIcone(container, idImg){
            
            var img = document.querySelector(idImg);
            var src = img.getAttribute('src');
            
            if(src=="imagens/seta-para-baixo.png"){
                $(container).show();
                img.setAttribute('src', 'imagens/seta-para-cima.png');
            } else {
                $(container).hide();
                img.setAttribute('src', 'imagens/seta-para-baixo.png');
            }

        }
    
    </script>
    <body id='body-fundo-escuro'>
        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php'); ?>
        </div>
        <div id='container-branco'>
            <div class='linha' id='header-manual'>
                Manual de instruções
            </div>
            
            <div class='linha'>
                <div class='header-lista' onclick="alterarIcone('#manual-docentes', '#header-docentes')">
                    <div class='coluna-09'>
                        Cadastro e edição de docentes ou administradores do sistema. 
                    </div>

                    <div class='coluna-03 lista-icones'>
                        <img src='imagens/seta-para-cima.png'  id='header-docentes'>
                    </div>
                </div>    
                
                <div id='manual-docentes'>
                    <embed src="manual/gerenciar-usuarios.pdf" type="application/pdf" width="100%" height="600px">
                </div>
            </div>
            
            <div class='linha'>
                <div class='header-lista' onclick="alterarIcone('#manual-turmas', '#header-turmas')">
                    <div class='coluna-09'>
                        Cadastro e edição de turmas
                    </div>

                    <div class='coluna-03 lista-icones'>
                        <img src='imagens/seta-para-baixo.png'  id='header-turmas'>
                    </div>
                </div>    
                
                <div id='manual-turmas'>
                    <embed src="manual/gerenciar-turmas.pdf" type="application/pdf" width="100%" height="600px">
                </div>
            </div>
        </div>
    </body>
</html>