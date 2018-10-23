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
			    
				$arquivo = 'inscritos.xls';				
				
				$html = '';
				$html .= '<table border="1">';
				$html .= '<tr>';
				$html .= '<td colspan="6" align="center"><b>Inscritos no curso</b></tr>';
				$html .= '</tr>';
		
				$html .= '<tr>';
				$html .= '<td><b>ID</b></td>';
				$html .= '<td><b>Nome</b></td>';
				$html .= '<td><b>E-mail</b></td>';
				$html .= '<td><b>Telefone</b></td>';
				$html .= '<td><b>Data</b></td>';		
				$html .= '<td><b>Curso</b></td>';
				$html .= '</tr>';		
				 
				$inscritos = "SELECT id_inscricao, inscricao.nome, email, telefone, data_curso, inscricao.cod_curso, cursos.nome as curso FROM inscricao INNER JOIN cursos ON inscricao.cod_curso = cursos.cod_curso 
		WHERE inscricao.cod_curso = 2 ORDER BY cursos.nome AND data_curso";
				$inscricao = mysqli_query($conn , $inscritos);
		
				while($insc = mysqli_fetch_assoc($inscricao)){
					$html .= '<tr>';
					$html .= '<td>'.$insc["id_inscricao"].'</td>';
					$html .= '<td>'.$insc["nome"].'</td>';
					$html .= '<td>'.$insc["email"].'</td>';
					$html .= '<td>'.$insc["telefone"].'</td>';
					$data = date('d/m/Y',strtotime($insc["data_curso"]));
					$html .= '<td>'.$data.'</td>';			
					$html .= '<td>'.$insc["curso"].'</td>';
					$html .= '</tr>';
					;
				}				
				
				header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
				header ("Cache-Control: no-cache, must-revalidate");
				header ("Pragma: no-cache");
				header ("Content-type: application/x-msexcel");
				header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
				header ("Content-Description: PHP Generated Data" );
				
				echo $html;
				exit;  

			}catch(Exception $e) {
					echo '{"succeed": false, "errno": 24005, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
					exit();
			}
			break;
		}
	}
?>
