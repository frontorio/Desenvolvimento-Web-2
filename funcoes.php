<?php
include_once 'extrator.php';
require_once("Autoload.php");

function exist_inst($nome){
        $con = 'mysql:host=localhost;dbname=GetURI';
        $user = "root";
        $pass = "";
        $iPDO = new InstitutionPDO($con, $user, $pass);
        $inst = new Institution (0,$nome);
        if ($iPDO->exists($inst)) {
            return true;
        } else{
            $iPDO->insert($inst);
            return false;
        }
}
function pegar_id($nome){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->prepare('SELECT id FROM Institution WHERE name = (:nome);');
        $consulta->bindValue(':nome', $nome, PDO::PARAM_STR);
        $consulta->execute();

        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
            $id = array_column($bat,'id');
         }
       return ($id[0]);
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    }
}
function inserir_aluno ($obj){
    $data_atual = date('Y-m-d');
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Inserir na tabela
        $stmt = $pdo->prepare('insert into Student values (:id, :name, :plac, :sinc, :poin, :trie, :subm, :idI)');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':name', $nome, PDO::PARAM_STR);
		$stmt->bindParam(':plac', $place, PDO::PARAM_STR);
		$stmt->bindParam(':sinc', $sinc, PDO::PARAM_STR);
		$stmt->bindParam(':poin', $poin, PDO::PARAM_STR);
		$stmt->bindParam(':trie', $trie, PDO::PARAM_INT);
		$stmt->bindParam(':subm', $sub, PDO::PARAM_INT);
		$stmt->bindParam(':idI', $id_ins, PDO::PARAM_INT);

        $id=$obj-> getId();
        $nome=$obj-> getName();
        $place=$obj-> getPlace();
        $sinc=$obj-> getSince();
        $poin=$obj-> getPoints();
        $trie=$obj-> getTried();
        $sub=$obj-> getSubmission();
        $id_ins=$obj-> getUniversity();

        $stmt->execute();

        $stmt = $pdo->prepare("INSERT INTO atualizacoes VALUES (:id, :plac, :data_at)");
        $stmt->bindValue(':id',$id, PDO::PARAM_STR);
        $stmt->bindValue(':plac', $place, PDO::PARAM_STR);
        $stmt->bindValue(':data_at', $data_atual, PDO::PARAM_STR);
        $stmt->execute();


        if ($stmt->rowCount())
        echo  "<script>alert('Dados salvos com sucesso!');</script>";
        else
          echo "Erro ao Inserir";
      } catch(PDOException $e) {
        
      }
}
function instituicoes(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("SELECT * FROM Institution ORDER BY name;");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
         $nomes = array(array_column($bat,'name'));
    }
    for ($i=0; $i < count($nomes[0]); $i++) { 
         echo '<option name="'.$nomes[0][$i].'">'.$nomes[0][$i].'</option>';
     }
}
function alunos_cad(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("SELECT * FROM Student order by name;");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
         $nomes = array(array_column($bat,'name'));
    }
    for ($i=0; $i < count($nomes[0]); $i++) { 
         echo '<option name="'.$nomes[0][$i].'">'.$nomes[0][$i].'</option>';
     }
}
function id_aluno($nome){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->prepare('SELECT id FROM Student WHERE name = (:nome);');
        $consulta->bindValue(':nome', $nome, PDO::PARAM_STR);
        $consulta->execute();

        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
            $id = array_column($bat,'id');
         }
       return ($id[0]);
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    }
}
function turmas(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("SELECT * FROM SClass ORDER BY name;");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
         $nomes = array(array_column($bat,'name'));
    }
    for ($i=0; $i < count($nomes[0]); $i++) { 
         echo '<option name="'.$nomes[0][$i].'">'.$nomes[0][$i].'</option>';
     }
}
function id_turma($nome){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->prepare('SELECT id FROM SClass WHERE name = (:nome);');
        $consulta->bindValue(':nome', $nome, PDO::PARAM_STR);
        $consulta->execute();

        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
            $id = array_column($bat,'id');
         }
       return ($id[0]);
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    }
}
function inst_ord_nome(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("SELECT * FROM Institution ORDER BY name;");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
    echo "<center><h2>Instituições ordenadas por nome</h2></center>";
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '</tr>';
     }
}
function turm_ord_nome(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("SELECT * FROM SClass ORDER BY name;");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
    echo "<center><h2>Turmas ordenadas por nome</h2></center>";
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '</tr>';
     }
}
function inst_ord_avg(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("select ins.id as id_inst, avg(stu.points) as avg, ins.name from Student as stu inner join Institution as ins where stu.idInstitution = ins.id group by ins.id order by avg desc");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
    echo "<center><h2>Instituições ordenadas por media de score</h2></center>";
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id_inst"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '<td>'.$bat[$i]["avg"].'</td>';
        echo '</tr>';
     }
}
function turm_ord_avg(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("select ins.id as id_inst, avg(stu.points) as avg, ins.name from Student as stu inner join Institution as ins where stu.idInstitution = ins.id group by ins.id order by avg desc");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
    echo "<center><h2>Turmas  ordenadas por media de score</h2></center>";
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id_inst"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '<td>'.$bat[$i]["avg"].'</td>';
        echo '</tr>';
     }
}
function busca_aluno($nome){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $pdo->prepare("select * from Student where name like :nome order by points desc;");
        $consulta->bindValue(':nome', '%'.$nome.'%', PDO::PARAM_STR);
        
        $consulta->execute();

        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
            $id = array_column($bat,'id');
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    echo "<center><h2>Alunos que contém '".$nome."' no nome</h2></center>";
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id"].'</th>';
        echo '<td>'.$bat[$i]["name"].'</td>';
        echo '<td>'.$bat[$i]["place"].'</td>';
        echo '<td>'.$bat[$i]["since"].'</td>';
        echo '<td>'.$bat[$i]["points"].'</td>';
        echo '</tr>';
    }
}
function dados_chart_ins(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("select ins.id as id_inst, avg(stu.points) as avg, ins.name from Student as stu inner join Institution as ins where stu.idInstitution = ins.id group by ins.id order by avg asc limit 10");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    return $bat;
}
function dados_chart_aln(){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("select stu.points as points, stu.name from Student as stu order by points asc limit 10;");
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    return $bat;
}
function busca_aluno_turma($nome_turma){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $pdo->prepare("select stu.id as id_aluno, stu.name as nome_aluno, stu.place as posi, stu.since as data_cad, stu.points as pontos from Student as stu inner join Student_has_SClass as turma, SClass as class where turma.idSClass = class.id and class.name = :nome and turma.idStudent = stu.id  group by stu.points order by stu.points desc;");
        $consulta->bindValue(':nome', $nome_turma, PDO::PARAM_STR);
        
        $consulta->execute();

        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            array_push($bat, $linha);
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
        echo "<center><h2>Alunos da turma de ".$nome_turma."</h2></center>";
    for ($i=0; $i < count($bat); $i++) { 
        echo '<tr class="table">';
        echo '<th scope="row">'.$bat[$i]["id_aluno"].'</th>';
        echo '<td>'.$bat[$i]["nome_aluno"].'</td>';
        echo '<td>'.$bat[$i]["posi"].'</td>';
        echo '<td>'.$bat[$i]["data_cad"].'</td>';
        echo '<td>'.$bat[$i]["pontos"].'</td>';
        echo '<td>'.'<button type="button" class="btn btn-xs btn-outline-info" onClick=window.location="det_aluno.php?id='.$bat[$i]["id_aluno"].'">Visualizar</button>
                    <button type="button" class="btn btn-xs btn-outline-danger" data-toggle="modal" data-target="#exclusao_Modal"
                    data-id_al="'.$bat[$i]["id_aluno"].'"
                    data-nome_tr="'.$nome_turma.'"
                    data-nome_aln="'.$bat[$i]["nome_aluno"].'">Remover</button>'.
             '<td>';
        echo '</tr>';
    }
}
function dados_chart_turm($nome_turma){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consulta = $pdo->prepare("select stu.id as id_aluno, stu.name as nome_aluno, stu.place as posi, stu.since as data_cad, stu.points as pontos from Student as stu inner join Student_has_SClass as turma, SClass as class where turma.idSClass = class.id and class.name = (:nome) and turma.idStudent = stu.id  group by stu.points order by stu.points asc;");
        $consulta->bindValue(':nome', $nome_turma, PDO::PARAM_STR);
        $consulta->execute();
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    return ($bat);
}
function range_chart($vet){
    $retorno= array(0,0,0,0);
    for ($i=0; $i < count($vet); $i++) { 
        if ($vet[$i]["pontos"]<500) {
            $retorno[0]+=1;
        }elseif ($vet[$i]["pontos"]> 500 && $vet[$i]["pontos"]<1000) {
            $retorno[1]+=1;
        }elseif ($vet[$i]["pontos"]> 1000 && $vet[$i]["pontos"]<5000) {
            $retorno[2]+=1;
        }elseif ($vet[$i]["pontos"]>5000) {
            $retorno[3]+=1;
        }
    }
    return $retorno;
}
function chart_hist_posicoes($id){
    $bat = array();
    try {
        $pdo = Conexao::startConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->prepare("select * from atualizacoes where idStudent = :id;");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
    } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
    } 
        
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
         array_push($bat, $linha);
    }
    return $bat;
}


?>