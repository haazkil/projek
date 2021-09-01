<?php

 
	session_start();

if(!isset($_SESSION["login"])){
	header("location: login.php");
	exit;
}


	require 'function.php';

	if (isset($_POST["submit"])) {


		if( tambah($_POST) > 0 ) {
			echo "
				<script>
					alert('data berhasil ditambahkan !');
					document.location.href = 'index.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('data gagal ditambahkan  !');
					document.location.href = 'index.php';
				</script>
				";
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Tambah data mahasiswa</title>
</head>
<body>

	<h1>Tambah data kintil mahasiswa</h1>
	

	<form action="" method="post" enctype="multipart/form-data">

		<ul>
			<li>
				<label for="nrp">nrp : </label>
				<input type="text" name="nrp" id="nrp" required="" autocomplete="off">
			</li>
			<li>
				<label for="nama">nama : </label>
				<input type="text" name="nama" id="nama" autocomplete="off">
			</li>
			<li>
				<label for="jurusan">jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" autocomplete="off">
			</li>
			<li>
				<label for="gambar">gambar : </label>
				<input type="file" name="gambar" id="gambar" autocomplete="off">
			</li>
			<li>
				<label for="email">email : </label>
				<input type="text" name="email" id="email" autocomplete="off">
			</li>
			<li>
				<button type="submit" name="submit"> Tambah Data</button>
			</li>
		</ul>
		
	</form>

</body>
</html>