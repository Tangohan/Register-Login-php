<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Votre pseudo est trop cours';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Pseudo déjà utilisé';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Votre pseudo est trop cours';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Mot de passe trop faibles.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Les mots de passe ne sont pas les mêmes';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Veuillez entrez une adresse mail valide';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email déjà utilisé.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $db->lastInsertId('memberID');

			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "<p>Merci de vous êtres enregistré</p>
			<p>Pour activer votre compte, merci de cliquer sur le lien suivant: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Nightwalker </p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: index.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//Nom de la page
$title = 'League of boosted';

//Importe l'header
require('layout/header.php');
?>


	<!-- Demande d'inscriptions -->

<header id="header">
				<br />
				<br />
				<h1>League of Boosted </h1>
				<p>Bienvenue invocateur/invocatrice, pour rejoindre le Champ de Justice<br />
				tu dois d'abord t'enregistrer.</p>
				</header>
				<br />
				<br />
				<br />
				<br />
				<br />
	
	<form role="form" method="post" action="" autocomplete="off">
	<hr />


				<?php
				// Regarde les erreurs
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Inscriptions réussie, merci de regarder vos email</h2>";
				}
				?>


					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
		<br />
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
		<br />
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
		<br />
					<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
		<br />
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>  <p>J'ai déjà un compte, <a href="login.php">connexion</a>.</p>
				</div>			
			</form>
		<!-- /Demande d'inscriptions -->
<br />
		
	
   <div id="go-top">
		<a class="smoothscroll" title="Back to Top" href="#top"><i class="fa fa-long-arrow-up"></i></a>
	</div>

   <!-- preloader
   ================================================== -->
   <div id="preloader"> 
    	<div id="loader"></div>
   </div> 

   <!-- Java Script
   ================================================== --> 
   <script src="js/jquery-2.1.3.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>
   <script src="assets/js/main.js"></script>


<?php

require('layout/footer.php');
?>
