<?php 
    function preencherSelectDocentes($idDisciplina, $idEscola, $idTurma, $ciclo){
    
        $docentes = selecionarDocentesPorDisciplina($idDisciplina, $idEscola);
        $idDocenteDisciplina = consultarDocentePorDisciplina($idTurma, $idDisciplina);
        
        $docenteResp = selecionarRespTurma($idTurma);
        
        if($docenteResp == null){
            $idDocentResp = 0;
        } else {
            $idDocentResp = $docenteResp['idUsuario'];
        }
        
        /*Opção default 'selecione' */
        $optionDefault = "<option value='' disabled";
        if($idDocentResp == 0){
            $optionDefault .= " selected ";
        } 
        
        $optionDefault .= "> Selecione </option>";
        echo($optionDefault);
        
        if(!mysqli_num_rows($docentes) == 0){
            
			while($rsDocente = mysqli_fetch_array($docentes)){ 
                $idDocente = $rsDocente['idUsuario'];
                $nomeDocente = $rsDocente['nomeUsuario'];

                $option = "<option value='$idDocente'";
                
                /*Verifica se o docente já é registrado como responsavel por lecionar a disciplina na turma*/
                if($idDocenteDisciplina == $idDocente || $idDocentResp == $idDocente){
                    $option .= " selected ";
                } 
                
                if($ciclo < 6){
                    /*Verifica se o docente já é responsavel por uma turma do fundamental*/
                    $validacaoIdTurma = validarDocenteResp($idDocente);
                    
                    if($validacaoIdTurma > 0 && $validacaoIdTurma != $idTurma){
                        $option .= ' disabled';
                    } 
                }
                $option .= "> ".$nomeDocente." </option> ";
                echo($option);
            }
        } else {
            $option = "<option value='' disabled> Nenhum registro </option>";
            echo($option);
        }
    }
?>

<div class='linha'>
    <?php 
        $fecharDivLinha = 0;
        $abrirDivLinha = 0;
        
        /*Select das disciplinas*/
        if($ciclo < 6){
            /* Fundamental I */
            $listaDisciplinas = selecionarDisciplinasFundI();
            
        } else {
            /* Fundamental II */
            $listaDisciplinas = selecionarDisciplinasFund2();
        }
        
        while($rsDisciplina = mysqli_fetch_array($listaDisciplinas)){ 
        	$idDisciplina = $rsDisciplina['idDisciplina']; 
        	$nameSelect = " name = 'selectDisciplina".$idDisciplina."' ";
        	
        	/* Codigo para estilização do html */
            if($idDisciplina == 2 || $idDisciplina == 4 || $idDisciplina == 6 || $idDisciplina == 8){
                $fecharDivLinha = 1;
            } 
            
            if($abrirDivLinha == 1){
                echo("<div class='linha'>");
                $abrirDivLinha =0;
            } ?>
            
            <div class='coluna-03 form-materias'>
                 <?php echo($rsDisciplina['nomeDisciplina']); ?>: 
            </div>
            
            <div class='coluna-03'>
                <select class='selects-docentes' required <?php echo($nameSelect); ?> >
                    <?php preencherSelectDocentes($idDisciplina, $idEscola, $idTurma, $ciclo); ?>
                </select>
            </div>
        	
        	<?php 
        	    if($fecharDivLinha == 1){
                    echo('</div>');
                    $fecharDivLinha=0;
                    $abrirDivLinha = 1;
                } 
            ?>
        	
<?php } ?>

    	

    
    
