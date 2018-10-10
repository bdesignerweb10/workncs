<?php
	require_once('header.php');

	$destaques = $conn->query("select * from cursos where destaque = 0 order by inscricao_aberta = 1 asc") or trigger_error($conn->error);

	$cursos = $conn->query("select * from cursos where destaque = 1 order by nome") or trigger_error($conn->error);
?>
</div><!-- container-fluid -->
	<div class="container-fluid">
		<h3 class="title-servicos">Nossos Cursos</h3>
		<p class="text-curso">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pharetra tempus ipsum ac maximus. Ut dapibus tincidunt lobortis. Etiam in metus odio. Aenean est tellus, laoreet eu tempor eu, molestie non erat. Integer tincidunt mollis faucibus. Quisque erat tellus, cursus quis luctus at, ullamcorper vitae purus. Mauris placerat tristique libero non faucibus. Sed sit amet diam eget leo fermentum tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis sem non ante vulputate posuere nec sed neque. Proin egestas eu magna viverra blandit. Integer placerat auctor tellus non lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
		<h3 class="title-servicos">Cursos em destaque</h3>
		<div class="row">	
		<?php if ($destaques && $destaques->num_rows > 0) {
			while($dest = $destaques->fetch_object()) {													
		?>		
			<div class="col-sm-3">
				<div class="card <?php if ($dest->inscricao_aberta == 0) {echo 'text-white bg-success';} else {echo 'bg-light';} ?> mb-3" style="max-width: 18rem;">					
				  <div class="card-header"><?php if($dest->data_inicio != null) {$timestamp = strtotime($dest->data_inicio); echo date('d/m/Y', $timestamp);} else {echo 'Em Breve';} ?></div>
				  <div class="card-body">
				    <h5 class="card-title"><?php echo $dest->nome; ?></h5>
				    <p class="card-text"><?php echo nl2br (substr ($dest->descricao, 0, 100)); ?>...</p>
				    <a href="curso-detalhes.php?id=<?php echo $dest->cod_curso; ?>" class="btn btn-light">Veja mais</a>
				    <a href="inscricao.php?id=<?php echo $dest->cod_curso; ?>" class="btn btn-primary <?php if($dest->inscricao_aberta == 1){echo 'disabled';} ?> ">Inscrever-se</a>
				  </div>
				</div>
			</div>
			<?php } ?> 
		<?php } ?>			
		</div><!-- row -->	
		<h3 class="title-servicos">Outros Cursos</h3>
		<div class="row outros-cursos">
			<div class="col-sm-12">
				<?php if ($cursos && $cursos->num_rows > 0) {
					while($curso = $cursos->fetch_object()) {													
				?>
				<div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h5 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#a<?php echo $curso->cod_curso; ?>" aria-expanded="true" aria-controls="a<?php echo $curso->cod_curso; ?>">
				          	<?php echo $curso->nome; ?>				          
				        </button>
				      </h5>
				    </div>

				    <div id="a<?php echo $curso->cod_curso; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
				       	<?php echo nl2br (substr ($curso->descricao, 0, 500)); ?>...				       	
				      </div>
				      <div class="btn-cursos">
						<a href="curso-detalhes.php?id=<?php echo $curso->cod_curso; ?>" class="btn btn-light">Veja mais</a>
					  </div>
				    </div>
				  </div>
				</div>				
					<?php } ?> 
				<?php } ?> 
			</div>
		</div>
	</div>	
</div><!-- container -->
<?php
	require_once('footer.php');
?>	