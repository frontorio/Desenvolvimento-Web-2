<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Ranks</title>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
                    <a class="nav-link active" href="ranks.php">Ranks</a>
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
                    <label for="id">Selecione o rank que deseja visualizar</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name="ranks">      
                                <option name=""></option>      
                                <option name="inst">Melhores instituições</option>      
                                <option name="aluno">Melhores alunos</option>
                            </select>
                        </div>
                            <button type="submit" class="btn btn-outline-primary" name="ver">Visualizar</button>
                    </div>   
                    <?php if (isset($_POST['ver'])) {
                        if (strcasecmp($_POST['ranks'],'Melhores instituições')==0) { ?>
                        <br>
                            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>

                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Instituição', 'Score'],
                                            <?php 
                                                $bat = dados_chart_ins();
                                            for ($i=0; $i < count($bat); $i++) { ?>
                                                ['<?php echo $bat[$i]["name"]?>','<?php echo $bat[$i]["avg"] ?>'],
                                            <?php } ?>
                                        ]);

                                    var options = {
                                    chart: {
                                        title: 'Ranking das melhores instiuições',
                                        subtitle: 'Baseado nos scores dos alunos',
                                    }
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                }
                             </script>
                    <?php } else if(strcasecmp($_POST['ranks'],'Melhores alunos')==0) { ?>
                        <br>
                            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>

                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Aluno', 'Score'],
                                            <?php 
                                                $bat = dados_chart_aln();
                                            for ($i=0; $i < count($bat); $i++) { ?>
                                                ['<?php echo $bat[$i]["name"]?>','<?php echo $bat[$i]["points"] ?>'],
                                            <?php } ?>
                                        ]);

                                    var options = {
                                    chart: {
                                        title: 'Ranking dos melhores estudantes',
                                        subtitle: 'Baseado nos seus scores',
                                    }
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                }
                             </script>
                    <?php 
                        } 
                    }?>
                </div>
             </div>
         </form>  
     </div>

    
</body>
</html>