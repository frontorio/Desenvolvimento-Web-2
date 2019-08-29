<?php
    include_once 'funcoes.php';
    $pdo = Conexao::startConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
	
	$id = id_turma($_POST['nome_tr']);
	$stmt = $pdo->prepare("DELETE FROM Student_has_SClass WHERE idSClass =:id");
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM SClass WHERE id =:id");
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
					alert(\"Turma excluida com sucesso.\");
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