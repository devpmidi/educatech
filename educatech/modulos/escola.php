<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();

    function cadastrarEscola($nomeEscola, $enderecoEscola, $telefoneEscola){
        global $conexao;
        
        $sql = " INSERT INTO escola(nomeEscola, enderecoEscola, telefoneEscola, statusConta) VALUES";
        $sql .= " ('$nomeEscola', '$enderecoEscola', '$telefoneEscola', 1)";

    	$sucessoCadEscola = mysqli_query($conexao, $sql);
    	
    	$idEscola = 0;
    	
    	/*Retorna o maior id da tabela escola / ultimo registro adicionado */
    	if($sucessoCadEscola){
    	    $sqlSelectUltimoID = "SELECT MAX(idEscola) AS idEscola FROM escola";
    	    $resultado = mysqli_query($conexao, $sqlSelectUltimoID );
    	    
    	    if(mysqli_num_rows($resultado) == 1){
    			$escola = mysqli_fetch_array($resultado);
                $idEscola = $escola['idEscola'];
            } 
    	} 
        return $idEscola;
    }

    function editarDadosEscola($idEscola, $nomeEscola, $enderecoEscola, $telefoneEscola, $statusConta){
        global $conexao;
        
        $sql = "UPDATE escola SET nomeEscola='$nomeEscola', enderecoEscola='$enderecoEscola', telefoneEscola='$telefoneEscola', statusConta='$statusConta' WHERE idEscola =".$idEscola;
        
        return mysqli_query($conexao, $sql);
    }
    
    function selecionarTodasEscolas(){
        global $conexao;
        
        $sql = "SELECT * FROM escola WHERE statusConta = 1 ORDER BY nomeEscola";
        $resultado = mysqli_query($conexao, $sql);
        
        return $resultado;
    }

    function selecionarEscola($idEscola){
        global $conexao;
        
        $sql = "SELECT * FROM escola WHERE idEscola =".$idEscola;
        $resultado = mysqli_query($conexao, $sql);
        
        $escola = mysqli_fetch_array($resultado);
        return $escola;
    }
    
?>