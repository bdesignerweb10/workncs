<?php
	require_once('header.php');

	$id = $_GET['id'];

	$cursos = $conn->query("select * from cursos where cod_curso = $id") or trigger_error($conn->error);

	if ($cursos && $cursos->num_rows > 0) {
	    while($curso = $cursos->fetch_object()) {
			$nome = $curso->nome;			
		}
	}
?> <!-- container-fluid --><div class="container-fluid"><div class="row contato-fundo-contato"><div class="col-sm-6"><form><div class="row cont-index-contato"><div class="col"><input type="text" class="form-control form-cont-index-contato" placeholder="Nome"></div></div><div class="row cont-index-contato"><div class="col-8"><input type="text" class="form-control form-cont-index-contato" placeholder="E-mail"></div><div class="col-4"><input type="number" class="form-control form-cont-index-contato" placeholder="Telefone"></div></div><div class="row cont-index-contato"><div class="col"><input type="text" class="form-control form-cont-index-contato" placeholder="<?php echo $nome; ?>" disabled="disabled"></div></div><button type="submit" class="btn btn-dark btn-lg btn-inscricao">Realizar inscrição</button></form></div><div class="col-sm-6"><div class="alert alert-info info-inscricao" role="alert"><h4 class="alert-heading">Atenção!</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam justo, volutpat in leo eu, efficitur facilisis augue. Integer ac ullamcorper velit, a sollicitudin purus. In eleifend tellus magna, vel faucibus mi condimentum sit amet. Vivamus enim ex, commodo quis pellentesque et, efficitur eu purus. Duis ac felis sollicitudin, porttitor dui eget, congue sapien. Donec nisl neque, pretium eu mollis vitae, feugiat eget lorem. Nunc tempus eleifend ornare. Donec ultrices arcu nunc, ut dapibus turpis lacinia id. In in mattis urna. Curabitur non mollis nunc. Duis a ligula eu nulla venenatis pulvinar id non enim. Curabitur gravida condimentum justo id bibendum.</p><hr><p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p></div></div></div></div> <?php
	require_once('footer.php');
?>