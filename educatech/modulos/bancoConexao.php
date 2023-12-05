<?php
    /* Função que conecta com o banco */
    function conectarBanco(){
        if($conexao = new mysqli("localhost", 'admin', 'Fatec123', 'bd_educatech')){
            mysqli_set_charset($conexao, 'utf8');
            return $conexao;
    
        } else {
            return null;
        } 
    } 

?>