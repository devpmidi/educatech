<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require_once('bancoConexao.php');

    $conexao = conectarBanco();

    function inserirCardapio($idEscola, $img){
        global $conexao;
        
        $sql = " INSERT INTO cardapio(idEscola, imgCardapio) VALUES";
        $sql .= " ('$idEscola', '$img')";
        
    	return mysqli_query($conexao, $sql);
    }

    function editarCardapio($idEscola, $img){
        global $conexao;
        
        $sql = " UPDATE cardapio SET imgCardapio='$img' WHERE idEscola =".$idEscola;
        
    	return mysqli_query($conexao, $sql);
    }

    function selecionarCardapio($idEscola){
        global $conexao;
        
        $sql = "SELECT * FROM cardapio WHERE idEscola=".$idEscola;
        
        $select = mysqli_query($conexao, $sql);
        
        if(mysqli_num_rows($select) == 1){
            $cardapio = mysqli_fetch_array($select);
            return $cardapio;
        } else {
            return null;
        }
    }

    function selecionarNoticias($idEscola){
        global $conexao;
        
        $sql = "SELECT * FROM noticia WHERE idEscola='$idEscola' ORDER BY dataNoticia DESC";
        
        return mysqli_query($conexao, $sql);
    }

    function inserirNoticia($idEscola, $data, $titulo, $desc){
        global $conexao;
        
        $sql = "INSERT INTO noticia(dataNoticia, tituloNoticia, descNoticia, idEscola) VALUES ('$data','$titulo','$desc','$idEscola')";
        
    	return mysqli_query($conexao, $sql);
    }

     function deletarNoticia($idNoticia){
         global $conexao;
        
        $sql = "DELETE FROM noticia WHERE idNoticia=".$idNoticia;
        
    	return mysqli_query($conexao, $sql);
     }
?>