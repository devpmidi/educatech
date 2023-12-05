<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();

    function cadastrarUsuario($idEscola, $nomeUsuario, $cpfUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, $tipoUsuario){
        global $conexao;
        
        $sql = " INSERT INTO usuario(idEscola, nomeUsuario, cpfUsuario, emailUSuario, loginUsuario, senhaUsuario, tipoUsuario) VALUES";
        $sql .= " ('$idEscola', '$nomeUsuario', '$cpfUsuario', '$emailUsuario', '$loginUsuario', '$senhaUsuario', '$tipoUsuario');";
        
        return mysqli_query($conexao, $sql);
    }

    function editarUsuario($idUsuario, $nomeUsuario, $cpfUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, $tipoUsuario){
        global $conexao;
        
        $sql = " UPDATE usuario SET nomeUsuario='$nomeUsuario', cpfUsuario='$cpfUsuario', emailUsuario='$emailUsuario', loginUsuario='$loginUsuario', senhaUsuario='$senhaUsuario', tipoUsuario='$tipoUsuario' WHERE idUsuario='$idUsuario'";
        
        return mysqli_query($conexao, $sql);
    }
        
    
    function autenticarUsuario($idEscola, $loginUsuario, $senhaUsuario){
        global $conexao;
        
        $sql = "SELECT * FROM usuario WHERE idEscola = ".$idEscola;
        $sql .= " AND loginUsuario = '$loginUsuario' AND senhaUsuario = '$senhaUsuario'";
        
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select)  == 1){
			$usuario = mysqli_fetch_array($select);
            return $usuario;
        } else {
            return null;
        }
    }
    
    function selecionarUsuarioPorCPF($idEscola, $cpfUsuario){
        global $conexao;
        
        $sql = "SELECT * FROM usuario WHERE idEscola = ".$idEscola;
        $sql .= " AND cpfUsuario = '$cpfUsuario'";
        
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select)  == 1){
			$usuario = mysqli_fetch_array($select);
            return $usuario;
        } else {
            return null;
        }
    }
    
    function selecionarTodosUsuarios($idEscola){
        global $conexao;
        
        $sql = "SELECT * FROM usuario WHERE idEscola =".$idEscola;
        $sql .= " ORDER BY nomeUsuario";
        
        $resultado = mysqli_query($conexao, $sql);
        
        return $resultado;
    }
    

    function selecionarDisciplinasLecionadas($idUsuario){
        global $conexao;
        
        $sql = "SELECT * FROM docente_disciplina WHERE idUsuario=".$idUsuario;
        
        $resultado = mysqli_query($conexao, $sql);
        
        return $resultado;
    }

    function selecionarTurmasLecionadas($idUsuario){
        global $conexao;
        
        $sql = "SELECT DISTINCT td.idUsuario, t.idTurma, t.ciclo, t.turma, d.idDisciplina, d.nomeDisciplina ";
        $sql .= "FROM turma_disciplina AS td ";
        $sql .= "INNER JOIN disciplina AS d ON d.idDisciplina = td.idDisciplina ";
        $sql .= "INNER JOIN turma AS t ON t.idTurma = td.idTurma ";
        $sql .= "INNER JOIN usuario AS u ON u.idUsuario = td.idUsuario ";
        $sql .= " WHERE td.idUsuario = '$idUsuario' ";
        $sql .= "ORDER BY t.ciclo, t.turma, d.nomeDisciplina";
        
        $resultado = mysqli_query($conexao, $sql);
        
        return $resultado;
    }

    function verificarTurmaLecionadaFund($idUsuario){
        global $conexao;
        
        $sql = "SELECT tf.*, t.ciclo, t.turma ";
        $sql .= "FROM `turma_fund1_responsavel` AS tf ";
        $sql.= "INNER JOIN turma AS t ON t.idTurma = tf.idTurma ";
        $sql .= "WHERE tf.idUsuario = '$idUsuario' ";
        
        $resultado = mysqli_query($conexao, $sql);
        
        return $resultado;
    }
    
    function inserirFormacaoDocente($idUsuario, $idDisciplina){
        global $conexao;
        
        $sql = " INSERT INTO docente_disciplina (idUsuario, idDisciplina) VALUES ('$idUsuario', '$idDisciplina')";
 
        return mysqli_query($conexao, $sql);
    }
    
    function deletarUsuario($idUsuario){
        global $conexao;
        
        $sql = " DELETE FROM usuario WHERE idUsuario=".$idUsuario;
        
        return mysqli_query($conexao, $sql);
    }
    
    function deletarDisciplinaDocente($idUsuario, $idDisciplina){
        global $conexao;
        
        $sql = " DELETE FROM docente_disciplina WHERE idUsuario=".$idUsuario;
        $sql .= " AND idDisciplina=".$idDisciplina;
        
        return mysqli_query($conexao, $sql);
    }
    
    function deletarDocenteDisciplina($idUsuario){
        global $conexao;
        
        $sql = " DELETE FROM docente_disciplina WHERE idUsuario=".$idUsuario;

        return mysqli_query($conexao, $sql);
    }

    function consultarDadosDocente($idUsuario){
        global $conexao;
        
        $sql = "SELECT u.nomeUsuario, e.nomeEscola, e.enderecoEscola, e.telefoneEscola, e.idEscola ";
        $sql .= "FROM usuario AS u INNER JOIN escola AS e ON u.idEscola = e.idEscola ";
        $sql .= "WHERE u.idUsuario = '$idUsuario'";
        
        $select = mysqli_query($conexao, $sql);
        
        $docente = mysqli_fetch_array($select);
        return $docente;
    }
?>