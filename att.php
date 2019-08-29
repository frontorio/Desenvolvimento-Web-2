<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");
$att=0;
if (isset($_POST['att'])) {
    $bat = array();
    $data_atual = date('Y-m-d');
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $pdo->prepare("SELECT id FROM Student;");
        
        $consulta->execute();

        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
            $id = array_column($bat,'id');
        }
        for ($i=0; $i < count($bat); $i++) { 
            $id=$bat[$i]["id"];
            $consulta = $pdo->prepare("UPDATE Student SET place = :plac, points = :poin,
                                         tried = :trie, submission = :subm where id = :id ;");
            $consulta->bindValue(':plac', intval(place($id)), PDO::PARAM_STR);
            $consulta->bindValue(':poin', pontos($id), PDO::PARAM_STR);
            $consulta->bindValue(':trie', intval(tent($id)), PDO::PARAM_STR);
            $consulta->bindValue(':subm', intval(env($id)), PDO::PARAM_STR);
            $consulta->bindValue(':id',$id, PDO::PARAM_STR);
            $consulta->execute();

            $stmt = $pdo->prepare("INSERT INTO atualizacoes VALUES (:id, :plac, :data_at)");
            $stmt->bindValue(':id',$id, PDO::PARAM_STR);
            $stmt->bindValue(':plac', intval(place($id)), PDO::PARAM_STR);
            $stmt->bindValue(':data_at', $data_atual, PDO::PARAM_STR);
            $stmt->execute();
        }
        $att=1;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Atualizar</title>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        #imgpos {
            position:absolute;
            top:50%;
            left:50%;
            margin-top:225px;
            margin-left:-50px;
        }
        .msg{
            position:absolute;
            top:50%;
            left:50%;
            color: #FFFFFF;
            margin-top:190px;
            margin-left:-200px;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Pesquisas no URI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="consultar.php">Consultar ID</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar.php">Cadastrar turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ins_alunos.php">Inserir aluno na turma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ranks.php">Ranks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pesquisas.php">Pesquisas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="busca_aluno.php">Buscar aluno cadastrado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buscar_turma.php">Detalhar turma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="att.php">Atualizar dados</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php 
        if ($GLOBALS['att']==1) {?>
            <script type="text/javascript">
                $('#att_Modal').modal('hide')
            </script>  
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Pronto!</strong> Todos os alunos tiveram suas informações atualizadas.
            </div>
        <?php }?>
    <div class="container theme-showcase" role="main">
        <form method="post">
            <div class="row">
                <div class="col-sm-12">

                    <center>
                        <br><br><br><br>
                        <h2>Clique no botão abaixo para atualizar o banco de dados.</h2>
                        <br>
                        <button type="submit" class="btn btn-xs btn-outline-primary btn-lg" data-toggle="modal" data-target="#att_Modal" name="att">Atualizar</button>
                    </center>

                </div>
             </div>
         </form>  
     </div>  
     
<!-- Modal loading-->
<div class="modal fade" id="att_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">			 
    <div class="modal-body">
        <center>
            <h2 class="msg">Estamos atualizando os dados</h2>
            <div class="load"><img src="img/loading.gif" id="imgpos"></div>
        </center> 
    </div>
</div>

</body>
</html>