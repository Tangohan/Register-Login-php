<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = '';


?>
<title>Page d'accueil - League of Boosted</title>
<link rel="stylesheet" href="pagemember/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="pagemember/assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Intro -->
					

				<!-- Header -->
					<header id="header">
						<a href="index.php" class="logo"><?php echo $_SESSION['username']; ?></a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li class="active"><a href="index.php">Accueil</a></li>
							<li><a href="profils.php"><?php echo $_SESSION['username']; ?></a></li>
							<li><a href="logout.php">Déconnexion</a></li>
						</ul>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

								<!-- Options de profils -->
							<article class="post featured">
											
									<h3>Votre image</h3>
									<p><span class="image left"><img src="https://image.noelshack.com/fichiers/2017/37/2/1505236649-profils.jpg" alt="Image de profils" /></span>
									<b>Pour modifier votre image, vous devez passer par notre launcher. Lorem ipsum dolor sit accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Vestibulum ante ipsum primis in faucibus magna blandit adipiscing eu felis iaculis.</p></b>
								</header>
								
							</article>											
				<!-- Copyright -->
					<div id="copyright">
						<ul><li>&copy; League of Boosted</li><li>Design: <a href="https://html5up.net">Tangohan & HTML5UP</a></li></ul>
					</div>

			</div>

		<!-- Scripts -->
			<script src="pagemember/assets/js/jquery.min.js"></script>
			<script src="pagemember/assets/js/jquery.scrollex.min.js"></script>
			<script src="pagemember/assets/js/jquery.scrolly.min.js"></script>
			<script src="pagemember/assets/js/skel.min.js"></script>
			<script src="pagemember/assets/js/util.js"></script>
			<script src="pagemember/assets/js/main.js"></script>


   	
 <div id="preloader"> 
    	<div id="loader"></div>
   </div> 

   <!-- Java Script
   ================================================== --> 
   <script src="js/jquery-2.1.3.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>


<?php 
//include header template
require('layout/footer.php'); 
?>
