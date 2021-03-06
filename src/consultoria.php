<?php
	require_once('header.php');

	$consultoria = $conn->query("select * from consultoria where ativo = 0 order by titulo;") or trigger_error($conn->error);
?>
</div><!-- container-fluid -->
	<div class="container-fluid">
		<h3 class="title-servicos">Consultoria</h3>
		<div class="row servicos">			
			<div class="col-4">	
			<?php if ($consultoria && $consultoria->num_rows > 0) {
				while($dados = $consultoria->fetch_object()) {	

				$menu .= '<a class="list-group-item list-group-item-action '. ($dados->id == 1 ? "active" : "") .'" id="'.$dados->id.'" data-toggle="list" href="#a'.$dados->id.'" role="tab" aria-controls="home"> '.$dados->titulo.'</a>';

				$cont .= '<div class="tab-pane fade show texto-servico '. ($dados->id == 1 ? "active" : "") .'" id="a'.$dados->id.'" role="tabpanel" aria-labelledby="'.$dados->id.'">
			      		'.nl2br (substr ($dados->descricao, 0)).'				  		
				  	</div>';
			  	}
			}				
			?>					
		    	<div class="list-group" id="myList" role="tablist">
		    		<?php echo $menu; ?>
		    	</div>  		    	
		  	</div>
		  	<div class="col-8">			  	  	  		
		    	<div class="tab-content" id="nav-tabContent">
		    		<?php echo $cont; ?>			      		      	
				</div>												  	
		    </div><!-- col-sm-8-->				    
		</div><!--col-sm-row-->		
	</div><!-- container -->
<?php
	require_once('footer.php');
?>	