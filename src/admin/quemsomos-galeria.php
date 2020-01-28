<?php
	require_once('header.php');
	$id = $_GET['id'];
	$empresa = $conn->query("select * from quemsomos where id = $id and ativo = 0") or trigger_error($conn->error);
	$galeria = $conn->query("select * from quemsomos_galeria where id = $id") or trigger_error($conn->error);
?>
<main>	
	<div class="container">
		<h3 class="headline">Galeria de Fotos</h3>
 		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<a href="quem-somos.php" class="btn btn-link btn-lg ">
					<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
				</a>		
			</div><!-- col-sm-8-->
		</div><!-- row -->
		<div class="row" style="margin-left: 118px;">
 			<form enctype="multipart/form-data" method="POST" action="upload.php"> 			
 				<div class="row">
 				<?php if ($empresa && $empresa->num_rows > 0) {
		    		while($ep = $empresa->fetch_object()) {
		    		$id = $ep->id;
				?>	
 					<div class="form-group col-sm-1">
				    	<label for="id">id</label>
				      	<input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>" disabled>
				      	<input name="id" type="hidden" id="id" value="<?php echo $ep->id; ?>">
			      	</div>
 					<div class="form-group col-sm-4">
				    	<label for="grupo">Empresa</label>
				      	<input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $ep->nome; ?>" disabled>
			      	</div>
			    	<?php } ?>
			    <?php } ?>	  				      	
	 				<div class="col-md-9">
	 					<input type="file" name="arquivo[]" multiple="multiple" /><br><br>	 					
	 				</div>
	 				<div class="col-md-3">
	 					<input class="btn btn-form btn-primary mb-2" name="enviar" type="submit" value="Salvar">
	 				</div>
 				</div>
 			</form>
 		</div>
 		<div class="row ger-default" style="margin-left: 118px;">
 		<?php if ($galeria && $galeria->num_rows > 0) {
    		while($fotos = $galeria->fetch_object()) {
    		$id = $fotos->id_galeria;
		?>	
			<div class="col-sm-3" style="margin: 10px 0;">
				<img src="../img/galeria/<?php echo $fotos->img; ?>" alt="..." class="img-thumbnail">
				<div class="card-footer text-muted">
					<span><a href="del-image.php?id=<?php echo $id;?>" class="text-danger btn-del-foto" data-id="<?php echo $id;?>" alt="Remover foto<?php echo $fotos->id_galeria; ?>" title="Remover foto <?php echo $fotos->id_galeria; ?>"><i class="fas fa-trash-alt"></i> Remover Foto</a></span>
				</div>
			</div>	
			<?php } ?>
		<?php } ?>	
 		</div><!-- row -->
	</div>
</main>
<?php
	require_once('footer.php');
?>