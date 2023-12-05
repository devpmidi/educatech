<?php
    $resultUsuario = null;
    $disciplinasLecionadas = null;
    $tipo ="";
    $styleDivAdmin = "none";
    $styleDivDocente = "inline";
    
    require_once('modulos/turma.php');

	if(isset($_GET['cpf'])){
		$cpfUsuario = $_GET['cpf'];
		$resultUsuario = selecionarUsuarioPorCPF($idEscola, $cpfUsuario);
            
        if($resultUsuario != null){
			$nome = $resultUsuario['nomeUsuario'];
			$cpf = $resultUsuario['cpfUsuario'];
			$login = $resultUsuario['loginUsuario'];
			$senha = $resultUsuario['senhaUsuario'];
			$email = $resultUsuario['emailUsuario'];
			$tipo = $resultUsuario['tipoUsuario'];
			$idUsuario = $resultUsuario['idUsuario'];
			
     	} else {
     	    echo('<script>');
            echo('alert("CPF não localizado");');
            echo('window.location="gerenciar-usuario.php"');
            echo('</script>');
		}
	}

    if($tipo == ""){
        $valueRadioDocente = "checked";
        $valueRadioAdmin = "";

    } else if($tipo == "docente"){
        $valueRadioDocente = "checked";
        $valueRadioAdmin = "disabled";
        
        $disciplinasLecionadas = selecionarDisciplinasLecionadas($idUsuario);
        
    } else {
        $valueRadioDocente = "disabled";
        $valueRadioAdmin = "checked";
        $styleDivAdmin = "inline";
        $styleDivDocente = "none";
    }

    //Pegando o id do usuario para edita dados 
    if($resultUsuario != null){ 
        echo("<input type='hidden' name='idEditarUsuario' value='".$resultUsuario['idUsuario']."'>");
    }
       
?> 

<div class='linha'>
    <div class='coluna-05'>
        <div class='linha labels'>
            <label for='txtNomeUsuario'> Nome: </label>
        </div>
        
        <div class='linha'>
            <input type='text' name='txtNomeUsuario' required class='inputs inputs-cad-usuario'  maxlength="30" <?php if($resultUsuario != null){ echo("value ='$nome'"); } ?> > 
        </div>
        
        <div class='linha labels'>
            <label for='txtCpfUsuario'> CPF: </label>
        </div>

        <div class='linha'>     
            <input type='text' name='txtCpfUsuario' required class='inputs inputs-cad-usuario'  maxlength="11" <?php if($resultUsuario != null){ echo("value ='$cpf'"); } ?>  > 
        </div>
        
        <div class='linha labels'>
            <label for='txtEmailUsuario'> Email: </label>
        </div>

        <div class='linha'>     
            <input type='email' name='txtEmailUsuario' required class='inputs inputs-cad-usuario'  maxlength="30" <?php if($resultUsuario != null){ echo("value ='$email'"); } ?>  > 
        </div>
        
        <div class='linha labels'>
            <label for='txtLoginUsuario'> Login: </label>
        </div>
        
        <div class='linha'>     
            <input type='text' name='txtLoginUsuario' required class='inputs inputs-cad-usuario'  maxlength="20" <?php if($resultUsuario != null){ echo("value ='$login'"); } ?>  > 
        </div>
        
        <div class='linha labels'>
            <label for='txtSenhaUsuario'> Senha: </label>
        </div>
        
        <div class='linha'>     
            <input type='text' name='txtSenhaUsuario' required class='inputs inputs-cad-usuario'  maxlength="20" <?php if($resultUsuario != null){ echo("value ='$senha'"); } ?>  > 
        </div>
    </div>

    <div class='coluna-07'>

        <div class='linha'>
            <strong> Tipo de usuário: </strong>
        </div>
        
        <div class='linha'>
            <div class='coluna-04'>
                <label class="input-radio"> Professor (a)
                  <input type="radio" name="tipoUsuario" value="docente" onclick="selecionarDisciplinas()" <?php echo($valueRadioDocente); ?>> 
                  <span class="radio-checked"></span>
                </label>
            </div>

            <div class='coluna-04'>
                
                <label class="input-radio"> Administrador (a)
                  <input type="radio" name="tipoUsuario" value="" <?php echo($valueRadioAdmin); ?> onclick="selecionarNivelAdmin()">
                  <span class="radio-checked"></span>
                </label>  
            </div>
        </div>

        <div class='linha' id='container-opcoes'>

            <div id='opcoes-professor' style='display:<?php echo($styleDivDocente); ?>;'>
                <div class='linha'>
                    <strong> Disciplinas / Formação </strong>
                </div>

                <div class='linha'>
                    <div class='coluna-06'>
                        
                        <?php 
                            $listaDisciplina = selecionarDisciplinas();
                            $fecharCol = 0;
                            $fecharDiv = 0; 

                            while($disciplina = mysqli_fetch_array($listaDisciplina)){ 

                                $idDisciplina = $disciplina['idDisciplina'];
                                
                                /*Marcando as disciplinas lecionadas pelo docente*/
                                $valueCheckBox = "";
                                if(!empty($disciplinasLecionadas)){
                                    
                                    // Repositiona o ponteiro do conjunto de resultados para o início
                                    mysqli_data_seek($disciplinasLecionadas, 0);
                        
                                    while($rsDisciplina = mysqli_fetch_array($disciplinasLecionadas)){
                                        
                                        $codigo = $rsDisciplina['idDisciplina'];
                                        if($codigo == $idDisciplina){
                                            $valueCheckBox = "checked";
                                        }
                                    }
                                }
                                
                                $valueCheckBox .= " value='$idDisciplina'";
                                
                                /* Codigo para estilização do html */
                                if($idDisciplina == 6){
                                    $fecharCol = 1;
                                } else if($idDisciplina == 9){
                                    $fecharDiv = 1;
                                }
                                
                                if($fecharCol == 1){
                                    echo('</div>');
                                    echo('<div class="coluna-06">');
                                    $fecharCol = 0;
                                } 

                                ?>
                                <div class='linha'>
                                    <label class="input-checkbox"> <?php echo($disciplina['nomeDisciplina']); ?>
                                      <input type='checkbox' name="disciplinas-professor[]" <?php echo($valueCheckBox ); ?>  >
                                      <span class="checkmark"></span>
                                    </label>
                                </div>

            			<?php 
                                if($fecharDiv == 1){
                                    echo('</div>');
                                    $fecharDiv = 0; 
                                }
                            } 
            			?>
                </div>    
            </div>  

            <div id='opcoes-administrador' style='display:<?php echo($styleDivAdmin); ?>;' >

                <div class='linha'>
                    <strong> Permissões </strong>
                </div>

                <div class='linha'>
                    <label class="input-radio"> Nível 1: Gerenciamento das noticias e do cardápio
                      <input type="radio" name="nivelAdmin" value="1" <?php if($tipo == "admin-nivel-1"){ echo(" checked "); } ?>>
                      <span class="radio-checked"></span>
                    </label>
                </div>

                <div class='linha'>
                    <label class="input-radio"> Nível 2: Gerenciamento dos (as) alunos (as) e professores (as)
                      <input type="radio" name="nivelAdmin" value="2"  <?php if($tipo == "admin-nivel-2"){ echo(" checked "); } ?>>
                      <span class="radio-checked"></span>
                    </label>
                </div>

                <div class='linha'>
                    <label class="input-radio"> Nível 3: Acesso a todas sessões de gerenciamento
                      <input type="radio" name="nivelAdmin" value="3"  <?php if($tipo == "admin-nivel-3"){ echo(" checked "); } ?>>
                      <span class="radio-checked"></span>
                    </label>
                </div>
            </div>

        </div>
        
        <div class='linha'>
            
            <?php 
                $valueInput = "";
                if($resultUsuario != null){
                    $valueInput = "Atualizar";
                    $parametrosFuncao = $idUsuario.", '$tipo'";
                } else {
                    $valueInput = "Cadastrar";
                }  
                
                if($valueInput == "Atualizar"){ ?>
                    <div class='coluna-04'>
                        <input type='button' name='btnAtualizarUsuario' class='btn-voltar btn-cad-usuario' onclick="voltar()" value='Voltar'>
                    </div>
                    
                    <div class='coluna-04'>
                        <input type='button' name='btnExcluirUsuario' id='btn-excluir' value='Excluir' onclick="deletarUsuario(<?php echo($parametrosFuncao);?>)">
                    </div>
            <?php
                }
            ?>

            <div class='coluna-04'>
                <input type='submit' name='btnFormUsuario' class='btn-cad-escola btn-cad-usuario'  value="<?php echo($valueInput); ?>">
            </div>

        </div>
    </div>
</div> 