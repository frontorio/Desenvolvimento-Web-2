<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Pesquisas</title>
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
                    <a class="nav-link" href="ins_alunos.php">Inserir aluno na turma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ranks.php">Ranks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="pesquisas.php">Pesquisas</a>
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
         <form  method="post">
			<div class="row">
				<div class="col-sm-12">
                    <label for="esporte">O que deseja consultar?</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name="busca"> 
                                <option name=""></option>
                                <option name="ins">Instituição ordenada por score</option>
                                <option name="ins2">Instituição ordenada por nome</option>
                                <option name="tur2">Turma ordenada por nome</option></option>
                            </select>
                        </div>
                            <button type="submit" class="btn btn-outline-primary" name="pesq">Buscar</button>
                    </div>
                            <?php if (isset($_POST['pesq'])) {
                                if (strcasecmp($_POST['busca'],'Instituição ordenada por score')==0){ ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Score Medio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php inst_ord_avg();?>
                                        </tbody>
                                     </table>
                                <?php } else if(strcasecmp($_POST['busca'],'Instituição ordenada por nome')==0) { ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th>Instituição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php inst_ord_nome();?>
                                        </tbody>
                                     </table>
                                   
                                <?php } else if(strcasecmp($_POST['busca'],'Turma ordenada por nome')==0) { ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Instituição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php turm_ord_nome();?>
                                        </tbody>
                                     </table>
                                <?php } 
                                }?>
                         </div>
                    </div>
				</div>
            </div>	
         </form>	
	 </div>

    
</body>
</html>
