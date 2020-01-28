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

			    	$qry_quemsomos = $conn->query("SELECT id, nome, descricao, ativo FROM quemsomos WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_quemsomos && $qry_quemsomos->num_rows > 0) {
						$dados = "";
		    			while($qs = $qry_quemsomos->fetch_object()) {
		    				$dados = '{"id" : "' . $qs->id . '", "nome" : "' . $qs->nome . '","descricao" : "'. $qs->descricao .'","ativo" : "' . $qs->ativo . '"}';
		    			}

						echo '{"succeed": true, "dados": ' . $dados . '}';
						exit();
		    		}
		    		else {
		    			throw new Exception('Nenhuma empresa encontrada com o ID ' . $id . "!");
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
							$errMsg .= "Nome (Nome da empresa)";
							$isValid = false;
						}
						

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrição da empresa";
							$isValid = false;
						}						

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {					
							$nome = $_POST["nome"];
							$descricao = $_POST["descricao"];
							$ativo= (isset($_POST["ativo"]) && $_POST["ativo"] == "0" ? "0" : "1");
														

							$qry_quemsomos = "INSERT INTO quemsomos (nome, descricao, ativo) VALUES ('" . $nome . "','" . $descricao . "','" . $ativo . "')";

							if ($conn->query($qry_quemsomos) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_quemsomos . "<br>" . $conn->error);
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
							$errMsg .= "Nome (nome da empresa)";
							$isValid = false;
						}					

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrção da empresa";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {								
							$nome = $_POST["nome"];							
							$descricao = $_POST["descricao"];
							$ativo= (isset($_POST["ativo"]) && $_POST["ativo"] == "0" ? "0" : "1");
							

							$qry_quemsomos = "UPDATE quemsomos 
											  SET nome = '" . $nome . "',										      
											      descricao = '" . $descricao . "',
											      ativo = " . $ativo . "
											WHERE id = $id";
							if ($conn->query($qry_quemsomos) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_quemsomos . "<br>" . $conn->error);
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

				$qrydel_quemsomos = "DELETE FROM quemsomos WHERE id = $id";
				if ($conn->query($qrydel_quemsomos) === TRUE) {
				
					$qrydelquemsomos = "DELETE FROM quemsomos WHERE id = $id";
					if ($conn->query($qrydelquemsomos) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover curso: " . $qrydelquemsomos . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover curso: " . $qrydel_quemsomos . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>