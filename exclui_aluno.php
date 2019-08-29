<?php
    
	require_once("Autoload.php");
	include_once 'funcoes.php';
    $pdo = Conexao::startConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
	
	$id = $_POST['id_aln'];
	$id_tur = id_turma($_POST['nome_turma']);
	$stmt = $pdo->prepare("DELETE FROM Student_has_SClass WHERE idStudent =:id AND idSClass = :id_tur");
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->bindParam(':id_tur', $id_tur, PDO::PARAM_INT);
	$stmt->execute();
 
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if($stmt->rowCount() != 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/dweb2/buscar_turma.php'>
				<script type=\"text/javascript\">
					alert(\"Aluno removido com sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/dweb2/buscar_turma.php'>
				<script type=\"text/javascript\">
					alert(\"Não foi possivel realizar a operação.\");
				</script>
			";	
		}?>
	</body>
</html>