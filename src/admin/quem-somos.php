<?php 
	require_once('header.php');
	$quemsomos = $conn->query("select * from quemsomos order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento do Quem somos</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-quemsomos">
					<i class='fa fa-plus'></i> Novo curso
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="center">Nome</th>
			                <th class='center'>Descricao</th>			                			                
			                <th class='center'>Ativo</th>
			                <th class='bigcolumn-title'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($quemsomos && $quemsomos->num_rows > 0) {
						    while($qm = $quemsomos->fetch_object()) {
						    	$id = $qm->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $qm->id; ?></th>
      							<th scope="row" class="center"><?php echo $qm->nome; ?></th>
      							<th scope="row" class="center"><?php echo $qm->descricao; ?></th> 
						        <?php if ($qm->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>									
									<a href="#" class="btn-edit-quemsomos" data-id="<?php echo $id;?>" alt="Editar quem somos <?php echo $qm->id; ?>" title="Editar dados do quem somos <?php echo $qm->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="quemsomos-galeria.php?id=<?php echo $id;?>" class="text-success btn-quemsomos-gallery" data-id="<?php echo $id;?>" alt="Inserir Fotos na Galeria<?php echo $qm->id; ?>" title="Inserir Fotos Galeria <?php echo $qm->id; ?>"><i class="far fa-images fa-2x" ></i>
									<a href="#" class="btn-del-quemsomos" data-id="<?php echo $id;?>" alt="Remover Quem somos <?php echo $qm->id; ?>" title="Remover Quem somos <?php echo $qm->id; ?>">
										<i class="fa fa-trash fa-2x del"></i>
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
		<h3 class="headline">Gerenciar Quem somos</h3>
		<button type="button" id="btn-voltar-curso" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-quemsomos" class="form-panel" data-toggle="validator" action="acts/acts.quemsomos.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-curso" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">Código Curso</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="nome">Nome da empresa</label>
			    			<input type="text" class="form-control form-control-lg" id="nome" name="nome" aria-describedby="nome" placeholder="Informe o nome da empresa..." data-error="Por favor, informe o nome da empresa." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>			    				    		
				  		<div class="col-sm-12">
						    <label for="descricao">Descrição do curso</label>
						    <textarea class="form-control form-control-lg" id="descricao" name="descricao" rows="6" placeholder="Informe a descrição..." data-error="Por favor, informe a descrição." required></textarea>
				    		<div class="help-block with-errors"></div>
				    	</div>				    									    		
					</div>
					
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">	
			    		<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda Sim o curso e aparecerá na página cursos
								</label>
							</div>
			    		</div>
					</div>
  					<button type="submit" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-quemsomos">
  						<i class='fa fa-save'></i> Salvar dados
  					</button>
				</div><!-- col-sm-8--> 
			</div>
		</form>
	</div>
</main>
<?php 
	require_once('footer.php'); 
?>