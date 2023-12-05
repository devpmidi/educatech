<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['usuario'])){
        $admin = $_SESSION['usuario'];

    } else {
        header('location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Gerenciamento do sistema </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
    </head>
    <body id='body-fundo-escuro'>
        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php') ?>
        </div>
        <div id='container-admin'>
            <div class='linha'>
                <div id='coluna-admin-icone'>
                    <img src='imagens//home-admin.png'> 
                </div>
                <div id='coluna-admin-titulo'>
                    Menu de navegação
                </div>
            </div>
            
            <?php 
                if($admin['tipoUsuario'] == "admin-nivel-3"){ ?>
                    <div class='linha-menu-admin opcoes-menu-admin'>
                        <a href='form-escola.php' target='_blank'> Dados da escola </a>
                    </div>
            
                    <div class='linha-menu-admin opcoes-menu-admin'>
                        <a href='lista-turmas.php' target='_blank'> Gerenciar turmas </a>
                    </div>
                    
            <?php  }
            
                if($admin['tipoUsuario'] == "admin-nivel-3" || $admin['tipoUsuario'] == "admin-nivel-1"){ ?>
                    <div class='linha-menu-admin opcoes-menu-admin'>
                        <a href='cardapio-noticias.php' target='_blank'> Gerenciar cardápio e noticias </a>
                    </div>
            <?php  }
            
                if($admin['tipoUsuario'] == "admin-nivel-3" || $admin['tipoUsuario'] == "admin-nivel-2"){ ?>
                    <div class='linha-menu-admin opcoes-menu-admin'>
                        <a href='gerenciar-usuario.php' target='_blank'> Gerenciar usuários (as) e professores (as) </a>
                    </div>

                    <div class='linha-menu-admin opcoes-menu-admin'>
                        <a href='aluno.php' target='_blank'> Gerenciar alunos (as) </a>
                    </div>
            
                    <div class='linha-menu-admin opcoes-menu-admin'>
                        <a href='manual-admin.php' target='_blank'> Manual de instruções </a>
                    </div>
            <?php  } ?>
            

            <div class='linha-menu-admin' id='opcao-sair-admin'>
                <a href='sair-sistema.php'> Sair do sistema </a>
            </div>
        </div>
    </body>
</html>