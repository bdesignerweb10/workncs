<?php
	require_once('header.php');
?>
	<div class="row-fluid capa">		
	</div><!-- row-->	
</div><!-- container-fluid -->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4">
			<h2 class="head-title">Próximos Cursos <img src="img/cursos.png" class="icon-index"></h2>
			<p class="text-index">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet dui diam. Proin tempus vel nisl ac hendrerit. Etiam nulla enim, aliquam et lorem et, sollicitudin laoreet risus. Nunc nulla lorem, gravida eget porta quis, pellentesque in nibh. Cras in mattis urna, sed laoreet dui. Nam at blandit lacus, non tincidunt ligula. Quisque a dolor a enim pharetra maximus vel vel sem. Proin diam enim, vestibulum in metus vel, semper sodales neque. Etiam sodales semper risus vel egestas. Vivamus consequat pulvinar vulputate. Suspendisse potenti. Maecenas dictum, turpis nec consequat molestie, nunc velit sodales augue, et auctor ante lectus at dolor. Integer vestibulum a tortor eget mattis. Curabitur vitae nulla nibh.</p>
			<a href="" class="btn btn-dark btn-index">Conhecer cursos</a>
		</div>
		<div class="col-sm-4">
			<h2 class="head-title">Palestras <img src="img/palestras.png" class="icon-index"></h2>
			<p class="text-index">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet dui diam. Proin tempus vel nisl ac hendrerit. Etiam nulla enim, aliquam et lorem et, sollicitudin laoreet risus. Nunc nulla lorem, gravida eget porta quis, pellentesque in nibh. Cras in mattis urna, sed laoreet dui. Nam at blandit lacus, non tincidunt ligula. Quisque a dolor a enim pharetra maximus vel vel sem. Proin diam enim, vestibulum in metus vel, semper sodales neque. Etiam sodales semper risus vel egestas. Vivamus consequat pulvinar vulputate. Suspendisse potenti. Maecenas dictum, turpis nec consequat molestie, nunc velit sodales augue, et auctor ante lectus at dolor. Integer vestibulum a tortor eget mattis. Curabitur vitae nulla nibh.</p>
			<a href="" class="btn btn-dark btn-index">Me informar sobre as palestras</a>
		</div>
		<div class="col-sm-4">
			<h2 class="head-title">Documentação <img src="img/documentacao.png" class="icon-index"></h2>
			<p class="text-index">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet dui diam. Proin tempus vel nisl ac hendrerit. Etiam nulla enim, aliquam et lorem et, sollicitudin laoreet risus. Nunc nulla lorem, gravida eget porta quis, pellentesque in nibh. Cras in mattis urna, sed laoreet dui. Nam at blandit lacus, non tincidunt ligula. Quisque a dolor a enim pharetra maximus vel vel sem. Proin diam enim, vestibulum in metus vel, semper sodales neque. Etiam sodales semper risus vel egestas. Vivamus consequat pulvinar vulputate. Suspendisse potenti. Maecenas dictum, turpis nec consequat molestie, nunc velit sodales augue, et auctor ante lectus at dolor. Integer vestibulum a tortor eget mattis. Curabitur vitae nulla nibh.</p>
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
		      <input type="text" name="nome" id="nome" class="form-control form-cont-index" placeholder="Nome">
		    </div>
		    <div class="col">
		      <input type="email" name="email" id="email" class="form-control form-cont-index" placeholder="E-mail">
		    </div>
		    <div class="col">
		      <input type="number" name="telefone" id="telefone" class="form-control form-cont-index" placeholder="Telefone">
		    </div>		    
		  </div>
		  <div class="form-group form-cont-area-contato">		    
		    <textarea class="form-control form-area-index" name="mensagem" id="mensagem" rows="5" placeholder="Escreva sua mensagem..."></textarea>
		  </div>
		  <button type="submit" class="btn btn-dark btn-lg btn-enviar">Enviar</button>
		</form>
	</div>
</div>	
<?php
	require_once('footer.php');
?>		

