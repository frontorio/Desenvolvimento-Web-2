<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");
$id = $_GET['id'];

function dados(){
    $id=$GLOBALS['id'];
    $bat = array();
    $ins = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $pdo->prepare("select * from Student where id like :id;");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        
        $consulta->execute();
        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
        }

        $stmt = $pdo->prepare("SELECT name FROM Institution WHERE id = :id;");
        $stmt->bindValue(':id', $bat[0]["idInstitution"], PDO::PARAM_STR);
        $stmt->execute();
        
        while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($ins, $linha);
            $nomes = array(array_column($ins,'name'));
       }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '<td>'.$bat[$i]["place"].'</td>';
        echo '<td>'.$ins[0]['name'].'</td>';
        echo '<td>'.$bat[$i]["since"].'</td>';
        echo '<td>'.$bat[$i]["points"].'</td>';
        echo '<td>'.$bat[$i]["tried"].'</td>';
        echo '<td>'.$bat[$i]["submission"].'</td>';
        echo '</tr>';
    }
}
function turmas_aluno(){
    $id=$GLOBALS['id'];
    $bat = array();
    $turmas = array();
    $turmas_aln = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $pdo->prepare("SELECT ass.idSClass, class.name FROM student_has_sclass as ass, sclass as class  WHERE ass.idStudent = (:id) and ass.idSClass = class.id;");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        
        $consulta->execute();
        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["idSClass"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '</tr>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Detalhar aluno</title>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        .center { 
            text-align: center 
        }
        .conteudo {
            width: 125px;
            height: 125px;
            border:2px solid #4682B4;
            background:transparent;
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
                    <a class="nav-link" href="att.php">Atualizar dados</a>
                </li>
            </ul>
        </div>
    </nav>

    <h2 class="center">Perfil do aluno <?php echo nome($GLOBALS['id']);?></h2>

    <div class="container theme-showcase" role="main">
        <form method="post">
            <div class="row">
                <div class="col-sm-12 center">
                    <div>
                        <img class="conteudo"src="<?php echo foto($GLOBALS['id']); ?>" alt=""/>
                    </div>
                    <div>
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
                                <?php dados();?>
                            </tbody>
                        </table>
                     </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <h4 class="center">Turmas que o aluno faz parte</h4>
    <div class="container theme-showcase" role="main">
        <form method="post">
            <div class="row">
                <div class="col-sm-12 flex-container">
                <table class="table table-hover center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php echo turmas_aluno();?>          
                    </tbody>
                </table>
                </div>
            </div>
        </form>
    </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Posição'],
            <?php 
                $bat = chart_hist_posicoes($_GET['id']);
                for ($i=0; $i < count($bat); $i++) { ?>
                ['<?php echo $bat[$i]["data_att"];?>',<?php echo $bat[$i]["place"]; ?>],
            <?php } ?>
        ]);

        var options = {
          title: 'Historico de posições no ranking',
          curveType: 'none',
          legend: { position: 'bottom' },
          vAxis: {
            direction: '-1'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    
    <div id="curve_chart" class="container col-sm-9" style=" height: 500px;"></div>
    
</body>
</html>


