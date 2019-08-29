<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");

$id = isset($_POST["id_pesq"])? $_POST["id_pesq"]: "";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Consultar ID URI</title>
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
                <li class="nav-item active">
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
                    <a class="nav-link" href="att.php">Atualizar dados</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container theme-showcase" role="main">
        <form method="post">
            <div class="row">
                <div class="col-sm-12">
                    <label for="id">Informe o ID no sistema URI</label>
                    <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_pesq" placeholder="Insira o ID" value = "<?php echo $id; ?>">
                            </div>
                            <button type="submit" class="btn btn-outline-primary" name="pesq">Buscar</button>
                    </div>
						  <br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Posição</th>
                                        <th scope="col">Instituição</th>
                                        <th scope="col">Data de cadastro</th>
                                        <th scope="col">Pontos</th>
                                        <th scope="col">Tentativas</th>
                                        <th scope="col">Envios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_POST["pesq"])) { 
                                            $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
                                            if (@file_get_contents($url)) {?>
                                                <tr class="table-info">
                                                    <th scope="row"><?php echo $id ?></th>
                                                    <td> <?php echo nome($id)?> </td>
                                                    <td> <?php echo place($id)?> </td>
                                                    <td> <?php echo insti($id)?> </td>
                                                    <td> <?php echo since($id)?> </td>
                                                    <td> <?php echo pontos($id)?> </td>
                                                    <td> <?php echo tent($id)?> </td>
                                                    <td> <?php echo env($id)?> </td>
                                                </tr><?php
                                            }else {
                                                echo  "<script>alert('Esse ID não existe!');</script>";
                                            }?>
                                    <?php } ?>
                                </tbody>
							 </table>
                            <button type="submit" class="btn btn-outline-primary" name="salvar">Salvar</button>
                       <?php
                            if (isset($_POST['salvar'])) { 
                                $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
                                            if (@file_get_contents($url)) {
                                                $con = 'mysql:host=localhost;dbname=GetURI';
                                                $user = "root";
                                                $pass = "";
                                                $oPDO = new StudentPDO($con, $user, $pass);
                                                $iPDO = new InstitutionPDO($con, $user, $pass);
                                                $id_inst = 0;
                                                if (exist_inst(insti($id))) {
                                                    $id_inst = pegar_id(insti($id));
                                                } else {
                                                    $inst = new Institution (0,insti($id));
                                                    $id_inst = pegar_id(insti($id));
                                                } 

                                                $data_cad = strtotime(since($id));
                                                $newDate = date('Y-m-d',$data_cad);
                                                
                                                $estud = new Student($id, nome($id),intval(place($id)), $id_inst, $newDate, pontos($id), intval(tent($id)), intval(env($id)));
                                                

                                                inserir_aluno ($estud);
                                            }else {
                                                echo  "<script>alert('Não foi possivel inserir no banco de dados!');</script>";
                                            }
                                    } 
                                    
                             
                     ?>
                    </div>
            </div>
        </form>
    </div>

    
</body>
</html>
