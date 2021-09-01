<?php 

 	require 'function.php';

	if(isset($_POST["register"])){


		if(registrasi($_POST) > 0 ) {
			echo "<script>
					alert('user baru telah ditambahkan !');
					</script>
			";
		} else {
			echo mysqli_error($db);
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" type="text/css" href="sc.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>


	


	<form action="" method="post">
		<div class="regis">
			<h1>Registrasi</h1>
			<div class="user">
				<label for="username">Username : </label>
				<input type="text" name="username" id="username" autocomplete="off"placeholder="username">
			</div>
			<div class="user">
				<label for="password">Password : </label>
				<input type="password" name="password" id="password" placeholder="password">
			</div>
			<div class="user2">
				<label for="password2"> Confirm  : </label>
				<input type="text" name="password2" id="password2"placeholder="konfirmasi pasword" >
			</div>
				<button type="submit" name="register">Register !</button>
		</div>
				


	</form>

</body>
</html>