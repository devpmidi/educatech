<?php
    date_default_timezone_set('America/Sao_Paulo');
    require_once('modulos/cardapio-noticia.php');
    $dir = "img-cardapio/";
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title> EducaTech - Gerenciar cardápio e noticias  </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href='css/style.css' type="text/css">
        <link rel="icon" type="image/png" href='imagens/icons8-escola-40.png'>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <script src="js/jquery.min.js"></script>
    </head>
    
    <script>
        $(document).ready(function() {
            $(document).on('change', '#file-cardapio', function(){
                lerURL(this, '#view-cardapio');
            });

            function lerURL(input, divImagem) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(divImagem).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
        
        function deletarNoticia(idNoticia){
            var r=confirm("Deletar noticia?");
            if (r==true){
                window.location.href = "cardapio-noticias.php?excluir=" + idNoticia;
            } 
        }
    </script>

    <body id='body-fundo-escuro'>
        
        <div id='cabecalho'>
            <?php 
                require_once('cabecalho-usuario.php'); 
            ?>
        </div>
        
        <div id='container-branco'>
            <form name='formCardapio' enctype="multipart/form-data" method="post">
                <div class='linha header-titulo'>
                    Cardápio
                </div>
                
                <div id='caixa_cardapio'>
                    <?php 
                        $cardapio = selecionarCardapio($idEscola);
                        if($cardapio != null){
                            $img = $dir.$cardapio['imgCardapio'];
                            $btnCardapio = "Salvar alterações";
                        } else {
                            $img = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D";
                            $btnCardapio = "Inserir";
                        }
                    ?>
                    <img src="<?php echo($img); ?>" alt="imagem" id="view-cardapio"> 
                </div>
                
                <input name="file-cardapio" type="file" required accept="image/*" id='file-cardapio'>
                
                <div class='linha'>
                    <input type='submit' name='btnCardapio' class='btn-cad-escola' id='btn-cardapio' value="<?php echo($btnCardapio); ?>">
                </div>
            </form>

            <div class='linha header-titulo'>
                Mural de notícias 
            </div>
            
            <?php 
                $listaNoticias = selecionarNoticias($idEscola);
            
                if(!mysqli_num_rows($listaNoticias) == 0){
                    while($rsNoticia = mysqli_fetch_array($listaNoticias)){ ?>
                        <div class='linha linha-noticia'>
                            <div class='col-02-lista coluna-noticias'>
                                <strong>  
                                    <?php 
                                        $dt = date('d/m/Y', strtotime(str_replace('/','-',$rsNoticia['dataNoticia'])));     echo($dt); 
                                    ?> Titulo: 
                                </strong>
                            </div>

                            <div class='col-08-lista'>
                                <?php echo($rsNoticia['tituloNoticia']); ?>
                            </div>
                            <div class='col-02-lista coluna-noticias'>
                                <img src="imagens/remover.png" onclick="deletarNoticia(<?php echo($rsNoticia['idNoticia']); ?>)">
                            </div>
                        </div>
            <?php  }
                } else {
                    echo("<div class='linha'>");
                    echo("Nenhum registro.");
                    echo("</div>");
                }
            ?>
 
            <br> 
            <br> 
            <br>
            
            <form name='formNoticia' method="post">
                <div class='linha header-titulo'>
                    Nova publicação
                </div>
                
                <div class='linha labels'>
                    <label for='txtTitulo'> Titulo: </label>
                </div>
                
                <div class='linha'>
                    <input type='text' name='txtTitulo' class='inputs inputs-cad-aluno' maxlength="80" required>
                </div>
                
                <div class='linha labels'>
                    <label for='txtDesc'> Descrição: </label>
                </div>
                
                <div class='linha'>
                    <textarea name='txtDesc' class='textarea'> </textarea>
                </div>
                
                <div class='linha'>
                    <input type='submit' name='btnSalvar' class='btn-cad-escola'  value="Salvar dados">
                </div>
            </form>  
            
        </div>
    </body>
</html>

<?php
    if(isset($_POST['btnCardapio'])){
        
        /*******Tratamento das imagens*******/
    
        //Pegando extensão do arquivo
        $ext = strtolower(substr($_FILES['file-cardapio']['name'],-4)); 
        
        //Definindo um novo nome para o arquivo
        $nomeImg = md5(uniqid(time())).$ext; 
        
        //Fazendo upload da imagem
        $uploadImg = move_uploaded_file($_FILES['file-cardapio']['tmp_name'], $dir.$nomeImg); 
        
        if($uploadImg){
            if($_POST['btnCardapio'] == "Inserir"){
                $sucesso = inserirCardapio($idEscola, $nomeImg);
            } else {
                $sucesso = editarCardapio($idEscola, $nomeImg);
            }
            
            if($sucesso){
                echo('<script>    
                    alert("Cardápio salvo com sucesso.");
                    window.location.href = "cardapio-noticias.php";
                </script>');
                
            } else {
                header('location:erro.php');
            } 
            
        } else {
            echo('<script>    
                    alert("Erro ao enviar imagem para o servidor.");
                </script>');
        }
    }

    if(isset($_POST['btnSalvar'])){
        $titulo = $_POST['txtTitulo']; 
        
        $desc = trim($_POST['txtDesc']); // Remove espaços em branco
        
        // Compara se a string esta vazia
        if(strlen($desc) > 0){
            $desc = $_POST['txtDesc'];
            $data = date('Y-m-d');
            
            $sucesso = inserirNoticia($idEscola, $data, $titulo, $desc);
            
            if(!$sucesso){
                header('location:erro.php');
            } else {
                echo('<script>');
                echo('alert("Noticia publicada com sucesso");');
                echo('window.location.href = "cardapio-noticias.php"');
                echo('</script>'); 
            }
            
        } else {
            echo('<script>');
            echo('alert("Digite a descrição da noticia...");');
            echo('</script>'); 
        }
    }

    if(isset($_GET['excluir'])){
        $idNoticia = $_GET['excluir'];
        
        $sucesso = deletarNoticia($idNoticia);
        
        if($sucesso <= 0){
            header("location:erro.php");
        } else {
            echo('<script>');
            echo('alert("Noticia deletada com sucesso.");');
            echo('window.location.href = "cardapio-noticias.php"');
            echo('</script>'); 
        }
    }

?>