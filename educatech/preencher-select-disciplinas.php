<?php 
    require_once('modulos/turma.php');

    /*Dados passados via url*/ 
    $idTurma = $_POST['idTurma'];
    $aula = $_POST['aula'];
    $dia = $_POST['dia'];
    $ciclo = $_POST['ciclo'];
    
    /*Consulta se a turma ja tem registrado a disciplina dessa aula*/
    $gradeTurma = consultarDisciplinaPelaAula($idTurma, $aula, $dia);
    
    if($gradeTurma == null){
        $idDisciplinaGrade = 0;
    } else {
        $idDisciplinaGrade = $gradeTurma['idDisciplina'];;
    }
    
    /*Select das disciplinas*/
    $lista = selecionarDisciplinasGerais();
    
    /*Opção default 'selecione' */
    $optionDefault = "<option value='' disabled";
    if($idDisciplinaGrade == null){
        $optionDefault .= " selected ";
    } 
    
    $optionDefault .= "> Selecione </option>";
    echo($optionDefault);
    
    /*Preenche o option do select*/
    while($rsDisciplina = mysqli_fetch_array($lista)){ 
    	$idDisciplina = $rsDisciplina['idDisciplina'];
    	$valueOption = "value='$idDisciplina' "; 
    	
    	if($idDisciplinaGrade == $idDisciplina){
    	    $valueOption .= " selected ";
    	}	?>
    	
        <option <?php echo($valueOption); ?> > <?php echo($rsDisciplina['nomeDisciplina']); ?>   </option>

<?php        
    }
    
?>