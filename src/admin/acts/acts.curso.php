<?php
	require_once("../../acts/connect.php");
	if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
		!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) ||
		$_SESSION['usu_nivel'] == "3" || $_SESSION["usu_id"] == "0") die('29001 - Você não tem permissão para acessar essa página!');

	if(isset($_GET['act']) && !empty($_GET['act'])) {
		switch ($_GET['act']) {
			case 'showupd':
				try {
					if(!isset($_GET['id']) || empty($_GET['id'])) {
						echo '{"succeed": false, "errno": 27004, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do curso não enviado! Favor contatar o administrador mostrando o erro!"}';
						exit();
					}

					$id = $_GET['id']; 

			    	$qry_curso = $conn->query("SELECT cod_curso, nome, descricao,url,data_inicio ,inscricao_aberta,destaque, ativo FROM cursos WHERE cod_curso = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_curso && $qry_curso->num_rows > 0) {
						$dados = "";
		    			while($cur = $qry_curso->fetch_object()) {
		    				$dados = '{"id" : "' . $cur->cod_curso . '", "nome" : "' . $cur->nome . '", "data_inicio" : "' . date('d/m/Y', strtotime($cur->data_inicio)) . '","descricao" : "'. $cur->descricao .'","link" : "'. str_replace('"', "'", $cur->url) .'","inscricao" : "' . $cur->inscricao_aberta . '","destaque" : "' . $cur->destaque . '", "ativo" : "' . $cur->ativo . '"}';
		    			}

						echo '{"succeed": true, "dados": ' . $dados . '}';
						exit();
		    		}
		    		else {
		    			throw new Exception('Nenhum curso encontrado com o ID ' . $id . "!");
		    		}
				} catch(Exception $e) {
					echo '{"succeed": false, "errno": 24005, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
					exit();
				}
		        break;

			case 'add':
				try {
					$conn->autocommit(FALSE);

					if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
							$errMsg .= "Nome (Nome do curso)";
							$isValid = false;
						}
						

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrição do Curso";
							$isValid = false;
						}						

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {					
							$nome = $_POST["nome"];

							function formatarData($data){
							    $rData = implode("-", array_reverse(explode("/", trim($data))));
							    return $rData;
							}

							$data_inicio = formatarData($_POST['data_inicio']);
							
							if ($data_inicio == null) {
								$data_inicio =  date('y/m/d');
							} else {								
								$data_inicio;
							}
							$descricao = $_POST["descricao"];
							$url = $_POST["link"];
							$inscricao_aberta = (isset($_POST["inscricao"]) && $_POST["inscricao"] == "0" ? "0" : "1");						
							$destaque= (isset($_POST["destaque"]) && $_POST["destaque"] == "0" ? "0" : "1");
							$ativo= (isset($_POST["ativo"]) && $_POST["ativo"] == "0" ? "0" : "1");
														

							$qry_cursos = "INSERT INTO cursos (nome, descricao, url, data_inicio, inscricao_aberta ,destaque, ativo) VALUES ('" . $nome . "','" . $descricao . "','" . $url . "', '". $data_inicio ."' ,'" . $inscricao_aberta . "','" . $destaque . "','" . $ativo . "')";

							if ($conn->query($qry_cursos) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_cursos . "<br>" . $conn->error);
							}							
						}
					}
					else {
						echo '{"succeed": false, "errno": 27008, "title": "Erro ao enviar o formulário!", "erro": "Ocorreu um erro ao tentar enviar seu formulário, favor recarregar a página e tentar novamente!"}';
						$conn->rollback();
						exit();
					}
				} catch(Exception $e) {
					$conn->rollback();

					echo '{"succeed": false, "errno": 27007, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
				}
		        break;
	        case 'edit':
				try {
					$conn->autocommit(FALSE);

					if(!isset($_GET['id']) || empty($_GET['id'])) {
						echo '{"succeed": false, "errno": 27014, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do curso não enviado! Favor contatar o administrador mostrando o erro!"}';
						exit();
					}	

					$id = $_GET['id'];			

					if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
							$errMsg .= "Nome (nome do curos)";
							$isValid = false;
						}					

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrção do curso";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {								
							$nome = $_POST["nome"];							
							
							function formatarData($data){
							    $rData = implode("-", array_reverse(explode("/", trim($data))));
							    return $rData;
							}

							$data_inicio = formatarData($_POST['data_inicio']);

							if ($data_inicio == null) {
								$data_inicio =  date('y/m/d');
							} else {
								$data_inicio;
							}
							$descricao = $_POST["descricao"];
							$url = $_POST["link"];	
							$inscricao_aberta = (isset($_POST["inscricao"]) && $_POST["inscricao"] == "0" ? "0" : "1");						
							$destaque= (isset($_POST["destaque"]) && $_POST["destaque"] == "0" ? "0" : "1");
							$ativo= (isset($_POST["ativo"]) && $_POST["ativo"] == "0" ? "0" : "1");
							

							$qry_cursos = "UPDATE cursos 
											  SET nome = '" . $nome . "',										      
											      descricao = '" . $descricao . "',
											      url = '" . $url . "',
											      data_inicio = '". $data_inicio ."',
											      inscricao_aberta = " . $inscricao_aberta . ",
											      destaque = " . $destaque . ",
											      ativo = " . $ativo . "
											WHERE cod_curso = $id";
							if ($conn->query($qry_cursos) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_cursos . "<br>" . $conn->error);
							}
						}
					}
					else {
						echo '{"succeed": false, "errno": 27012, "title": "Erro ao enviar o formulário!", "erro": "Ocorreu um erro ao tentar enviar seu formulário, favor recarregar a página e tentar novamente!"}';
						$conn->rollback();
						exit();
					}
				} catch(Exception $e) {
					$conn->rollback();

					echo '{"succeed": false, "errno": 27013, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
				}
		        break;
		    case 'del':
			try {
				$conn->autocommit(FALSE);

				if(!isset($_GET['id']) || empty($_GET['id'])) {
					echo '{"succeed": false, "errno": 27020, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}

				$id = $_GET['id']; 

				$qrydel_cursos = "DELETE FROM cursos WHERE cod_curso = $id";
				if ($conn->query($qrydel_cursos) === TRUE) {
				
					$qrydelcursos = "DELETE FROM cursos WHERE cod_curso = $id";
					if ($conn->query($qrydelcursos) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover curso: " . $qrydelcursos . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover curso: " . $qrydel_curso . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>