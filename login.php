<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):

//$active = isset($_POST['active']) ? 1 : 0;
//
//$sql = "INSERT INTO users (checkbox) VALUES (:checkbox)";
//$stmt = $conn->prepare($sql);
//$stmt->bindParam(':checkbox', $_POST['checkbox']);

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: index.php");

	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Buddy</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<h5>Login Buddy</h5>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Login</h1>
	<span>Don't have an account? <a href="register.php">Register here</a></span>

		<div class="container">

			<form name="login" id="login" class="form-signin" method="POST" action="login.php">

				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>

				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
<!--
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkbox" value="1"> Remember me
                    </label>
                </div>
-->

				<button class="btn btn-lg btn-primary" type="submit" value="login">Sign in</button>
			</form>

		</div>

</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
</html>
