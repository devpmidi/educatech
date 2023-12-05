<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech  </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'> </script>
        
    </head>

    <body>
        
        <div id='cabecalho'>
            <?php require_once('cabecalho-home.html') ?>
        </div>
        
        <div class='linha sessao-home'>
            
            <div class='coluna-07' id='sessao-home-introducao'>
                <div class='linha' id='sessao-home-titulo'>
                    GERENCIAMENTO ACADÊMICO PARA ENSINOS PÚBLICOS FUNDAMENTAL I E II
                </div>
                <div class='linha' id='sessao-home-desc'>
                    Acompanhe o cotidiano escolar do aluno nessa aplicação que permite a visualização do boletim escolar, agenda de tarefas, diário de classe e entre outras funcionalidades.  
                </div> 
                
                <div id='sessao-home-link'>
                    <a href='cadastrar-escola.php' target="_blank"> Desejo cadastrar minha escola! </a>
                </div>
            </div>
            
            <div class='coluna-05' id='sessao-home-img'>
                <img src='imagens/home.jpg'>
            </div>
            
        </div>
        
        <div id='sessao-home-conteudo'>
            
            <div class='linha' id='sessao-home-conteudo-titulo'>
                Conheça os beneficíos de utilizar o sistema:
            </div>
            
            <div class='linha'>
                <div class='coluna-06' id='sessao-home-info-img'>
                    <img src='imagens/Educac-o.jpeg'> 
                </div>

                <div class='coluna-06' id='sessao-home-info'>
                    <strong> Uma comunicação eficiente, que integra pais, alunos, escola e professores, é essencial para instituições de ensino e ajuda a garantir que os alunos tenham um desempenho melhor! </strong>
                    <p> Ao mesmo tempo em que simplifica e otimiza o trabalho do gestor escolar, o sistema  permite que professores tenham uma noção mais profunda e individualizada de cada aluno. Além de poder lançar faltas e notas,  registrar a matéria da aula no diário online e disponibilizar tarefas, o professor pode acompanhar o desempenho dos seus alunos individualmente, por disciplina ou turma, o que melhora o direcionamento dos conteúdos abordados em sala de aula. </p>
                </div>
            </div>
        </div>
        
        <div id='rodape'>
            <?php require_once('rodape-home.html') ?>
        </div>
    </body>
</html>