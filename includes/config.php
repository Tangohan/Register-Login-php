<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','mysql-leagueofboosted.alwaysdata.net');
define('DBUSER','143547_ajax');
define('DBPASS','Tt05032001');
define('DBNAME','leagueofboosted_bdd');


//application address
define('DIR','http://leagueofboosted.fr/');
define('SITEEMAIL','league-of-boosted@gmail.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
