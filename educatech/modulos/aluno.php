<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();
    
    function buscarAlunoPorRA($raAluno){
        global $conexao;
        
        $sql = "SELECT * FROM aluno WHERE raAluno = ".$raAluno;
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select) == 1){
			$aluno = mysqli_fetch_array($select);
            return $aluno;
        } else {
            return null;
        }
    }
    
    function inserirAluno($raAluno, $nomeAluno, $dataNascimento, $idTurma){
        global $conexao;
        
        $sql = "INSERT INTO aluno (raAluno, nomeAluno, dataNascimento, idTurma)";
        $sql .= " VALUES('$raAluno', '$nomeAluno', '$dataNascimento', '$idTurma')";
        return mysqli_query($conexao, $sql);
    }

    function editarDadosAluno($raAluno, $nomeAluno, $dataNascimento, $idTurma){
        global $conexao;
        
        $sql = "UPDATE aluno SET nomeAluno='$nomeAluno', dataNascimento='$dataNascimento', idTurma=".$idTurma;
        $sql.=" WHERE raAluno ='$raAluno'";
        
        return mysqli_query($conexao, $sql);
    }
    
    function deletarAluno($raAluno){
        global $conexao;
        
        $sql = " DELETE FROM aluno WHERE raAluno=".$raAluno;
        
        return mysqli_query($conexao, $sql);
    }
    
    function consultarAlunosPorTurma($idTurma){
        global $conexao;
        
        $sql = "SELECT * FROM aluno WHERE idTurma='$idTurma' ORDER BY nomeAluno ASC ";
        
        return mysqli_query($conexao, $sql);
    }

    function consultarAlunosPorEscola($idEscola){
        global $conexao;
        
        $sql = "SELECT aluno.*, t.ciclo, t.turma FROM `aluno`";
        $sql.= " INNER JOIN turma AS t ON t.idTurma = aluno.idTurma";
        $sql.= " WHERE idEscola='$idEscola' ORDER BY ciclo, turma, nomeAluno ASC ";
        
        return mysqli_query($conexao, $sql);
    }

    function autenticarAluno($raAluno, $dataNascimento){
        global $conexao;
        
        $sql = "SELECT * FROM aluno ";
        $sql .= "INNER JOIN turma ON aluno.idTurma = turma.idTurma ";
        $sql .= "INNER JOIN escola ON turma.idEscola = escola.idEscola ";
        $sql .= "WHERE aluno.raAluno = '$raAluno' AND aluno.dataNascimento = '$dataNascimento' AND escola.statusConta = 1";
        
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select) == 1){
            $aluno = mysqli_fetch_array($select);
            return $aluno;
        } else {
            return null;
        }
    }

    function consultarDadosAlunoEscola($raAluno){
        global $conexao;
        
        $sql = "SELECT a.raAluno, a.nomeAluno, t.idTurma, t.ciclo, t.turma, t.periodo, e.nomeEscola, e.enderecoEscola, e.telefoneEscola, e.idEscola ";
        $sql .= "FROM aluno AS a INNER JOIN turma AS t ON a.idTurma = t.idTurma ";
        $sql .= "INNER JOIN escola AS e ON t.idEscola = e.idEscola ";
        $sql .= "WHERE a.raAluno = '$raAluno'";
        
        $select = mysqli_query($conexao, $sql);
        
        $aluno = mysqli_fetch_array($select);
        return $aluno;
    }
?>