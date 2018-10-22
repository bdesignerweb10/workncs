<?php 
	require_once('header.php');
	$consultoria = $conn->query("select * from consultoria order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento de Consultoria</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-consultoria">
					<i class='fa fa-plus'></i> Nova Consultoria
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="bigcolumn-title">Titulo</th>
			                <th class='bigcolumn'>Descrição</th>			                
			                <th class='center'>Ativo</th>			                
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($consultoria && $consultoria->num_rows > 0) {
						    while($consul = $consultoria->fetch_object()) {
						    	$id = $consul->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $consul->id; ?></th>
      							<th scope="row" class="center"><?php echo $consul->titulo; ?></th>
      							<th scope="row" class="center"><?php echo nl2br (substr ($consul->descricao, 0, 100)); ?>...</th>
						        <?php if ($consul->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>						      							        
						        <td class="center"><?php echo $ativo; ?></td>						        
						        <td class='center'>									
									<a href="#" class="btn-edit-consultoria" data-id="<?php echo $id;?>" alt="Editar Consultoria <?php echo $consul->id; ?>" title="Editar dados da consultoria <?php echo $consul->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-consultoria" data-id="<?php echo $id;?>" alt="Remover Consultoria <?php echo $consul->id; ?>" title="Remover Consultoria <?php echo $consul->id; ?>">
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
		<h3 class="headline">Gerenciar Consultoria</h3>
		<button type="button" id="btn-voltar-consultoria" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-consultoria" class="form-panel" data-toggle="validator" action="acts/acts.consultoria.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-consultoria" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="titulo">Titulo</label>
			    			<input type="text" class="form-control form-control-lg" id="titulo" name="titulo" aria-describedby="titulo" placeholder="Informe o nome do serviço..." data-error="Por favor, informe o serviço." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>			    		
			  			<div class="col-12">
						    <label for="descricao">Descrição</label>
						    <textarea class="form-control form-control-lg" id="descricao" name="descricao" rows="6" placeholder="Informe a descrição..." data-error="Por favor, informe a descrição." required></textarea>
			    			<div class="help-block with-errors"></div>
			    		</div>					
			    		<!--<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="img">Imagem</label>
			    			<input type="file" class="form-control form-control-lg" id="img" name="img" aria-describedby="img" placeholder="Insira sua foto" data-error="Por favor, insira sua foto." maxlength="120">
			    			<div class="help-block with-errors"></div>
			    		</div>-->			    		
					</div>
					
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">	
						<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda como Sim o "Serviço" e aparecerá na página Consultoria
								</label>
							</div>
			    		</div>			    		
					</div>
  					<button type="submit" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-consultoria">
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