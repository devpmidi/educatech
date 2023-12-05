<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();

    function registrarMedia($raAluno, $cicloBoletim, $mediaAluno, $ano, $idDisciplina, $idUsuario, $idTurma){
        global $conexao;
        
        $sql = " INSERT INTO media_aluno(raAluno, cicloBoletim, nota, anoMedia, idDisciplina, idUsuario, idTurma) VALUES";
        $sql .= " ('$raAluno', '$cicloBoletim', '$mediaAluno', '$ano', '$idDisciplina', '$idUsuario', '$idTurma')";
        
    	return mysqli_query($conexao, $sql);
    }

    function validarCicloBoletim($ano, $idTurma, $idDisciplina, $ciclo){
        global $conexao;
        
        $sql = "SELECT * FROM media_aluno WHERE anoMedia = '$ano' AND idTurma = '$idTurma' AND idDisciplina = '$idDisciplina' AND cicloBoletim = '$ciclo'";
  
    	$resultado = mysqli_query($conexao, $sql);

        // Verifica se a consulta foi bem-sucedida e se há resultados
        if ($resultado !== false && mysqli_num_rows($resultado) > 0) {
            return true; 
        } else {
            return false; 
        }
    }

    function verificarBoletim($idDisciplina, $idTurma, $raAluno){
        global $conexao;
        
        $sql = "SELECT m.*, d.nomeDisciplina ";
        $sql .= "FROM media_aluno AS m ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = m.idDisciplina ";
        $sql .= "WHERE m.idDisciplina = '$idDisciplina' AND m.idTurma = '$idTurma' AND m.raAluno = '$raAluno' ";
        $sql .= "ORDER BY  m.cicloBoletim ASC";
        
        return mysqli_query($conexao, $sql);
    }

?>