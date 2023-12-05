<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();

    function registrarAula($resumo, $data, $idTurma, $idUsuario, $idDisciplina){
        global $conexao;
        
        $sqlInsert = "INSERT INTO aula (resumoAula, dataAula, idTurma, idUsuario, idDisciplina)";
        $sqlInsert.= " VALUES('$resumo', '$data', '$idTurma', '$idUsuario', '$idDisciplina')";
        
        mysqli_query($conexao, $sqlInsert);
        
        /*Busca o id do proximo registro*/
        $sqlSelect = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'aula'";
            
        $resultSelect = mysqli_query($conexao, $sqlSelect);
        $rowSelect = mysqli_fetch_array($resultSelect);
        $idAula = $rowSelect['AUTO_INCREMENT'] - 1;
        return $idAula; 
    }

    function registrarTarefa($idAula, $idTurma, $descTarefa, $dataTarefa){
        global $conexao;
        
        $sql = " INSERT INTO tarefa_aula(idAula, idTurma, descTarefa, dataTarefa) VALUES";
        $sql .= " ('$idAula', '$idTurma', '$descTarefa', '$dataTarefa')";

    	return mysqli_query($conexao, $sql);
    }

    function registrarPresenca($idAula, $raAluno){
        global $conexao;
        
        $sql = " INSERT INTO presenca_aula(idAula, raAluno) VALUES";
        $sql .= " ('$idAula', '$raAluno')";

    	return mysqli_query($conexao, $sql);
    }

    function buscarAulaPelaData($dataAula, $idUsuario, $idDisciplina, $idTurma){
        global $conexao;
        
        $sql = "SELECT * FROM aula WHERE dataAula = '$dataAula' AND idUsuario = '$idUsuario' AND idDisciplina = '$idDisciplina' AND idTurma = '$idTurma'";
        
        return mysqli_query($conexao, $sql);
    }

    function buscarListaDePresenca($idAula){
        global $conexao;
        
        $sql = "SELECT p.*, a.nomeAluno FROM presenca_aula AS p ";
        $sql .= "INNER JOIN aluno AS a ON a.raAluno = p.raAluno ";
        $sql .= "WHERE p.idAula = '$idAula' ORDER BY a.nomeAluno ASC";
        
        return mysqli_query($conexao, $sql);
    }

    function buscarAulasPelaTurma($idDisciplina, $idTurma){
        global $conexao;
        
        $sql = "SELECT * FROM aula WHERE idDisciplina = '$idDisciplina' AND idTurma = '$idTurma' ORDER BY dataAula DESC";
        
        return mysqli_query($conexao, $sql);
    }

    function selecionarTarefasPelaTurmaDisciplina($idTurma, $idDisciplina){
        global $conexao;
        
        $sql = "SELECT ta.idTarefa, ta.descTarefa, a.dataAula, ta.dataTarefa, t.ciclo, t.turma, d.nomeDisciplina, u.nomeUsuario ";
        $sql .= "FROM tarefa_aula AS ta ";
        $sql .= "INNER JOIN aula AS a ON ta.idAula = a.idAula ";
        $sql .= "INNER JOIN turma AS t ON t.idTurma = ta.idTurma ";
        $sql .= "INNER JOIN usuario AS u ON u.idUsuario = a.idUsuario ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = a.idDisciplina ";
        $sql .= "WHERE ta.idTurma = '$idTurma' AND a.idDisciplina ='$idDisciplina' ORDER BY dataTarefa DESC";
        
        return mysqli_query($conexao, $sql);
    }

    
?>