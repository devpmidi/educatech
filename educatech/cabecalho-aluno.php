<?php 
    require_once('modulos/aluno.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $aluno = null;

    if(isset($_GET['raBoletim'])){
        $raConsulta = $_GET['raBoletim'];
        $aluno = buscarAlunoPorRA($raConsulta);
    }
    
    if(isset($_SESSION['aluno'])){
        $aluno = $_SESSION['aluno'];
    } 
    
    if($aluno == null){
        header('location:index.php');
    } else {
        $ra = $aluno['raAluno'];
        
        $dadosAluno = consultarDadosAlunoEscola($ra);
        $ciclo = $dadosAluno['ciclo'];
        $serie = $ciclo." ano/".$ciclo+1;
        $serie .= " série ".$dadosAluno['turma'];
        $serie .= " - ".$dadosAluno['periodo'];
        $idTurma = $dadosAluno['idTurma'];
    }
?>

<div class="info">
      <img src="imagemusuario.png" alt="Foto usuario"  height="150" width="150">
      Aluno: <?php echo($dadosAluno['nomeAluno']."   -   RA: ".$dadosAluno['raAluno']); ?> 
      <br> Série: <?php echo($serie); ?> 
      <br> Escola: <?php echo($dadosAluno['nomeEscola']."   -   Tel.: ".$dadosAluno['telefoneEscola']); ?>
      <br> <?php echo($dadosAluno['enderecoEscola']); ?>
</div>