<?php
	require_once('header.php');

	$id = $_GET['id'];

	$cursos = $conn->query("select * from cursos where cod_curso = $id") or trigger_error($conn->error);

	if ($cursos && $cursos->num_rows > 0) {
	    while($curso = $cursos->fetch_object()) {
			$id = $curso->cod_curso;
			$nome = $curso->nome;
			$data = $curso->data_inicio;			
		}
	}
?>
</div><!-- container-fluid -->
	<div class="container-fluid">
		<div class="row contato-fundo-contato">
			<div class="col-sm-6">
				<form action="acts/acts.inscricao.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
				  <div class="row cont-index-contato">
				    <div class="col">
				      <input type="text" name="nome" id="nome" class="form-control form-cont-index-contato" placeholder="Informe seu nome" data-error="Por favor, informe o nome." maxlength="255" required>
				    </div>
				  </div>
				  <div class="row cont-index-contato">  
				    <div class="col-8">
				      <input type="text" name="email" id="email" class="form-control form-cont-index-contato" placeholder=" Informe seu e-mail" data-error="Por favor, informe o e-mail." maxlength="255" required>
				    </div>
				    <div class="col-4">
				      <input type="tel" name="telefone" id="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control form-cont-index-contato" placeholder="Informe o telefone" data-error="Por favor, informe o telefone." maxlength="16" required>
				    </div>		    
				  </div>
				  <div class="row cont-index-contato">
				    <div class="col">
				      <input type="text" name="curso" id="curso" value="<?php echo $nome; ?>" class="form-control form-cont-index-contato" placeholder="<?php echo $nome; ?>" readonly>
				      <input type="hidden" name="data_curso" VALUE="<?php echo $data; ?>">
				    </div>
				  </div>				  
				  <button type="submit" class="btn btn-dark btn-lg btn-inscricao">Realizar inscrição</button>
				</form>
			</div>
			<div class="col-sm-6">
				<div class="alert alert-info info-inscricao" role="alert">
				  <h4 class="alert-heading">Atenção!</h4>
				  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam justo, volutpat in leo eu, efficitur facilisis augue. Integer ac ullamcorper velit, a sollicitudin purus. In eleifend tellus magna, vel faucibus mi condimentum sit amet. Vivamus enim ex, commodo quis pellentesque et, efficitur eu purus. Duis ac felis sollicitudin, porttitor dui eget, congue sapien. Donec nisl neque, pretium eu mollis vitae, feugiat eget lorem. Nunc tempus eleifend ornare. Donec ultrices arcu nunc, ut dapibus turpis lacinia id. In in mattis urna. Curabitur non mollis nunc. Duis a ligula eu nulla venenatis pulvinar id non enim. Curabitur gravida condimentum justo id bibendum.</p>
				  <hr>
				  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
				</div>
			</div>
		</div>
	</div>
<?php
	require_once('footer.php');
?>	