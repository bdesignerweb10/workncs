<?php
require_once('header_login.php');
?>
<main class="mainlogin">
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 login-box">
				<div class="login-header">					
					<span class="head-login">Painel Work NCS</span>
				</div>
				<form id="form-login" data-toggle="validator" action="acts/acts.login.php" method="POST">
		  			<div class="form-group">		    			
						<label for="login">Usuário</label>
		    			<input type="text" class="form-control form-control-md" id="login" name="login" aria-describedby="login" placeholder="Digite seu usuário..." data-error="Por favor, informe o login." maxlength="120" required>
		    			<div class="help-block with-errors">
		    		</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" class="form-control form-control-md" id="senha" name="senha" placeholder="Digite sua senha..." data-error="Por favor, informe a senha." maxlength="120" required>
					</div>
					<div class="row">
			  			<div class="col-12">
			  				<div class="checkbox" style="margin-left: 20px;">
								<label>
									<input type="checkbox" id="lembrar" name="lembrar" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Mantenha-me conectado
								</label>
							</div>
			    		</div>
					</div>					
  					<button id="btn-login" type="submit" class="btn btn-success btn-md form-control" name="submit">
  						<i class="fas fa-home"></i> Entrar
  					</button>		
				</form>
			</div>
		</div><!-- row -->
	</div><!-- contatiner -->
</main>
<?php
require_once('footer.php');
?>