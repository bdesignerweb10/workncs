<?php
	require_once('header.php');
?>
</div><!-- container-fluid -->
	<div class="container-fluid">
		<div class="row contato-fundo-contato">
			<div class="col-sm-6">
				<form action="acts/acts.contato.php" method="post" enctype="multipart/form-data">
				  <div class="row cont-index-contato">
				    <div class="col">
				      <input type="text" name="nome" id="nome" class="form-control form-cont-index-contato" placeholder="Informe seu nome" data-error="Por favor, informe o nome." maxlength="255" required>
				    </div>
				  </div>
				  <div class="row cont-index-contato">  
				    <div class="col-8">
				      <input type="email" name="email" id="email" class="form-control form-cont-index-contato" placeholder=" informe seu e-mail" data-error="Por favor, informe o e-mail." maxlength="255" required>
				    </div>
				    <div class="col-4">
				      <input type="tel" name="telefone" id="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control form-cont-index-contato" placeholder="Informe seu telefone" data-error="Por favor, informe o telefone." maxlength="16" required>
				    </div>		    
				  </div>
				  <div class="row cont-index-contato">
				    <div class="col">
				      <input type="text" name="assunto" id="assunto" class="form-control form-cont-index-contato" placeholder=" Informe o assunto" data-error="Por favor, informe o assunto." maxlength="120" required>
				    </div>
				  </div>
				  <div class="form-group form-cont-area-contato">		    
				    <textarea class="form-control" name="mensagem" id="mensagem" rows="5" placeholder="Escreva sua mensagem..." data-error="Escreva sua mensagem..." required></textarea>
				  </div>
				  <button type="submit" class="btn btn-dark btn-lg btn-enviar">Enviar</button>
				</form>
			</div>		

			<div class="col-sm-6">
				<div class="row cont-index-contato">
					<h3 class="title-contato">Entre em contato pelo telefone:</h3>
					<div class="col-sm-12 email-fone">
						<img src="img/fone.png"> <strong>(19) 98456-7169</strong>
					</div>
					<div class="col-sm-12 email-fone">	
						<img src="img/email.png"> <strong>contato@worktreinamentos.com.br</strong>
					</div>					
				</div>
				<div class="row local">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3688.113792060565!2d-47.581553085645666!3d-22.42474248525906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c7daecff22f9ff%3A0x42a2ea022f1bee2d!2sEstr.+dos+Costas%2C+750+-+Jardim+Inocoop%2C+Rio+Claro+-+SP%2C+13502-010!5e0!3m2!1spt-BR!2sbr!4v1538766628021" width="1000" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
<?php
	require_once('footer.php');
?>	