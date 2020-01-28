<?php
	require_once('header.php');

	$id = $_GET['id'];

	$cursos = $conn->query("select * from cursos where cod_curso = $id") or trigger_error($conn->error);

	if ($cursos && $cursos->num_rows > 0) {
	    while($curso = $cursos->fetch_object()) {
			$nome = $curso->nome;
			$descricao = $curso->descricao;				
			$video = $curso->url;	
			$inscricao = $curso->inscricao_aberta;
		}
	}
?>
</div><!-- container-fluid -->
	<div class="container-fluid">				
		<div class="row">			
			<div class="col-sm-10 offset-1">
				<h3 class="title-servicos"><?php echo $nome; ?></h3>
				<p class="text-curso"><?php echo $descricao; ?></p>	
			</div>
			<div class="col-sm-7 offset-1">
				<div class="video embed-responsive embed-responsive-21by9">
  					<?php echo $video; ?>
				</div>
			</div>
			<div class="col-sm-4 btn-cursos-detalhes">
				<a href="cursos.php" class="btn btn-light">Voltar os cursos</a>
				<a href="inscricao.php?id=<?php echo $id; ?>" class="btn btn-primary <?php if($inscricao == 1){echo 'disabled';} ?>">Inscrever-se</a>	
			</div>
		</div><!-- row -->		
	</div><!-- container -->
<?php
	require_once('footer.php');
?>	