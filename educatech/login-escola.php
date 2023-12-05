<?php 
    require_once('modulos/usuario.php');
    require_once('modulos/escola.php');
    
    if(isset($_POST['btnLogin'])){
        $idEscola = $_POST['selectEscola'];
        $loginUsuario = $_POST['txtLogin'];
        $senhaUsuario = $_POST['txtSenha'];
        
        $usuarioLogado = autenticarUsuario($idEscola, $loginUsuario, $senhaUsuario);
            
        if($usuarioLogado != null){
            session_start();
            $_SESSION['usuario'] = $usuarioLogado;
            
            if($usuarioLogado['tipoUsuario'] == "docente"){
                $_SESSION['modo'] = "docente";
                header('location:area-do-professor.php');
            } else {
                header('location:area-do-admin.php');
            } 
        } else {
            header('location:login-escola.php?erro=1');
        }
    }    
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Login area da escola</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
	   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
    </head>
    
    <script>
        function esconderDiv(){
            window.location="login-escola.php";
        }
    </script>
    
    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
             <div id="container-cabecalho">
                <div class='coluna-01' id='cabecalho-img'>
                    <img src='imagens/icons8-escola-40.png'>
                </div>
                <div class='coluna-05' id='cabecalho-titulo'>
                    EducaTech
                </div>
             </div>
        </div>
        
        <div id='container-admin'>
            <form name='formLoginEscola' method="post">
                <div class='linha'>
                    <div id='coluna-admin-icone'>
                        <img src='imagens/icone-login.png'> 
                    </div>

                    <div id='coluna-admin-titulo'>
                        Acessar sistema
                    </div>
                </div>

                <div class='linha labels'>
                    <label for='selectEscola'> Escola: </label>
                </div>

                <div class='linha'>
                    <select id='select-escola' required name='selectEscola'>
                        <option value="" disabled selected> Selecione </option>
            			<?php 
            				$lista = selecionarTodasEscolas();
            				while($escola = mysqli_fetch_array($lista)){ ?>
            					<option value="<?php echo($escola['idEscola']); ?>"> <?php echo($escola['nomeEscola']); ?>  </option>
            			<?php } ?>
                
                    </select>
                </div>
                
                <div class='linha labels'>
                    <label for='txtLogin'> Login: </label>
                </div>

                <div class='linha'>     
                    <input type='text' name='txtLogin' class='inputs inputs-cad-usuario'  maxlength="20"> 
                </div>

                <div class='linha labels'>
                    <label for='txtSenha'> Senha: </label>
                </div>

                <div class='linha'>     
                    <input type='password' name='txtSenha' class='inputs inputs-cad-usuario'  maxlength="20"> 
                </div>
                
                <div class='linha'>
                    <input type='submit' name='btnLogin' class='btn-cad-escola'  value="Enviar">
                </div>
            </form>
            
            <?php   
                if(isset($_GET['erro'])){
                    $span = "<span class='closebtn' onclick='esconderDiv()'>&times;</span>";
                    echo("<div class='linha' id='erro-login'>");
                    echo($span);
                    echo("Login ou senha incorreta. ");
                    echo("</div>");
                } 
            ?>    
        </div>
    </body>
</html>