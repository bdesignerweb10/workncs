<?php
	require_once("../../acts/connect.php");
	
	if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
		!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) ||
		$_SESSION['usu_nivel'] == "3" || $_SESSION["usu_id"] == "0") die('29001 - Você não tem permissão para acessar essa página!');

	if(isset($_GET['act']) && !empty($_GET['act'])) {
		switch ($_GET['act']) {
			case 'dow':
			try {
				if(!isset($_GET['id']) || empty($_GET['id'])) {
					echo '{"succeed": false, "errno": 27020, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}					

				$id = $_GET['id']; 

				//$inscritos = $conn->query("SELECT id_inscricao, inscricao.nome, email, telefone, data_curso, inscricao.cod_curso, cursos.nome FROM inscricao INNER JOIN cursos ON inscricao.cod_curso = cursos.cod_curso WHERE inscricao.cod_curso = $id ORDER BY cursos.nome AND data_curso") or trigger_error($conn->error);

				header('Content-Type: text/csv; charset=utf-8');  
			    header('Content-Disposition: attachment; filename=data.csv');  
			    $output = fopen("php://output", "w");  
			    fputcsv($output, array('ID', 'Nome', 'Email', 'Telefone', 'Curso'));  
			    $query = $conn->query("SELECT id_inscricao, inscricao.nome, email, telefone, data_curso, inscricao.cod_curso, cursos.nome FROM inscricao INNER JOIN cursos ON inscricao.cod_curso = cursos.cod_curso WHERE inscricao.cod_curso = $id ORDER BY cursos.nome AND data_curso") or trigger_error($conn->error);  
			      
			    while($row = mysqli_fetch_assoc($query))  
			    {  
			        fputcsv($output, $row);  
			    }  
			    fclose($output); 
							
							

			}catch(Exception $e) {
					echo '{"succeed": false, "errno": 24005, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
					exit();
			}
			break;
		}
	}
?>
