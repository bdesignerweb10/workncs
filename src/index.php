<?php
	require_once('header.php');
	$slides = $conn->query("select nome, link, img from tbl_slides where ativo = 0") or trigger_error($conn->error);
?>	
<div class="container-fluid slide">
		<div class="row">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	  			<div class="carousel-inner">
			  	<?php 		
			  		$count = 0;								
					if ($slides && $slides->num_rows > 0) {
					  	while($banner = $slides->fetch_object()) {	
				 ?>
	    			<div class="carousel-item <?php if($count == 0) echo 'active'; ?>" data-interval="10000">	      	
	      				<a href="<?php echo $banner->link; ?>"><img src="img/slides/<?php echo $banner->img; ?>" class="d-block w-100" alt="..."></a>
	    			</div>
			    	<?php $count++; } ?> 
				<?php } ?>		    
	  			</div>
	  			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	    			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    			<span class="sr-only">Previous</span>
	  			</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				</a>
			</div>
		</div><!-- row -->		
	</div><!-- container-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4">
			<h2 class="head-title">Próximos Cursos <img src="img/cursos.png" class="icon-index"></h2>
			<p class="text-index">As NR- normas regulamentadoras são um conjunto de condições e procedimentos, regidas pelo ministério do trabalho, que devem ser respeitadas pelas empresas públicas e privadas. Os cursos e treinamentos são voltados para os profissionais que praticam atividades que de forma efetiva será capacitado para desempenhar as atividades de forma segura e eficiente dentro do que rege a norma</p>
			<a href="" class="btn btn-dark btn-index">Conhecer cursos</a>
		</div>
		<div class="col-sm-4">
			<h2 class="head-title">Palestras <img src="img/palestras.png" class="icon-index"></h2>
			<p class="text-index">A Work treinamentos fornece as mais variadas palestras se aplicando sempre a sua real necessidade aonde os profissionais são altamente qualificados e tratam de assunto com experiência de causa, visando atingir o público da empresa com o objetivo de orientação e leva-lo ao conhecimento assuntos discutidos.</p>
			<a href="" class="btn btn-dark btn-index">Me informar sobre as palestras</a>
		</div>
		<div class="col-sm-4">
			<h2 class="head-title">Documentação <img src="img/documentacao.png" class="icon-index"></h2>
			<p class="text-index">O ministério do trabalho define através das normas regulamentadoras algumas documentações às empresas públicas e privadas. Cabe salientar que além de atender a essa legislação, as documentações servem para promover a segurança do trabalho no ambiente empresarial, deixando tudo dentro dos padrões estabelecidos</p>
			<a href="" class="btn btn-dark btn-index">Saiba mais</a>
		</div>	
	</div><!-- row -->	
	<div class="row contato-localizacao">
		<div class="col-sm-12">
			<h1 class="loca-cont">Localização/Contato</h1>			
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3688.113792060565!2d-47.581553085645666!3d-22.42474248525906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c7daecff22f9ff%3A0x42a2ea022f1bee2d!2sEstr.+dos+Costas%2C+750+-+Jardim+Inocoop%2C+Rio+Claro+-+SP%2C+13502-010!5e0!3m2!1spt-BR!2sbr!4v1538766628021" width="1650" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
	<div class="row contato-fundo">
		<form action="acts/acts.contato-index.php" method="post" enctype="multipart/form-data">
		  <div class="row cont-index">
		    <div class="col">
		      <input type="text" name="nome" id="nome" class="form-control form-cont-index" placeholder="Informe seu nome" data-error="Por favor, informe o nome." maxlength="255" required>
		    </div>
		    <div class="col">
		      <input type="email" name="email" id="email" class="form-control form-cont-index" placeholder="Informe seu e-mail" data-error="Por favor, informe o e-mail." maxlength="255" required>
		    </div>
		    <div class="col">
		      <input type="tel" name="telefone" id="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control form-cont-index" placeholder="Informe seu telefone" data-error="Por favor, informe o telefone." maxlength="16" required>
		    </div>		    
		  </div>
		  <div class="form-group form-cont-area-contato">		    
		    <textarea class="form-control form-area-index" name="mensagem" id="mensagem" rows="5" placeholder="Escreva sua mensagem..." data-error="Digite sua mensagem." required></textarea>
		  </div>
		  <button type="submit" class="btn btn-dark btn-lg btn-enviar">Enviar</button>
		</form>
	</div>
</div>	
<?php
	require_once('footer.php');
?>		

