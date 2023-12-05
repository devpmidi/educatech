<?php 
    date_default_timezone_set('America/Sao_Paulo');
    require_once('modulos/aluno.php');
    require_once('modulos/aula.php');

    $data = date('Y-m-d');
    $idTurma = $_GET['idTurma'];
    $idDisciplina = $_GET['cod'];
    $nomeDisciplina = $_GET['disc'];

    $url= "'lista-aulas.php?idTurma=".$idTurma;
    $url .= "&disc=".$nomeDisciplina;
    $url .= "&modo=docente";
    $url .= "&cod=".$idDisciplina."'";
    
    $titulo = "Disciplina de ".$nomeDisciplina.": Aula ".date('d/m/Y');
    
    /*Verifica se tem alunos cadastrados na turma*/
    $listaAlunos = consultarAlunosPorTurma($idTurma);
    if(mysqli_num_rows($listaAlunos) == 0){
        echo('<script>');
        echo('alert("Não tem alunos cadastrados na turma. ");');
        echo('window.location="area-do-professor.php"');
        echo('</script>');
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Nova aula </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'> </script>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    </head>
    
    <script>
        
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

    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
            <?php 
                require_once('cabecalho-usuario.php');
                /*Verifica se ja tem aula registrada na data atual*/
                $verificarData = buscarAulaPelaData(date('Y-m-d'), $usuario['idUsuario'], $idDisciplina, $idTurma);
                if(mysqli_num_rows($verificarData) != 0){
                    echo('<script>');
                    echo('alert("Já tem registro de aula na data de hoje.");');
                    echo('window.location="area-do-professor.php"');
                    echo('</script>');
                } 
                    
            ?>
        </div>
        
        <div id='container-branco'>
            <form name='formCadAula' method="post">
                <div class='linha header-titulo'>
                    <?php echo($titulo);?>
                </div>
                
                <div class='linha'>
                    <a href='area-do-professor.php' class='link-aula'>
                        Página Inicial
                    </a>
                </div>
                
                <div class='linha labels'>
                    <label for='txtResumoAula'> Resumo da aula: </label>
                </div>
                
                <div class='linha'>
                    <textarea name='txtResumoAula' class='textarea' required="required"> </textarea>
                </div>
                
                <div class='linha labels'>
                    <label for='txtTarefa'> Tarefa (opcional): </label>
                </div>
                
                <div class='linha'>
                    <textarea name='txtTarefa' class='textarea'> </textarea>
                </div>
                
                <div class='linha labels'>
                    <label for='dataTarefa'> Data de vencimento da tarefa: </label>
                </div>
                
                <div class='linha'>
                    <input type='text' name='dataTarefa' class='inputs inputs-cad-aluno'  maxlength="10" onkeypress="mascaraData(this)"> 
                </div>
                
                <div class='linha' id='header-tabela-presenca'>
                    Lista de presença
                </div>

                <div id='lista-presenca'>
                    <?php 
                        while($rsAluno = mysqli_fetch_array($listaAlunos)){ 
                            $ra = $rsAluno['raAluno'];
                            ?>
                            <div class='linha-tabela-aluno'>
                                <div class='coluna-04'>
                                    <strong> <?php echo($ra); ?> </strong>
                                </div>

                                <div class='coluna-06'>
                                    <?php echo($rsAluno['nomeAluno']); ?>
                                </div>

                                <div class='coluna-02'>
                                    <input type='checkbox' name="presenca-aluno[]" value="<?php echo($ra); ?>">
                                    <span class="checkmark"></span>
                                </div>
                            </div> 
                    <?php   }  ?>
                      
                </div>
                
                <div class='linha'>
                    <input type='submit' name='btnSalvar' class='btn-cad-escola'  value="Salvar dados">
                </div>
            </form>        
        </div>
        
    </body>
</html>

<?php 
    if(isset($_POST['btnSalvar'])){
        $resumo = trim($_POST['txtResumoAula']); // Remove espaços em branco
        
        // Compara se a string esta vazia
        if(strlen($resumo) > 0){
            
            $resumo = $_POST['txtResumoAula'];
            /*Cadastro da aula*/
            $idAula = registrarAula($resumo, $data, $idTurma, $usuario['idUsuario'], $idDisciplina);

            if($idAula > 0){
               
                $tarefa = trim($_POST['txtTarefa']);
                $sucessoTarefa = true;
                
                // Compara se a string esta vazia
                if(strlen($tarefa) > 0){
                    $tarefa = $_POST['txtTarefa'];
                    $dt = $_POST['dataTarefa'];
                    $dataTarefa = date("Y-m-d", strtotime(str_replace('/','-',$dt)));

                    /*Cadastro da tarefa*/
                    $sucessoTarefa = registrarTarefa($idAula, $idTurma, $tarefa, $dataTarefa);
                }
                
                /*Lista de presenca*/
                $sucessoChamada = true;
                if(isset($_POST['presenca-aluno'])){
                    $chamadaAlunos = $_POST['presenca-aluno'];
                    
                    for($i = 0; $i < count($chamadaAlunos); $i++){
                        $raAluno = $chamadaAlunos[$i];
                        $sucessoChamada = registrarPresenca($idAula, $raAluno);
                    }
                    
                }

                if(!$sucessoTarefa || !$sucessoChamada){
                    header('location:erro.php');
                } else {
                    echo('<script>');
                    echo('alert("Dados salvos com sucesso!");');
                    echo('window.location='.$url);
                    echo('</script>');
                }
    
            } else {
                header('location:erro.php');
            }
        } 
    }
?>
