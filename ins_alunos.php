<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");
if (isset($_POST['ins_alunos'])) {
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Inserir jogador na sua tabela
        $stmt = $pdo->prepare('INSERT INTO Student_has_SClass  VALUES(:idAluno,:idTurma)');

        $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_STR);
        $stmt->bindParam(':idTurma', $idTurma, PDO::PARAM_STR);

        $idAluno= id_aluno($_POST['alunos']);
        $idTurma= id_turma($_POST['turma']);

        $stmt->execute();

        if ($stmt->rowCount())
        echo  "<script>alert('Aluno inserido com sucesso!');</script>";
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
	<title>Inserir aluno na turma</title>
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
                    <a class="nav-link" href="cadastrar.php">Cadastrar turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="ins_alunos.php">Inserir aluno na turma</a>
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
                    <div class="col-sm-6">
                    <label for="id">Selecione o aluno</label>
                    <select class="form-control" name="alunos">      
                        <option><?php alunos_cad () ?></option>
                    </select>
                    <label for="id">Selecione a turma</label>
                    <select class="form-control" name="turma">      
                        <option><?php turmas () ?></option>
                    </select><br>
                    <button type="submit" class="btn btn-outline-primary" name="ins_alunos">Inserir alunos</button>
                    </div>
                    
                </div>
             </div>
         </form>  
     </div>  
</body>
</html>