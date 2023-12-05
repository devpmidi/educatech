<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);
    
    require_once('modulos/usuario.php');
    require_once('modulos/escola.php');

    /*Pesquisa usuario*/
    if(isset($_POST['btnPesquisaUsuario'])){
        $cpfBusca = $_POST['txtPesquisaCPF'];
        header("location:gerenciar-usuario.php?cpf=".$cpfBusca);
    }
    
    /*Excluir usuario*/
    if(isset($_GET['excluirUsuario'])){
        $idUsuario = $_GET['excluirUsuario'];
        $modo = $_GET['modo'];
        $erro = "1";
        
        if($modo == "docente"){
            $deletarDisciplinas = deletarDocenteDisciplina($idUsuario);
            if(!$deletarDisciplinas > 0){
                $erro = "2";
            } 
        }
        
        $sucessoDeletar = deletarUsuario($idUsuario);
        if(!$sucessoDeletar > 0){
            header("location:erro.php?erro=".$erro);
        } else {
            header("location:gerenciar-usuario.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Usuários do sistema </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
        
    </head>
    
    <script>
        
        function selecionarDisciplinas(){
            $('#opcoes-administrador').hide();
            $('#opcoes-professor').slideToggle("slow");
        }
              
        function selecionarNivelAdmin(){
            $('#opcoes-professor').hide();
            $('#opcoes-administrador').slideToggle("slow");
        }
        
        function alterarIcone(container){
            
            var img = document.querySelector("#header-admins");
            var src = img.getAttribute('src');
            
            if(src=="imagens/seta-para-baixo.png"){
                $('#container-admins').show();
                img.setAttribute('src', 'imagens/seta-para-cima.png');
            } else {
                $('#container-admins').hide();
                img.setAttribute('src', 'imagens/seta-para-baixo.png');
            }

        }
        
        function buscarUsuario(cpf){
            window.location="gerenciar-usuario.php?cpf=" + cpf;
        }
        
        function voltar(){
            window.location="gerenciar-usuario.php";
        }
        
        function deletarUsuario(idUsuario, tipo){
            var r=confirm("Deletar usuario?");
            if (r==true){
                window.location.href = "gerenciar-usuario.php?excluirUsuario=" + idUsuario + "&modo="+ tipo;
            } 
        }
        
    </script>
    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php') ?>
        </div>
        
        <div id='container-branco'>
            <div id='form-pesquisa-usuario'>
                <form name='formPesquisaUsuario' method='post'>
                    <div class='linha'>
                        <div class='coluna-03'> 
                            <p> Pesquisar professor (a) ou usuário (s):   </p>
                        </div>
                        
                        <div class='coluna-03'> 
                            <input type="search" name='txtPesquisaCPF' id='input-border-bottom' placeholder="Digite o CPF..." maxlength="11" required> 
                        </div>
                        <div class='coluna-01'>
                            <input type='submit' name='btnPesquisaUsuario' value="Buscar" id='btn-pesquisar'>
                        </div>
                        
                    </div>
                    
                </form>
                
            </div>

            <form name='editar-cadastrar-usuario' method="post"  id='form-dados-usuario'>
                
                <?php require_once('form-usuario.php') ?>
                
            </form>
            
            <div class='linha'>
                
                <div class='header-lista' onclick="alterarIcone('admins')">
                    <div class='coluna-09'>
                        Todos usuários
                    </div>

                    <div class='coluna-03 lista-icones'>
                        <img src='imagens/seta-para-cima.png'  id='header-admins'>
                    </div>
                </div>

                <div id='container-admins'>
                    <div class='linha'>
                        <div class='col-04-lista'>
                            <strong> CPF </strong>
                        </div>
                        
                        <div class='col-04-lista'>
                            <strong> NOME </strong>
                        </div>
                        
                        <div class='col-04-lista'>
                            <strong> TIPO </strong>
                        </div>
                        
                    </div>
                    <?php 
                        $lista = selecionarTodosUsuarios($idEscola);
                        while($rsUsuario = mysqli_fetch_array($lista)){ 
                            $rsCpffUsuario = $rsUsuario['cpfUsuario'];
                        ?>
                            
                            <div class='linha linha-usuario' onclick="buscarUsuario('<?php echo($rsCpffUsuario);?> ')">
                                <div class='col-04-lista'>
                                    <?php echo($rsCpffUsuario);?> 
                                </div>
                                
                                <div class='col-04-lista'>
                                    <?php echo($rsUsuario['nomeUsuario']);?> 
                                </div>
                                
                                <div class='col-04-lista'>
                                    <?php 
                                        if($rsUsuario['tipoUsuario'] == "docente"){
                                            echo("Docente");
                                        } else {
                                            echo("Administrador (a)");
                                        }
                                    
                                    ?>
                                </div>
                                
                            </div>
                    <?php } ?>     
                </div>

            </div>  
        </div>
        
    </body>
</html>

<?php 
    if(isset($_POST['btnFormUsuario'])){
        
        $nomeUsuario = $_POST['txtNomeUsuario'];
        $cpfUsuario = $_POST['txtCpfUsuario'];
        $emailUsuario = $_POST['txtEmailUsuario'];
        $loginUsuario = $_POST['txtLoginUsuario'];
        $senhaUsuario = $_POST['txtSenhaUsuario'];
        
        $tipoUsuario = $_POST['tipoUsuario'];
        
        if($tipoUsuario == ""){
            $nivelAdmin = $_POST['nivelAdmin'];
            
            if($nivelAdmin == 1){
                $tipoUsuario = "admin-nivel-1";
            } else if($nivelAdmin == 2){
                $tipoUsuario = "admin-nivel-2";
            } else {
                $tipoUsuario = "admin-nivel-3";
            } 
        }
        
        $modo = $_POST['btnFormUsuario'];

        if($modo == "Cadastrar"){
        
            /*Cadastro do usuario*/
            $sucessoCadastro = cadastrarUsuario($idEscola, $nomeUsuario, $cpfUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, $tipoUsuario);
            
            if($sucessoCadastro){
                if($tipoUsuario == "docente"){
                    $docente = selecionarUsuarioPorCPF($idEscola, $cpfUsuario);
                    $idDocente = $docente['idUsuario'];
                    
                    $listaDisciplinas = $_POST['disciplinas-professor'];
                    
                    if($listaDisciplinas != null){
                        /*Pega as disciplinas selecionadas do formulario*/
                        for($i =0; $i < sizeof($listaDisciplinas); $i++){
                            $idDisciplina = $listaDisciplinas[$i];
                            inserirFormacaoDocente($idDocente, $idDisciplina);
                        }
                    }
                } 
                
                echo('<script>');
                echo('alert("Usuário cadastrado!");');
                echo('window.location="gerenciar-usuario.php"');
                echo('</script>');
            } else {
                header('location:erro.php');
            }     
        } else {
            $idEditarUsuario = $_POST['idEditarUsuario'];
        
            $sucessoAlterarDados = editarUsuario($idEditarUsuario, $nomeUsuario, $cpfUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, $tipoUsuario);
            
            if($tipoUsuario == "docente"){
                
                if(isset($_POST['disciplinas-professor'])){
                    $listaDisciplinas = $_POST['disciplinas-professor'];
                    $disciplinasLecionadas = selecionarDisciplinasLecionadas($idEditarUsuario);


                    /*Verifica se teve alteração na marcação de uma disciplina que o professor leciona*/
                    if(!empty($disciplinasLecionadas)){
                        while($rsDisc = mysqli_fetch_array($disciplinasLecionadas)){

                            $discSelecionada = false;

                            /*Pega as disciplinas selecionadas do formulario*/
                            for($i =0; $i < sizeof($listaDisciplinas); $i++){
                                if($rsDisc['idDisciplina'] == $listaDisciplinas[$i]){
                                    $discSelecionada = true;
                                }

                            }

                            if(!$discSelecionada){
                                deletarDisciplinaDocente($idEditarUsuario, $rsDisc['idDisciplinba']);
                            }
                        }

                    }

                    /*Pega as disciplinas selecionadas do formulario para inserir*/
                    for($i =0; $i < sizeof($listaDisciplinas); $i++){
                        $idDisciplina = $listaDisciplinas[$i];
                        $discJaLecionada = false;

                        if(!empty($disciplinasLecionadas)){

                            while($rsDisc = mysqli_fetch_array($disciplinasLecionadas)){

                                $idDiscLecionada = $rsDisc['idDisciplina'];

                                if($idDisciplina == $idDiscLecionada){
                                    $discJaLecionada = true;
                                }
                            }
                        }

                        if(!$discJaLecionada){
                            inserirFormacaoDocente($idEditarUsuario, $idDisciplina);
                        }
                    }
                } else {
                    $deletarTodasDisciplinas = deletarDocenteDisciplina($idEditarUsuario);
                    
                    if(!$deletarTodasDisciplinas){
                        echo('<script>');
                        echo('alert("Erro ao excluir disciplinas lecionadas.");');
                        echo('window.location="gerenciar-usuario.php"');
                        echo('</script>');
                    } 
                }

            } 
            
            if($sucessoAlterarDados){
                echo('<script>');
                echo('alert("Dados alterados com sucesso!");');
                echo('window.location="gerenciar-usuario.php"');
                echo('</script>');
            } else {
                header('location:erro.php');
            }     
        }
    }
?>