<?php
	require_once('header.php');
	require_once("../acts/connect.php");
	$id = $_POST['id'];
	$diretorio = "../img/galeria/";

	if(!is_dir($diretorio)){ 
		echo "Pasta $diretorio nao existe";
	}else{
		$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
			for ($controle = 0; $controle < count($arquivo['name']); $controle++){		

				$img = $arquivo['name'][$controle];
				$destino = $diretorio."/".$arquivo['name'][$controle];
					if(move_uploaded_file($arquivo['tmp_name'][$controle], $destino)){	

						$qry_galeria= "INSERT INTO quemsomos_galeria (img, id) VALUES ('" . $img . "', '" . $id . "')";

						if ($conn->query($qry_galeria) === TRUE) {
							$conn->commit();
						} else {
		        			throw new Exception("Erro ao inserir o imagens: " . $qry_galeria . "<br>" . $conn->error);
					}
					//echo "Upload realizado com sucesso<br>"; 
			}else{
			echo "Erro ao realizar upload";
		}		
	}
	echo '<div class="jumbotron jumbotron-fluid">
					  	<div class="container">
							<h1 class="display-4">Sucesso</h1>
							<p class="lead">Fotos inseridas com sucesso!</p>
							<div class="col-sm-2">
								<a href="quem-somos.php" class="btn btn-form btn-primary mb-2">Voltar</a>
							</div>
							<div class="col-sm-10"></div>	

						</div>
					   </div>';
}
require_once('footer.php');
?>