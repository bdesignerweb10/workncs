<?php
	require_once("../acts/connect.php");
	
	if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) ||
	$_SESSION['usu_nivel'] == "3" || $_SESSION["usu_id"] == "0") header('Location: ./');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Consultoria e treinamentos" />

	<meta name="keywords" content="consultoria, treinamentos, work, ncs" />
	<meta name="author" content="Bruno Gomes"/>

	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />

	<link rel="apple-touch-icon" sizes="57x57" href="../img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="../img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
	<link rel="manifest" href="../img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="../img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<title>Work NCS</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-toggle.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" integrity="sha384-VY3F8aCQDLImi4L+tPX4XjtiJwXDwwyXNbkH7SHts0Jlo85t1R15MlXVBKLNx+dj" crossorigin="anonymous">
</head>
<body>
	<nav>
		<div class="sidebar">
			<div class="sidebar-header">
				<img src="../img/logo-work-65.png" alt="Logo Cartola">
			</div><!-- sidebar-header -->

			<ul class="nav">
				<li class="nav-item">					
					<a href="home" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? ' nav-active' : ''; ?>">
					<i class="fas fa-home"></i>	
					Home
					</a>
				</li>
				<li class="nav-item">					
					<a href="cursos" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'cursos.php' ? ' nav-active' : ''; ?>">
					<i class="fas fa-graduation-cap"></i>	
					Cursos
					</a>
				</li>
				<li class="nav-item">					
					<a href="consultoria" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'consultoria.php' ? ' nav-active' : ''; ?>">
					<i class="fas fa-briefcase"></i>
					Consultoria
					</a>
				</li>	
				<li class="nav-item">					
					<a href="inscricao" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'inscricao.php' ? ' nav-active' : ''; ?>">
					<i class="fas fa-list-ul"></i>
					Inscrição
					</a>
				</li>				
			</ul>
		</div><!-- sidebar -->
	</nav>
	<header>
		<div class="header">
			<div class="container">
				<div class="offcanvas">
					<a href="#" class="js-open-sidebar item">
						<i class="fa fa-bars"></i>
					</a>
				</div><!-- offcanvas -->

				<div class="liga">					
					<p>
						<span class="mark hidden-xs-down">
							<?php echo strftime('Olá, hoje é %d de %B de %Y', strtotime('today')); ?>
						</span>
					</p>
				</div><!-- liga -->
				<div class="liga-logo">
					<div class="dropdown">
						<div class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mark hidden-xs-down"><?php echo $_SESSION["usu_nome"] ?></span>
							<span class="mark">
								<i class='fa fa-user'></i>								
							</span>
						</div>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    						<div class="dropdown-item"><a id="logout" href="#">Sair</a></div>
    					</div>	
					</div>
				</div><!-- liga-logo -->
			</div><!-- container -->	
		</div><!-- header -->
	</header>