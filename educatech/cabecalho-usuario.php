<div id = "container-cabecalho">
    <div class='coluna-01' id='cabecalho-img'>
        <img src='imagens/icons8-escola-40.png'>
    </div>
    <div class='coluna-05' id='cabecalho-titulo'>
        EducaTech
    </div>
            
    <div class='coluna-01 cabecalho-icones'>
        <img src='imagens/usuario.png'>
    </div>
    
    <div class='coluna-03' id='cabecalho-nome-usuario'>
        <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $idEscola = 0;

            if(isset($_SESSION['usuario'])){
                $usuario = $_SESSION['usuario'];
                $idEscola = $usuario['idEscola']; 
                echo($usuario['nomeUsuario']);
                
            } else if(isset($_SESSION['aluno'])){
                $aluno = $_SESSION['aluno'];
                $idEscola = $aluno['idEscola'];
                echo($aluno['nomeAluno']);
                
            } else {
                header('location:index.php');
            }
        
            $_SESSION['idEscola'] = $idEscola;
        ?>
    </div>
    
    <div class='coluna-01 cabecalho-icones'>
        <img src='imagens/sair.png' title='Sair' id='sair-sistema'>
    </div>
    
    <div class='coluna-01'>
        <a href="sair-sistema.php" class="cabecalho-rodape-links"> Sair </a>
    </div>
    
</div>