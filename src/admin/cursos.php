<?php 
	require_once('header.php');
	$cursos = $conn->query("select * from cursos order by cod_curso") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento de Cursos</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-curso">
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
			                <th class="bigcolumn-title">Curso</th>
			                <th class='center'>Data Inicio</th>
			                <th class='center'>Inscrição aberta</th>
			                <th class='center'>Destaque</th>			                
			                <th class='center'>Ativo</th>
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
      							<th scope="row" class="center"><?php if($curso->data_inicio != null) {$timestamp = strtotime($curso->data_inicio); echo date('d/m/Y', $timestamp);} else {echo 'Sem data';} ?></th>
						        <?php if ($curso->inscricao_aberta == 0) { 
						        		$inscricao ='Sim'; 
						      		} else { 
						      			$inscricao ='Não';
						      	} 
						      	?>	
						        <?php if ($curso->destaque == 0) { 
						        		$destaque ='Sim'; 
						      		} else { 
						      			$destaque ='Não';
						      	} 
						      	?>	
						        <?php if ($curso->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>						      						        
						        <td class="center"><?php echo $inscricao; ?></td>
						        <td class="center"><?php echo $destaque; ?></td>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>									
									<a href="#" class="btn-edit-curso" data-id="<?php echo $id;?>" alt="Editar Cursos <?php echo $curso->id; ?>" title="Editar dados do Curso <?php echo $curso->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-curso" data-id="<?php echo $id;?>" alt="Remover Curso <?php echo $curso->id; ?>" title="Remover Curso <?php echo $curso->id; ?>">
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
		<h3 class="headline">Gerenciar Cursos</h3>
		<button type="button" id="btn-voltar-curso" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-curso" class="form-panel" data-toggle="validator" action="acts/acts.curso.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-curso" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">Código Curso</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="nome">Nome do Curso</label>
			    			<input type="text" class="form-control form-control-lg" id="nome" name="nome" aria-describedby="nome" placeholder="Informe o curso..." data-error="Por favor, informe o curso." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="data_inicio">Data Ínicio</label>
			    			<input type="text" class="form-control form-control-lg" id="data_inicio" name="data_inicio" aria-describedby="data_inicio" placeholder="Informe a data de ínicio do curso..." data-error="Por favor, informe a data ínicio." maxlength="120">
			    			<div class="help-block with-errors"></div>
			    		</div>			    		
				  		<div class="col-sm-12">
						    <label for="descricao">Descrição do curso</label>
						    <textarea class="form-control form-control-lg" id="descricao" name="descricao" rows="6" placeholder="Informe a descrição..." data-error="Por favor, informe a descrição." required></textarea>
				    		<div class="help-block with-errors"></div>
				    	</div>
				    	<div class="col-sm-12">		    			
							<label for="nome">Video</label>
			    			<input type="text" class="form-control form-control-lg" id="link" name="link" aria-describedby="nome" placeholder="Informe o link do video" data-error="Por favor, informe o link do video.">
			    			<div class="help-block with-errors"></div>
			    		</div>								    		
					</div>
					
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">	
						<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="inscricao" name="inscricao" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda como Sim a "Inscrição" estará liberada
								</label>
							</div>
			    		</div>
			    		<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="destaque" name="destaque" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda Sim o curso aparecerá em "Destaque" na página cursos
								</label>
							</div>
			    		</div>
			    		<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda Sim o curso e aparecerá na página cursos
								</label>
							</div>
			    		</div>
					</div>
  					<button type="submit" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-curso">
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