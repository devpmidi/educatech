<?php require_once('modulos/escola.php'); ?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Dados da escola </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
    </head>
    
    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g,'')
            value = value.replace(/(\d{2})(\d)/,"($1) $2")
            value = value.replace(/(\d)(\d{4})$/,"$1-$2")
            return value
        }
    </script>

    <body id='body-fundo-escuro'>   
        <div id='cabecalho'>
            <?php 
                require_once('cabecalho-usuario.php');

                $escola = selecionarEscola($idEscola);

                if($escola['statusConta'] == 1){
                    $opAtivo = "checked";
                    $opDesat = "";
                } else {
                    $opAtivo = "";
                    $opDesat = "checked";
                }
            ?>
        </div>
        
        <div id='container-branco'>
            <div class='linha header-titulo'>
                Dados da escola:
            </div>
            
            <form name='form-escola' method='post'>
                
                <div class='linha labels'>
                    <label for='nomeEscola'> Nome: </label>
                </div>
                
                <div class='linha'>
                    <input type='text' name='nomeEscola' class='inputs inputs-cad-aluno'  maxlength="50" required  value='<?php echo($escola['nomeEscola']);  ?>'  > 
                </div>
                
                <div class='linha labels'>
                    <label for='endereco'> Endereço: </label>
                </div>
                
                <div class='linha'>
                    <input type='text' name='endereco' class='inputs inputs-cad-aluno'   required  value='<?php echo($escola['enderecoEscola']); ?>'  > 
                </div>
                
                <div class='linha'>
                    <div class='coluna-05'>
                        <div class='linha labels'>
                            <label for='telefone'> Telefone: </label>
                        </div>

                        <div class='linha'>
                            <input type='text' name='telefone' class='inputs inputs-cad-aluno' onkeyup="handlePhone(event)" maxlength="15" required value='<?php echo($escola['telefoneEscola']); ?>'  > 
                        </div>
                    </div>
                    
                    <div class='coluna-05'>
                        
                        <div class='linha labels'>
                            <br> 
                            <label for='statusConta'> Status da conta: </label>
                        </div>
                        
                        <div class='linha'>
                            <br>
                            <div class='coluna-03'>
                                <input type="radio" name="statusConta" value="1" <?php echo($opAtivo); ?>>
                                 Ativa
                            </div>

                            <div class='coluna-03'>
                                <input type="radio" name="statusConta" value='0' <?php echo($opDesat); ?>> Desativada
                            </div>
                        </div>    
                    </div>
                </div>
                
                <div class='linha'>
                    <input type='submit' name='btnEditar' class='btn-cad-escola'  value="Salvar alterações">
                </div>
            </form>
        
        </div>
    </body>
</html>

<?php 
    
    if(isset($_POST['btnEditar'])){
        $nomeEscola = $_POST['nomeEscola'];
        $telefoneEscola = $_POST['telefone'];
        $enderecoEscola = $_POST['endereco'];
        $statusConta = $_POST['statusConta'];
        
        $sucessoEditar = editarDadosEscola($idEscola, $nomeEscola, $enderecoEscola, $telefoneEscola, $statusConta);
        
        if($sucessoEditar){
            echo('<script>');
            echo('alert("Dados salvos com sucesso!");');
            echo('window.location="form-escola.php"');
            echo('</script>');
        } else {
            header('location:erro.php');
        }
        
    }
?>