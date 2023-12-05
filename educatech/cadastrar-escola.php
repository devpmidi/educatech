<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", 1);

    require_once('modulos/escola.php');
    require_once('modulos/usuario.php'); 

    if(isset($_POST['btnCadEscola'])){
        
        $nomeEscola = $_POST['txtNomeEscola'];
        $telefoneEscola = $_POST['txtTelefone'];
        $cidade = $_POST['txtCidade'];
        $uf = $_POST['txtUF'];
        $rua = $_POST['txtRua'];
        $numero = $_POST['txtNumero'];
        $bairro = $_POST['txtBairro'];
        
        if(empty($nomeEscola) || empty($telefoneEscola) || empty($cidade) || empty($uf) || empty($rua) || empty($numero) || empty($bairro)){
            echo('<script>');
            echo('alert("Preencha todos os dados.");');
            echo('</script>'); 
            
        } else {
            $enderecoEscola = $cidade." - ".$uf." / ".$rua." Nº: ".$numero." / ".$bairro;

            /* Chama a função de cadastro da escola e retorna o id do registro */
            $idEscola = cadastrarEscola($nomeEscola, $enderecoEscola, $telefoneEscola);

            if($idEscola == 0){
                header('location:erro.php');
            } else {

                $nomeUsuario = $_POST['txtNomeUsuario'];
                $cpfUsuario = $_POST['txtCpfUsuario'];
                $emailUsuario = $_POST['txtEmailUsuario'];
                $loginUsuario = $_POST['txtLoginUsuario'];
                $senhaUsuario = $_POST['txtSenhaUsuario'];

                /*Cadastro do usuario*/
                $sucessoCadastro = cadastrarUsuario($idEscola, $nomeUsuario, $cpfUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, "admin-nivel-3");

                if($sucessoCadastro){
                    echo('<script>');
                    echo('alert("Dados salvos com sucesso!");');
                    echo('window.location="login-escola.php"');
                    echo('</script>');
                
                } else {
                    header('location:erro.php');
                }
            }
        }
    }   

?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Cadastrar escola </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <script src="js/jquery.min.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'> </script>
        
    </head>
    
    <script>
        
        function verificarTipoUsuario(){
            var radios = document.getElementsByName("funcaoUsuario");
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    console.log("Escolheu: " + radios[i].value);
                    if(radios[i].value == 1 || radios[i].value == 2){
                        $('#etapa1-cad-escola').hide();
                        $('#etapa2-cad-escola').slideToggle("slow");
                    } else {
                        $('#alerta').fadeIn(1000);
                    }
                        
                }
            }
            
        }
        
        function seguirEtapa3(){
            $('#etapa2-cad-escola').hide();
            $('#etapa3-cad-escola').slideToggle("slow");
        }
        
        function voltarEtapa2(){
            $('#etapa3-cad-escola').hide();
            $('#etapa2-cad-escola').slideToggle("slow");
        }

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
    <body>
        
        <div id='cabecalho'>
            <?php require_once('cabecalho-home.html') ?>
        </div>
        
        <div id='etapa1-cad-escola'>
            <div class='container-titulo'>
                 Qual é a sua função na escola?  
            </div>

            <div class='linha'>
                <label class="input-radio"> Desenvolvedor (a)
                  <input type="radio" name="funcaoUsuario" value="1">
                  <span class="radio-checked"></span>
                </label>
            </div>

            <div class='linha'>
                <label class="input-radio"> Diretor (a)
                  <input type="radio" name="funcaoUsuario" value="2">
                  <span class="radio-checked"></span>
                </label>
            </div>

            <div class='linha'>
                <label class="input-radio"> Professor (a)
                  <input type="radio" name="funcaoUsuario" value="3">
                  <span class="radio-checked"></span>
                </label>
            </div>

            <div class='linha'>
                <label class="input-radio"> Responsável por um aluno (a) que frequenta a escola
                  <input type="radio" name="funcaoUsuario" value="4">
                  <span class="radio-checked"></span>
                </label>
            </div>

            <div class='linha'>
                <label class="input-radio"> Outros
                  <input type="radio" name="funcaoUsuario" value="5">
                  <span class="radio-checked"></span>
                </label>
            </div>

            <div class="linha">
                <input type='button' name='btnFuncaoUsuario' class='btn-cad-escola' onclick="verificarTipoUsuario()" value="Enviar">
            </div>
            
            <div id='alerta'>
                Por gentileza entre em contato com a diretoria da escola para solicitar o cadastro da instituição no sistema. 
            </div>
        </div>
        
        <form name='formCadEscola' method="post">
        
            <div id='etapa2-cad-escola'>
                <div class='container-titulo'>
                     Cadastrar escola
                </div>

                <div class='container-cad-escola'>

                    <div class='linha'>
                        Preencha os dados da instituição de ensino para finalizar o cadastro
                    </div>


                    <div class='linha'>   
                        <div class='coluna-09'>
                            <input type='text' name='txtCidade' class='inputs inputs-cad-escola'  maxlength="30" placeholder="Cidade"> 
                        </div>
                        <div class='coluna-02'>
                            <input type='text' name='txtUF' class='inputs inputs-cad-escola'  maxlength="2" placeholder="UF"> 
                        </div>

                    </div>

                    <div class='linha'>
                        <div class='coluna-09'>
                            <input type='text' name='txtRua' class='inputs inputs-cad-escola'  maxlength="30" placeholder="Rua"> 
                        </div>
                        <div class='coluna-02'>
                            <input type='number' name='txtNumero' class='inputs inputs-cad-escola'  placeholder="Numero"> 
                        </div>
                    </div>

                    <div class='linha'>
                        <div class='coluna-07'>
                            <input type='text' name='txtBairro' class='inputs inputs-cad-escola'  maxlength="30" placeholder="Bairro"> 
                        </div>
                        <div class='coluna-04'>
                            <input type='tel' name='txtTelefone' class='inputs inputs-cad-escola'  placeholder="Tel. para contato" onkeyup="handlePhone(event)" maxlength="15"> 
                        </div>
                    </div>

                    <div class='linha'>
                        <input type='text' name='txtNomeEscola' class='inputs inputs-cad-escola'  maxlength="30" placeholder="Nome da escola"> 
                    </div>
                    
                    <div class="linha">
                        <input type='button' name='btnCadUsuario' class='btn-cad-escola inputs-cad-escola' value='Enviar' onclick="seguirEtapa3()">
                    </div>
                </div>

                <div class='container-cad-escola container-img'>
                    <img src='imagens/school.png'>
                </div> 

            </div>
            
            <div id='etapa3-cad-escola'>
                
                <div class='container-titulo'>
                     Registrar como administrador  
                </div>

                <div class='container-cad-escola'>

                    <div class='linha'>
                        Você deve criar uma conta de usuário para acessar todas sessões de gerenciamento do sistema (professores, alunos, turmas, cardápio e mural de notícias). Após a finalização do cadastro da escola será possível cadastrar outros usuários com diferentes níveis de acesso.
                    </div>


                    <div class='linha'>     
                        <input type='text' name='txtNomeUsuario' class='inputs inputs-cad-escola'  maxlength="50" placeholder="Nome"> 
                    </div>

                    <div class='linha'>     
                        <input type='text' name='txtCpfUsuario' class='inputs inputs-cad-escola'  maxlength="11" placeholder="CPF"> 
                    </div>

                    <div class='linha'>     
                        <input type='email' name='txtEmailUsuario' class='inputs inputs-cad-escola'  maxlength="50" placeholder="Email"> 
                    </div>

                    <div class='linha'>     
                        <input type='text' name='txtLoginUsuario' class='inputs inputs-cad-escola'  maxlength="20" placeholder="Login"> 
                    </div>

                    <div class='linha'>     
                        <input type='password' name='txtSenhaUsuario' class='inputs inputs-cad-escola'  maxlength="20" placeholder="Senha"> 
                    </div>
                    
                    <div class="linha">

                        <div class='coluna-06'>
                            <input type='button' name='btnCadUsuario' class='btn-voltar' onclick="voltarEtapa2()" value='Voltar'>
                        </div>

                        <div class='coluna-06'>
                            <input type='submit' name='btnCadEscola' class='btn-cad-escola'>
                        </div>

                    </div>

                </div>

                <div class='container-cad-escola container-img'>
                    <img src='imagens/Group_people.jpg'>
                </div> 

            </div>
        </form> 
        
        <div id='rodape'>
           <?php require_once('rodape-home.html') ?>
        </div>
    </body>
</html>