<?php 
	require_once('header.php');
	$cursos = $conn->query("select data_curso, inscricao.cod_curso, cursos.nome from inscricao inner join cursos on inscricao.cod_curso = cursos.cod_curso group by data_curso, inscricao.cod_curso, cursos.nome order by cursos.nome and data_curso") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Lista de Inscrição</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">						
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="bigcolumn-title">Curso</th>
			                <th class='center'>Data Inicio</th>			                
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($cursos && $cursos->num_rows > 0) {
						    while($curso = $cursos->fetch_object()) {
						    	$id = $curso->cod_curso;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $curso->cod_curso; ?></th>
      							<th scope="row" class="center"><?php echo $curso->nome; ?></th>
      							<th scope="row" class="center"><?php echo date('d/m/Y', strtotime($curso->data_curso)); ?></th>
						        <td class='center'>									
									<a href="acts/acts.inscricao.php?act=dow&id=$id" class="" data-id="<?php echo $id;?>" alt="Fazer Download inscritos <?php echo $curso->id; ?>" title="Fazer Download inscritos <?php echo $curso->cod_curso; ?>">
										<i class="fas fa-download fa-2x"></i>
									</a>																		
								</td>						           
							</tr>	
							<?php } ?>			        	
			        	<?php } else { ?>
			        		<tr>
					        	<td colspan="6" class="center">Não há dados a serem exibidos para a listagem.</td>
				            </tr>
			        	<?php } ?>						
					</tbody>    
			    </table>
			</div><!-- col-sm-8-->
		</div><!-- row -->	
	</div><!-- container-->
</main>

<main class="mainform">
	<div class="container">
		
	</div>
</main>
<?php 
	require_once('footer.php'); 
?>