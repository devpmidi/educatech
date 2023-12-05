<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();

    function inserirComentario($nomeContato, $dataComentario, $comentario, $idTurma, $idDisciplina){
        global $conexao;
        
        $sql = "INSERT INTO comentario_aula(nomeContato, dataComentario, comentario, idTurma, idDisciplina) VALUES ('$nomeContato', '$dataComentario', '$comentario', '$idTurma', '$idDisciplina')";

    	return mysqli_query($conexao, $sql);
    }

    function selecionarComentarios($idTurma, $idDisciplina){
        global $conexao;
        
        $sql = "SELECT * FROM comentario_aula WHERE idDisciplina = '$idDisciplina' AND idTurma = '$idTurma' ORDER BY idComentario ASC";
        
        return mysqli_query($conexao, $sql);
    }

?>