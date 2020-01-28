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
						echo '{"succeed": false, "errno": 27004, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do slide não enviado! Favor contatar o administrador mostrando o erro!"}';
						exit();
					}

					$id = $_GET['id']; 

			    	$qry_slide = $conn->query("SELECT id, nome, link,img , ativo FROM tbl_slides WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_slide && $qry_slide->num_rows > 0) {
						$dados = "";
		    			while($banner = $qry_slide->fetch_object()) {
		    				$dados = '{"id" : "' . $banner->id . '", "nome" : "' . $banner->nome . '","link" : "'. $banner->link .'"  ,"img" : "' . $banner->img . '","ativo" : "' . $banner->ativo . '"}';
		    			}

						echo '{"succeed": true, "dados": ' . $dados . '}';
						exit();
		    		}
		    		else {
		    			throw new Exception('Nenhum slide encontrado com o ID ' . $id . "!");
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
							$errMsg .= "Nome (Nome do slide)";
							$isValid = false;
						}
						

						/*if(!isset($_POST["img"]) || empty($_POST["img"])) {
							$errMsg .= "Imagem do slide";
							$isValid = false;
						}*/						

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {	

							if(isset($_FILES['img'])) {
								//Pegando extensão do arquivo								
								$ext = strtolower(substr($_FILES['img']['name'],-4)); 
								//Definindo um novo nome para o arquivo
							    $new_name = date("Y.m.d-H.i.s") . $ext; 
							    //Diretório para uploads 
							    $dir = '../../img/slides/'; 
							    //Fazer upload do arquivo
							    move_uploaded_file($_FILES['img']['tmp_name'], $dir.$new_name); 
							    //Permissão na pasta (Linux)
							    //chmod("../../img/slides/" . $new_name, 755);
							}

							$imagem = $_FILES['img']['name'];				
							$nome = $_POST["nome"];
							$link = $_POST["link"];
							$ativo= (isset($_POST["ativo"]) && $_POST["ativo"] == "0" ? "0" : "1");
														

							$qry_slides = "INSERT INTO tbl_slides (nome, link, img, ativo) VALUES ('" . $nome . "','" . $link . "', '". $new_name ."' ,'" . $ativo . "')";

							if ($conn->query($qry_slides) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_slides . "<br>" . $conn->error);
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
						echo '{"succeed": false, "errno": 27014, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do slide não enviado! Favor contatar o administrador mostrando o erro!"}';
						exit();
					}	

					$id = $_GET['id'];			

					if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
							$errMsg .= "Nome (nome do slide)";
							$isValid = false;
						}					

						/*if(!isset($_POST["img"]) || empty($_POST["img"])) {
							$errMsg .= "Imagem do slide";
							$isValid = false;
						}*/

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {								
							if(isset($_FILES['img'])) {
								//Pegando extensão do arquivo								
								$ext = strtolower(substr($_FILES['img']['name'],-4)); 
								//Definindo um novo nome para o arquivo
							    $new_name = date("Y.m.d-H.i.s") . $ext; 
							    //Diretório para uploads 
							    $dir = '../../img/slides/'; 
							    //Fazer upload do arquivo
							    move_uploaded_file($_FILES['img']['tmp_name'], $dir.$new_name); 
							    //Permissão na pasta (Linux)
							    //chmod("../../img/slides/" . $new_name, 755);
							}

							$imagem = $_FILES['img']['name'];				
							$nome = $_POST["nome"];					
							
							/*function formatarData($data){
							    $rData = implode("-", array_reverse(explode("/", trim($data))));
							    return $rData;
							}*/

							$link = $_POST["link"];
							$ativo= (isset($_POST["ativo"]) && $_POST["ativo"] == "0" ? "0" : "1");
							

							$qry_slides = "UPDATE tbl_slides 
											  SET nome = '" . $nome . "',										      
											      link = '" . $link . "',
											      img = '". $new_name ."',
											      ativo = " . $ativo . "
											WHERE id = $id";
							if ($conn->query($qry_slides) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_slides . "<br>" . $conn->error);
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

				$qrydel_slides = "DELETE FROM tbl_slides WHERE id = $id";
				if ($conn->query($qrydel_slides) === TRUE) {
				
					$qrydelslides = "DELETE FROM tbl_slides WHERE id = $id";
					if ($conn->query($qrydelslides) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover slide: " . $qrydelslides . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover slide: " . $qrydel_slides . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>