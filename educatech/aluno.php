<?php 
    require_once('modulos/turma.php');
    require_once('modulos/aluno.php');
    
    $idTurmaAluno = 0;
    $rsAluno = null;
    $valueBtn = "Salvar dados";
    
    /*Pesquisa aluno*/
    if(isset($_POST['btnPesquisaAluno'])){
        $raAluno = $_POST['txtPesquisaRA'];
        header("location:aluno.php?ra=".$raAluno);
    }
    
    if(isset($_GET['ra'])){
        $raAluno = $_GET['ra'];
        $rsAluno = buscarAlunoPorRA($raAluno);

        if(!$rsAluno == null){
            $idTurmaAluno = $rsAluno['idTurma'];
            $valueBtn = "Salvar alterações";
            $dataSemFormato = $rsAluno['dataNascimento'];
            $rsDt = date("d/m/Y", strtotime(str_replace('-','/',$dataSemFormato))); 
    
            
        } else {
            echo('<script>');
            echo('alert("Aluno não localizado!");');
            echo('window.location="aluno.php"');
            echo('</script>');
        }
    }
    
    /*Excluir aluno*/
    if(isset($_GET['excluir'])){
        $raExcluir = $_GET['excluir'];
        
        deletarAluno($raExcluir);
        echo('<script>');
        echo('alert("Aluno deletado com sucesso!");');
        echo('window.location="aluno.php"');
        echo('</script>');
    }
    
    if(isset($_POST['btnCadAluno'])){
        $nomeAluno = $_POST['txtNomeAluno'];
        $dt = $_POST['txtDataNascimento'];
        $dataNascimento = date("Y-m-d", strtotime(str_replace('/','-',$dt))); 
        
        $idTurmaCad = $_POST['turmaAluno']; 
        
        /*Cadastrar*/
        if($valueBtn == "Salvar dados"){
            $raCad = $_POST['txtRA'];
             /**  Verifica se o R.A já existe no banco de dados **/
            $existeRA = buscarAlunoPorRA($raCad);

            if($existeRA == null){
                $sucessoCad = inserirAluno($raCad, $nomeAluno, $dataNascimento, $idTurmaCad);

                if($sucessoCad){
                    echo('<script>');
                    echo('alert("Aluno cadastrado!");');
                    echo('window.location="aluno.php"');
                    echo('</script>');
                }
            } else {
                echo('<script>');
                echo('alert("RA já cadastrado!");');
                echo('</script>');
            }
        } else {
            $raCad = $_GET['ra'];
            /*Editar dados*/
            $sucessoAlterar = editarDadosAluno($raCad, $nomeAluno, $dataNascimento, $idTurmaCad);

            if($sucessoAlterar){
                echo('<script>');
                echo('alert("Dados alterados!");');
                echo('window.location="aluno.php"');
                echo('</script>');
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Dados do aluno </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
    </head>
    
    <script>
        function deletarAluno(raAluno){
            var r=confirm("Deletar aluno?");
            if (r==true){
                window.location.href = "aluno.php?excluir="+raAluno;
            } 
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

    <body id='body-fundo-escuro'>   
        <div id='cabecalho'>
            <?php require_once('cabecalho-usuario.php') ?>
        </div>
        
        <div id='container-branco'>
            <div class='linha header-titulo'>
                <div class='coluna-05'>
                    Formulário do(a) aluno(a)
                </div>
                
                <div class='coluna-06'>
                    <form name='formPesquisaAluno' method='post' id='formPesquisaAluno'>
                        <div class='linha'>
                            <div class='coluna-02' id='coluna-pesquisar-aluno'> 
                                 Pesquisar:   
                            </div>

                            <div class='coluna-07'> 
                                <input type="search" name='txtPesquisaRA' id='input-border-bottom' placeholder="Digite o R.A" maxlength="7" required> 
                            </div>
                            <div class='coluna-02'>
                                <input type='submit' name='btnPesquisaAluno' value="Buscar" id='btn-pesquisar'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <form name='editar-cadastrar-aluno' method='post'>
                <div class='linha' id='header-form-aluno'>
                    <strong> Dados do aluno </strong>
                </div>
                <div class='linha'>
                    <div class='coluna-03'>
                        <div class='linha labels'>
                            <label for='txtRA'> R.A: </label>
                        </div>
                        
                        <div class='linha'>
                            <input type='text' name='txtRA' class='inputs inputs-cad-aluno'  maxlength="7" required  <?php  if(!$rsAluno == null){ echo("value='".$rsAluno['raAluno']."'  disabled"); } ?>  > 
                        </div>
                    </div>
                    
                    <div class='coluna-04'>
                        <div class='linha labels'>
                            <label for='txtDataNascimento'> Data de nascimento: </label>
                        </div>
                        
                        <div class='linha'>
                            <input type='text' name='txtDataNascimento' class='inputs inputs-cad-aluno' maxlength="10" onkeypress="mascaraData(this)" required value='<?php  if(!$rsAluno == null){ echo($rsDt); } ?>'> 
                        </div>
                    </div>
                    
                    <div class='coluna-04'>
                        <div class='linha labels'>
                            <label for='txtNomeAluno'> Turma: </label>
                        </div>
                        
                        <div class='linha'>
                            <select name='turmaAluno' class='selects-alunos' required>
                                
                                <?php 
                                    $listaTurmas = selecionarTodasTurmas($idEscola);
                                    
                                    /*Opção default 'selecione' */
                                    $optionDefault = "<option value='' disabled";
                                    if($idTurmaAluno == null){
                                        $optionDefault .= " selected ";
                                    } 
                                    
                                    $optionDefault .= "> Selecione </option>";
                                    echo($optionDefault);
                                    
                                    /*Preenche o option do select*/
                                    while($rsTurma = mysqli_fetch_array($listaTurmas)){ 
                                    	$idTurma = $rsTurma['idTurma'];
                                    	$valueOption = "value='$idTurma' "; 
                                    	
                                    	if($idTurmaAluno == $idTurma){
                                    	    $valueOption .= " selected ";
                                    	}	
                                    	
                                    	$ciclo = $rsTurma['ciclo'];
                                    	$turma = $rsTurma['turma'];
                                    	$textOption = $ciclo."ª ".$turma;
                                    	
                                    	?>
                                    	
                                        <option <?php echo($valueOption); ?> > <?php echo($textOption); ?>   </option>
                                
                                <?php        
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class='linha'>
                    <div class='coluna-09'>
                        <div class='linha labels'>
                            <label for='txtNomeAluno'> Nome do aluno (a): </label>
                        </div>

                        <div class='linha'>
                            <input type='text' name='txtNomeAluno' class='inputs inputs-cad-aluno'  maxlength="30" required <?php  if(!$rsAluno == null){ echo("value='".$rsAluno['nomeAluno']."'"); } ?> > 
                        </div>
                    </div>
                    <div class='coluna-03'>
                        <input type='submit' name='btnCadAluno' class='btn-cad-escola' id='btn-pg-aluno' value="<?php echo($valueBtn); ?>">
                    </div>
                </div>
            </form>
            
            <?php 
                if(!$rsAluno == null){ ?>
                   <div class='linha' id='opcoes-aluno'>
                        <p class='labels'> Opções </p>
                    
                        <div class='col-link link-azul'>
                            <a href='boletim.php?raBoletim=<?php echo($rsAluno['raAluno']);?>' class='link-aula' target='_blank'>
                                Visualizar boletim
                            </a>
                        </div>
                        
                        <div class='col-link link-azul' onclick='deletarAluno(<?php echo($rsAluno['raAluno']);?>)'>
                             Excluir aluno 
                        </div>
                       
                       <div class='col-link link-azul'>
                            <a href='aluno.php' class='link-aula'>
                                Voltar
                            </a>
                        </div>
                    </div>
            <?php        
                }
            ?>
            
            <div class='linha' id='header-tabela-aluno'>
                Listagem
            </div>
            
            <div id='lista-alunos'>
                <?php 
                    $listaAlunos = consultarAlunosPorEscola($idEscola);
                    
                    if(!mysqli_num_rows($listaAlunos) == 0){
                        
                        while($rsAluno = mysqli_fetch_array($listaAlunos)){ 
                            $ra = $rsAluno['raAluno'];
                            ?>
                            <div class='linha-tabela-aluno'>
                                <a href='aluno.php?ra=<?php echo($ra); ?>'>
                                    <div class='coluna-03'>
                                        <strong> <?php echo($ra); ?> </strong>
                                    </div>
            
                                    <div class='coluna-06 coluna-nome'>
                                        <?php echo($rsAluno['nomeAluno']); ?>
                                    </div>
            
                                    <div class='coluna-03'>
                                        <?php 
                                            $classe = $rsAluno['ciclo'];
                                            $classe .= $rsAluno['turma'];
                                            echo($classe); 
                                        ?>
                                    </div>
                                </a>
                            </div> 
                <?php   }    
                    } else {
                        echo("<div class='linha-tabela-aluno'>");
                        echo("Nenhum aluno cadastrado.");
                        echo("</div>");
                    }
                ?>
            </div>
        </div>
    </body>
</html>