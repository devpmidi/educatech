<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);

    require_once('modulos/aluno.php');
    
    if(isset($_POST['btnLoginAluno'])){
        $ra = $_POST['ra'];
        $dtNascimento = date("Y-m-d", strtotime(str_replace('/','-',$_POST['dtNascimento']))); 
        
        $alunoLogado = autenticarAluno($ra, $dtNascimento);
            
        if($alunoLogado != null){
            session_start();
            $_SESSION['aluno'] = $alunoLogado;
            header('location:escolha.html');
        } else {
            header('location:login-aluno.php?erro=1');
        }
    }    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-area-aluno.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="js/jquery.min.js"></script>
    </head>
    
    <script>
        function esconderDiv(){
            window.location="login-aluno.php";
        }
        
        function mascaraData(val) {
          var pass = val.value;
          var expr = /[0123456789]/;

          for (i = 0; i < pass.length; i++) {
            // charAt -> retorna o caractere posicionado no índice especificado
            var lchar = val.value.charAt(i);
            var nchar = val.value.charAt(i + 1);

            if (i == 0) {
              // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
              // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
              // instStr.search(expReg);
              if ((lchar.search(expr) != 0) || (lchar > 3)) {
                val.value = "";
              }

            } else if (i == 1) {

              if (lchar.search(expr) != 0) {
                // substring(indice1,indice2)
                // indice1, indice2 -> será usado para delimitar a string
                var tst1 = val.value.substring(0, (i));
                val.value = tst1;
                continue;
              }

              if ((nchar != '/') && (nchar != '')) {
                var tst1 = val.value.substring(0, (i) + 1);

                if (nchar.search(expr) != 0)
                  var tst2 = val.value.substring(i + 2, pass.length);
                else
                  var tst2 = val.value.substring(i + 1, pass.length);

                val.value = tst1 + '/' + tst2;
              }

            } else if (i == 4) {

              if (lchar.search(expr) != 0) {
                var tst1 = val.value.substring(0, (i));
                val.value = tst1;
                continue;
              }

              if ((nchar != '/') && (nchar != '')) {
                var tst1 = val.value.substring(0, (i) + 1);

                if (nchar.search(expr) != 0)
                  var tst2 = val.value.substring(i + 2, pass.length);
                else
                  var tst2 = val.value.substring(i + 1, pass.length);

                val.value = tst1 + '/' + tst2;
              }
            }

            if (i >= 6) {
              if (lchar.search(expr) != 0) {
                var tst1 = val.value.substring(0, (i));
                val.value = tst1;
              }
            }
          }

          if (pass.length > 10)
            val.value = val.value.substring(0, 10);
          return true;
        }
        
    </script>
    
    <body>
        <div class="main-login">
            <div class="left-login">

                <img src="logo.png" class="left-login-image" alt="estudando">
            </div>
            <div class="right-login">
                <div class="card-login">
                    <form name='formLoginAluno' method="post">
                        <p id='header-login'>LOGIN</p>
                        <div class="textfield">
                            <label for="ra">R.A:</label>
                            <input type="text" name="ra" placeholder="0000000" maxlength="7" required>
                        </div>
                        <div class="textfield">
                            <label for="dtNascimento">Data de nascimento:</label>
                            <input type="text" name="dtNascimento" placeholder="00/00/0000" maxlength="10" onkeypress="mascaraData(this)" required>
                        </div>
                        <button name='btnLoginAluno' type='submit' class="btn-login">Entrar</button>
                        
                        <?php   
                            if(isset($_GET['erro'])){
                                $span = "<span class='closebtn' onclick='esconderDiv()'>&times;</span>";
                                echo("<div class='linha' id='erro-login'>");
                                echo($span);
                                echo("Não foi possível efetuar o login. ");
                                echo("</div>");
                            } 
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>