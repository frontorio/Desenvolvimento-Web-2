<?php
require 'extrator.php';
include_once 'funcoes.php';
require_once("Autoload.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Detalhar turma</title>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
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
                    <a class="nav-link active" href="buscar_turma.php">Detalhar turma</a>
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
                    <label for="id">Selecione a turma a ser detalhada</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name="turma">      
                                <option><?php turmas () ?></option>
                            </select>
                        </div>
                            <button type="submit" class="btn btn-outline-primary" name="det">Detalhar</button>
                    </div>
                          <?php if (isset($_POST['det'])) {?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Posição</th>
                                        <th scope="col">Data de cadastro</th>
                                        <th scope="col">Pontos</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table">
                                        <?php busca_aluno_turma($_POST['turma']) ?>
                                    </tr>
                                </tbody>
							 </table>
                             <button type="button" class="btn btn-xs btn-outline-danger" data-toggle="modal" data-target="#exclusao_turma"
                                data-nome_tr="<?php echo ($_POST["turma"]); ?>"> Excluir turma </button>
                            <div class="row">
                                <div id="columnchart_material" style="width: 1000px; height: 400px; display:block; margin: 0 auto;" ></div>
                                <script type="text/javascript">
                                    google.charts.load('current', {'packages':['bar']});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Aluno', 'Score'],
                                                <?php 
                                                    $bat = dados_chart_turm($_POST['turma']);
                                                for ($i=0; $i < count($bat); $i++) { ?>
                                                    ['<?php echo $bat[$i]["nome_aluno"]?>','<?php echo $bat[$i]["pontos"] ?>'],
                                                <?php } ?>
                                            ]);

                                        var options = {
                                        chart: {
                                            title: 'Ranking dos melhores alunos da turma',
                                            subtitle: 'Baseado nos scores dos alunos',
                                        }
                                        };

                                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                        chart.draw(data, google.charts.Bar.convertOptions(options));
                                    }
                                </script>
                            </div>
                            <div id="piechart" align='center'></div>

                                <script type="text/javascript">

                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Score', 'Numero de aluno por score'],
                                            <?php 
                                                $bat = dados_chart_turm($_POST['turma']);
                                                $result = range_chart($bat);
                                            ?>
                                            ['Até 500 pontos', <?php echo $result[0]; ?>],
                                            ['501 até 1000', <?php echo $result[1];?>],
                                            ['1001 até 5000', <?php echo $result[2];?>],
                                            ['Acima de 5000', <?php echo $result[3];?>]
                                        ]);
                                        
                                        var options = {'title':'Número de alunos por score', 'width':1000, 'height':500};

                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                        chart.draw(data, options);
                                    }
                                </script>
                          <?php } ?>
                    </div>
            </div>
        </form>
    </div>

<!-- Modal exclusão aluno-->
<div class="modal fade" id="exclusao_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			     </div>
			    <div class="modal-body">
                    <form method="POST" action="http://localhost/dweb2/exclui_aluno.php"enctype="multipart/form-data">
                        <center>
                            <div class="form-group">
                                <label class="control-label">Deseja realmente remover o aluno da turma?</label><br>
                                <input name="id_aln" type="hidden" class="form-control" id="id_aln" readonly="">
                                <input name="nome_turma" type="hidden" class="form-control" id="nome_turma" readonly="">
                            </div>
                            <button type="submit" class="btn btn-outline-danger">Remover</button>
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button>
                        </center> 
                    </form>
			     </div>
			</div>
		</div>
</div>


   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$('#exclusao_Modal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id_aln = button.data('id_al') // Extract info from data-* attributes
		  var nome_al = button.data('nome_aln')
		  var nome_turma = button.data('nome_tr')
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Remover o(a) aluno(a) '+nome_al+' da turma de '+nome_turma)
		  modal.find('#id_aln').val(id_aln)
		  modal.find('#nome_aluno').val(nome_al)
		  modal.find('#nome_turma').val(nome_turma)
		})
	</script>


    <!-- Modal exclusão turma-->
<div class="modal fade" id="exclusao_turma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			     </div>
			    <div class="modal-body">
                    <form method="POST" action="http://localhost/dweb2/exclui_turma.php"enctype="multipart/form-data">
                        <center>
                            <div class="form-group">
                                <label class="control-label">Deseja realmente excluir essa turma?</label><br>
                                <input name="nome_tr" type="hidden" class="form-control" id="nome_tr" readonly="">
                            </div>
                            <button type="submit" class="btn btn-outline-danger">Remover</button>
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button>
                        </center> 
                    </form>
			     </div>
			</div>
		</div>
</div>


   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$('#exclusao_turma').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var nome_tr = button.data('nome_tr')
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Remover a turma de '+nome_tr)
		  modal.find('#nome_tr').val(nome_tr)
		  
		})
	</script>
</body>
</html>


