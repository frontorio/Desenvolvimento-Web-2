<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");
if (isset($_POST['cad_turma'])) {
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare('INSERT INTO SClass (name, idInst) VALUES(:nome,:inst)');

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':inst', $inst, PDO::PARAM_STR);

        $nome= $_POST['nome_turma'];
        $inst=pegar_id($_POST['inst']);

        $stmt->execute();

        if ($stmt->rowCount())
        echo  "<script>alert('Turma cadastrada com sucesso!');</script>";
        else
          echo "Erro ao Inserir";
      } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
      }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Cadastrar turma</title>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css">


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
                    <a class="nav-link active" href="cadastrar.php">Cadastrar turmas</a>
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
                    <a class="nav-link" href="att.php">Atualizar dados</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container theme-showcase" role="main">
        <form method="post">
            <div class="row">
                <div class="col-sm-12">
                   <center> <label for="id">Complete as informações abaixo para cadastrar uma turma</label> </center>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="id">Nome da turma</label>
                            <input type="text" class="form-control" name="nome_turma" placeholder="Digite o nome da turma" >
                            <label for="id">Selecione a insituição</label> 
                            <select class="form-control" name="inst"> 
                                <option><?php instituicoes() ?></option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-outline-primary" name="cad_turma">Cadastrar turma</button>
                         </div>
                     </div>
                 </div>
             </div>
         </form>
    </div>
    
</body>
</html>
