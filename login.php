<?php
 
session_start();

require 'database.php';
if(!empty($_POST['email']) && !empty($_POST['password'])):

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email= :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';
	
	if(count($results) > 0 && password_verify($_POST['password'],$results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header( 'Location: homepage.php' );
	} else{
		$message = 'Sorry, those credentials do not match';
	}
endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Below</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css ">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>


	<div class="header">
	<h1><a href="/">Exam Partner</a></h1>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Login</h1> 
	<span>or <a style="text-decoration: none;" href="register.php">Register here</a></span>

	<form action="login.php" method="POST">

		<input type="text" placeholder="Enter your Email" name="email">
		<input type="password" name="password" placeholder="Enter your password">	

		<input type="submit">	
	</form>
 
</body>
</html>