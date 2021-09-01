<?php

session_start(); 
require 'function.php';


// cek cookie 

if (isset($_COOKIE['id']) && isset($_COOKIE['pw'])) {
		$id = $_COOKIE['id'];
		$pw = $_COOKIE['pw'];

		// ambil username berdasarkan id 

		$result = mysqli_query($db, "SELECT username FROM user WHERE id = $id" );
		$row = mysqli_fetch_assoc($result);


		// cek cookie dan username

		if($pw === hash('sha256',$row['username'])) {
			$_SESSION['login'] = true;
		}




	}
if(isset($_SESSION["login"])) {
	header("location: index.php");
	exit ;
}



if(isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];


	$result = mysqli_query($db,"SELECT * FROM user WHERE username = '$username'");

	if (mysqli_num_rows($result) === 1) {


		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {

			//set session

			$_SESSION["login"] = true;

			//cek remember me 
			if (isset($_POST['remember'])) {

				setcookie('id',$row['id'], time()+60);
				setcookie('pw',hash('sha256', $row['username']),time()+60);
			}


			header("location: index.php");
			exit;
		}
	} 

	$error = true;


}


 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Halaman login</title>
	<link rel="stylesheet" type="text/css" href="sx.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
	<?php if (isset($error)) : ?>

		<h1 class="salah"style="color:white; font-style: italic;> "> username / password salah </h1>
	<?php endif; ?>

	<form action="" method="post">
		<div class="logins">
			<div class="avatar">
				<i class="fa fa-user"></i>
			</div>
			<h2>Ｌｏｇｉｎ</h2>

			<div class="box-login">
			<i class="fa fa-user"></i>
			<input type="text" name="username" id="username" placeholder="Username">
			</div>
			<div class="box-login">
			<i class="fas fa-lock"></i>
			<input type="password" name="password" id="password" placeholder="Password">
			</div>

		<input class="rem" type="checkbox" name="remember" id="remember">
		<label for="remember">Remember me: </label>
		<br>
		<button type="submit" name="login" class="tombol"> Sign In</button>
		<div class="bottom">
			<a href="regis.php">Register</a>
			<a href="">Forgot Password</a>
		</div>

		</div>
		


		
	</form>


</body>
</html>