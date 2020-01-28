<?php
	require_once('header.php');
	$id=1;
	$quemsomos = $conn->query("select * from quemsomos where ativo = 0 LIMIT 1") or trigger_error($conn->error);
	$galeria = $conn->query("select * from quemsomos_galeria where id = $id") or trigger_error($conn->error);
?>
</div><!-- container-fluid -->
	<div class="container-fluid">
		<div class="row quem-somos">
			<?php if ($quemsomos && $quemsomos->num_rows > 0) {
				while($qs = $quemsomos->fetch_object()) {													
			?>
			<div class="col-sm-8">
				<h3 class="title"><?php echo $qs->nome; ?></h3>
				<p class="text-sobre"><?php echo nl2br (substr ($qs->descricao, 0, 10000)); ?></p>
			</div>	
			<?php } ?> 
		<?php } ?>		
			<div class="col-sm-4 qs-logo">
				<img src="img/logo-work.png" class="img-quemsomos img-fluid">
			</div>						
		</div><!-- row -->
		<div class="row galeria">
			<div>
			<?php								
				if ($galeria && $galeria->num_rows > 0) {
		  			while($fotos = $galeria->fetch_object()) {	
	 		?>	
		      <a class="example-image-link" href="img/galeria/<?php echo $fotos->img; ?>" data-lightbox="example-set"><img class="example-image" src="img/galeria/<?php echo $fotos->img; ?>" width="150" height="150" alt=""/></a>
		    <?php } ?> 
		<?php } ?>	  
		    </div>
		</div>
	</div><!-- container -->
<?php
	require_once('footer.php');
?>	