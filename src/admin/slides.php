<?php 
	require_once('header.php');
	$slides = $conn->query("select * from tbl_slides order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento de Slides</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-slide">
					<i class='fa fa-plus'></i> Novo Slide
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="cener">Título</th>
			                 <th class="cener">Imagem</th>				                			                
			                <th class='center'>Ativo</th>
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($slides && $slides->num_rows > 0) {
						    while($banner = $slides->fetch_object()) {
						    	$id = $banner->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $banner->id; ?></th>
      							<th scope="row" class="center"><?php echo $banner->nome; ?></th>
      							<th scope="row" class="center"><img src="../img/slides/<?php echo $banner->img; ?>" width="150" height="100"></th>
						        
						        <?php if ($banner->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>				      						        
						        
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>									
									<a href="#" class="btn-edit-slides" data-id="<?php echo $id;?>" alt="Editar Slide <?php echo $banner->id; ?>" title="Editar dados do Slide <?php echo $banner->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-slides" data-id="<?php echo $id;?>" alt="Remover Slide <?php echo $banner->id; ?>" title="Remover Slide <?php echo $banner->id; ?>">
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
		<h3 class="headline">Gerenciar Slides</h3>
		<button type="button" id="btn-voltar-slide" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-slides" class="form-panel" data-toggle="validator" action="acts/acts.slides.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-curso" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">Código Slide</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="nome">Título Slide</label>
			    			<input type="text" class="form-control form-control-lg" id="nome" name="nome" aria-describedby="nome" placeholder="Informe o curso..." data-error="Por favor, informe o slide." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="nome">link Slide</label>
			    			<input type="text" class="form-control form-control-lg" id="link" name="link" aria-describedby="nome" placeholder="Informe o link do slide..." data-error="Por favor, informe o link do slide.">
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		
				  		<div class="form-group col-sm-12">
						    <label for="img">Imagem do Slide</label>
						    <input type="file" class="form-control-file" id="img" name="img" aria-describedby="img" placeholder="Insira a imagem" required>				    
						  </div>
								    		
					</div>
					
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">	
			    		<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda Sim o curso e aparecerá na página inicial do site
								</label>
							</div>
			    		</div>
					</div>
  					<button type="submit" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-slide">
  						<i class='fa fa-save'></i> Salvar slide
  					</button>
				</div><!-- col-sm-8--> 
			</div>
		</form>
	</div>
</main>
<?php 
	require_once('footer.php'); 
?>