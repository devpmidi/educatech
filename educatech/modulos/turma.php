<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();
    
    function buscarTurma($idEscola, $ciclo, $turma){
        global $conexao;
        
        $sql = "SELECT * FROM turma WHERE idEscola = ".$idEscola;
        $sql .= " AND ciclo = '$ciclo' AND turma = '$turma'";
        
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select) == 1){
			$turma = mysqli_fetch_array($select);
            return $turma;
        } else {
            return null;
        }
    }

    function buscarTurmaPorId($idTurma){
        global $conexao;
        
        $sql = "SELECT * FROM turma WHERE idTurma = ".$idTurma;
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select) == 1){
			$turma = mysqli_fetch_array($select);
            return $turma;
        } else {
            return null;
        }
    }
    
    function selecionarTodasTurmas($idEscola){
        global $conexao;
        
        $sql = "SELECT * FROM turma WHERE idEscola = '$idEscola' ORDER BY ciclo, turma ASC";
        
        return mysqli_query($conexao, $sql);
    }
    
    function cadastrarTurma($idEscola, $ciclo, $turma, $periodo){
        global $conexao;
        
        $sql = " INSERT INTO turma(idEscola, ciclo, turma, periodo) VALUES";
        $sql .= " ('$idEscola', '$ciclo', '$turma', '$periodo')";

    	return mysqli_query($conexao, $sql);
    }
    
    function registrarHorarioAula($idTurma, $idDisciplina, $aula, $diaSemana, $idUsuario){
        global $conexao;
        
        $sql = " INSERT INTO turma_disciplina(idTurma, idDisciplina, aula, diaSemana, idUsuario) VALUES";
        $sql .= " ('$idTurma', '$idDisciplina', '$aula', '$diaSemana', '$idUsuario')";
        
        return mysqli_query($conexao, $sql);
    }

    function alterarHorarioAula($idTurma, $idDisciplina, $aula, $diaSemana, $idUsuario){
        global $conexao;
        
        $sql = " UPDATE turma_disciplina SET idDisciplina='$idDisciplina', idUsuario= '$idUsuario' ";
        $sql .= " WHERE idTurma = '$idTurma' AND aula = '$aula' AND diaSemana = '$diaSemana' ";
       
        return mysqli_query($conexao, $sql);
    }
    
    function registrarDocenteResponsavel($idTurma, $idDocente){
        global $conexao;
        
        $sql = " INSERT INTO turma_fund1_responsavel(idTurma, idUsuario) VALUES";
        $sql .= " ('$idTurma', '$idDocente')";
  
        return mysqli_query($conexao, $sql);
    }

    function alterarDocenteResponsavel($idTurma, $idDocente){
        global $conexao;
        
        $sql = "UPDATE turma_fund1_responsavel SET idUsuario='$idDocente'  WHERE idTurma=".$idTurma;
  
        return mysqli_query($conexao, $sql);
    }

    function validarDocenteResp($idUsuario){
        global $conexao;
        $sql = " SELECT * FROM turma_fund1_responsavel WHERE idUsuario=".$idUsuario;

        $resultado = mysqli_query($conexao, $sql);
            
        if(mysqli_num_rows($resultado)  == 1){
            $row = mysqli_fetch_array($resultado);
            $idTurma = $row['idTurma'];
            return $idTurma;
        } else {
            return 0;
        }
    }
    
    function verificarHorariosAula($idTurma){
        global $conexao;
        $sql = "SELECT * FROM turma_disciplina WHERE idTurma=".$idTurma;
        
        $resultado = mysqli_query($conexao, $sql);

        if(!mysqli_num_rows($resultado)  == 0){
    		return true;
        } else {
            return false;
        }
    }
    
    function consultarDisciplinaPelaAula($idTurma, $aula, $dia){
        global $conexao;
        
        $sql = "SELECT td.*, t.periodo, d.nomeDisciplina, u.nomeUsuario ";
        $sql .= "FROM turma_disciplina AS td ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = td.idDisciplina ";
        $sql .= "INNER JOIN turma AS t ON t.idTurma = td.idTurma ";
        $sql .= "INNER JOIN usuario AS u ON u.idUsuario = td.idUsuario ";
        $sql .= "WHERE td.idTurma = '$idTurma' AND aula='$aula' AND diaSemana ='$dia'";
     
        $resultado = mysqli_query($conexao, $sql);
            
        if(mysqli_num_rows($resultado)  == 1){
    		$gradeTurma = mysqli_fetch_array($resultado);
            return $gradeTurma;
        } else {
            return null;
        }
    }
    
    function consultarDocentePorDisciplina($idTurma, $idDisciplina){
        global $conexao;
        
        $idDocenteResp = 0;
        
        $sql = " SELECT * FROM turma_disciplina WHERE idTurma=".$idTurma;
        $sql .= " AND idDisciplina='$idDisciplina' LIMIT 1";

        $resultado = mysqli_query($conexao, $sql);
            
        if(mysqli_num_rows($resultado)  == 1){
            $row = mysqli_fetch_array($resultado);
    		$idDocenteResp = $row['idUsuario'];
        } 
        
        return $idDocenteResp;
    }
   
    function selecionarDocentesPorDisciplina($idDisciplina, $idEscola){
        global $conexao;
        
        /*Seleciona o id e nome do docente que leciona essa disciplina*/
        $sql = "SELECT usuario.idUsuario, usuario.nomeUsuario FROM `docente_disciplina` ";
        $sql .= "INNER JOIN disciplina ON disciplina.idDisciplina = docente_disciplina.idDisciplina ";
        $sql .= "INNER JOIN usuario ON usuario.idUsuario = docente_disciplina.idUsuario ";
        $sql .= "INNER JOIN escola ON usuario.idEscola = escola.idEscola ";
        $sql .= "WHERE docente_disciplina.idDisciplina = ".$idDisciplina;
        $sql .= " AND escola.idEscola =".$idEscola;
        $sql .= " ORDER BY usuario.nomeUsuario ASC";
        
        return mysqli_query($conexao, $sql);

    }

    function selecionarDocentesFund($idTurma, $idDisciplina){
        global $conexao;
        
        $sql = "SELECT DISTINCT u.idUsuario, u.nomeUsuario, d.idDisciplina, d.nomeDisciplina ";
        $sql .= "FROM turma_disciplina AS td ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = td.idDisciplina ";
        $sql .= "INNER JOIN turma AS t ON t.idTurma = td.idTurma ";
        $sql .= "INNER JOIN usuario AS u ON u.idUsuario = td.idUsuario ";
        $sql .= "WHERE td.idDisciplina = '$idDisciplina' AND td.idTurma = '$idTurma'";
        
        $resultado = mysqli_query($conexao, $sql);
            
        if(mysqli_num_rows($resultado)  == 1){
    		$docente = mysqli_fetch_array($resultado);
            return $docente;
        } else {
            return null;
        }

    }
    
    function selecionarRespTurma($idTurma){
        global $conexao;
        
        $idDocenteResp = 0;
        
        $sql = " SELECT t.*, u.nomeUsuario FROM turma_fund1_responsavel AS t";
        $sql .= " INNER JOIN usuario AS u ON t.idUsuario = u.idUsuario ";
        $sql .= "WHERE idTurma=".$idTurma;

        $resultado = mysqli_query($conexao, $sql);
            
        if(mysqli_num_rows($resultado)  == 1){
            $docente = mysqli_fetch_array($resultado);
            return $docente;
        } else {
            return null;
        }
    }
    
    function selecionarDisciplinas(){
        global $conexao;
        
        $sql = "SELECT * FROM `disciplina`";
        
        return mysqli_query($conexao, $sql);
      
    }

    function selecionarDisciplinasGerais(){
        global $conexao;
        
        $sql = "SELECT * FROM `disciplina` WHERE idDisciplina != 1";
        
        return mysqli_query($conexao, $sql);

    }
    
    function selecionarDisciplinasFundI(){
        global $conexao;
        
        $sql = "SELECT * FROM `disciplina` WHERE fundamental1 = 1";
        
        return mysqli_query($conexao, $sql);
    }
    
    
    function selecionarDisciplinasFund2(){
        global $conexao;
        
        $sql = "SELECT * FROM disciplina WHERE fundamental2 = 1";
        
        return mysqli_query($conexao, $sql);

    }

    function selecionarDisciplinasGeraisFund1(){
        global $conexao;
        
        $sql = "SELECT * FROM disciplina WHERE fundamental1 != 1";
        
        return mysqli_query($conexao, $sql);
    }

    function selecionarTarefasEmAberto($idTurma){
        global $conexao;
        
        $sql = "SELECT ta.*, d.nomeDisciplina FROM tarefa_aula AS ta ";
        $sql .= "INNER JOIN aula ON aula.idAula = ta.idAula ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = aula.idDisciplina ";
        $sql .= "WHERE ta.idTurma = '$idTurma' AND ta.dataTarefa > CURDATE() ";
        $sql .= "ORDER BY ta.dataTarefa ASC";
        
        return mysqli_query($conexao, $sql);
    }
    
    function selecionarTarefasVencidas($idTurma){
        global $conexao;
        
        $sql = "SELECT ta.*, d.nomeDisciplina FROM tarefa_aula AS ta ";
        $sql .= "INNER JOIN aula ON aula.idAula = ta.idAula ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = aula.idDisciplina ";
        $sql .= "WHERE ta.idTurma = '$idTurma' AND ta.dataTarefa <= CURDATE() ";
        $sql .= "ORDER BY ta.dataTarefa DESC";
        
        return mysqli_query($conexao, $sql);
    }
    
?>