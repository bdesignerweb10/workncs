<div class="container-fluid">
	<div class="row footer-fundo">
		<div class="col-sm-3">
		<h4 class="footer-title">Acesso Rápido</h4>
			<nav class="nav flex-column footer-menu">				
				<a class="nav-link nav-footer" href="consultoria.php">Consultoria</a>
				<a class="nav-link nav-footer" href="cursos.php">Cursos</a>
				<a class="nav-link nav-footer" href="quem-somos.php">Quem Somos</a>
				<a class="nav-link nav-footer" href="contato">Contato</a>
			</nav>
		</div>	
		<div class="col-sm-5">
		<h4 class="footer-title">Como nos encontrar</h4>
			<nav class="nav flex-column footer-menu">
			 	<a class="nav-link nav-footer active footer-contato" href="#"><strong>Endereço:</strong> Estrada dos costas, 750 Jardim das Palmeiras</a>
			  	<a class="nav-link nav-footer footer-contato" href="#"><strong>Telefone:</strong> (19) 98456-7169</a>
			  	<a class="nav-link nav-footer footer-contato" href="#"><strong>E-mail:</strong> contato@worktreinamentos.com.br</a>	
			  	<a class="nav-link nav-footer footer-contato" href="#">Desenvolvido por <strong>Bruno Gomes</strong> - (19) 99897-0090</a>			 
			</nav>
		</div>
		<div class="col-sm-4">
		<h4 class="footer-title">Work ncs</h4>
			<nav class="nav flex-column footer-menu">
				<a class="nav-link nav-footer active <?php echo basename($_SERVER['PHP_SELF']) == '#' ? ' nav-active' : ''; ?>" href="#">Redes Sociais</a>							  
			</nav>	
			<div class="social">				
				<a href="https://www.toopics.com/otacilioworktreinamentos" target="_blank"><img class="facebook" src="img/instagram.png"></a>	
			</div>					
		</div>	
	</div>
</div>
<script src="js/main.js"></script>
<script src="js/lightbox-plus-jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script>
	$("#telefone").mask("(00) 0000-00009");
</script>
</body>
</html>