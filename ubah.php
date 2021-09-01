<?php 
	
	require 'function.php';
	session_start();

if(!isset($_SESSION["login"])){
	header("location: login.php");
	exit;
}



	// ambil data di url 

	$id = $_GET["id"];

	//query data mahasiswa berdasarkan id

	$mh = query("SELECT * FROM coba WHERE id = $id")[0];

	if (isset($_POST["submit"])) {

		if( ubah($_POST) > 0 ) {
			echo "
				<script>
					alert('data berhasil diubah !');
					document.location.href = 'index.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('data gagal diubah  !');
					document.location.href = 'index.php';
				</script>
				";
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>ubah data mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="sb.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>

	
	

	<form action="" method="post" enctype="multipart/form-data">

		<input type="hidden" name="id" value="<?= $mh["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?= $mh["gambar"]; ?>">
	<div class="kin">
		<h1 class="dpn">ubah data mahasiswa
		<med class="sam"><?= $mh["nama"];?></med>
		</h1>

		
	<table>
		<tr class="su">
			<td class="n">
				<label for="nrp">Nrp  </label>
			</td>
			<td class="l">
				<input type="text" name="nrp" id="nrp" required="" placeholder="<?= $mh["nrp"];?>" class="o">
			</td>
		</tr >
		<tr class="su">
			<td class="n">
				<label for="nama">Nama  </label>
			</td>
			<td class="l">
				<input type="text" name="nama" id="nama" placeholder="<?= $mh["nama"];?>" class="o">
			</td>
		</tr>
		<tr class="su">
			<td class="n"><label for="jurusan" >Jurusan </label></td>
			<td class="l">
				<input type="text" class="o"name="jurusan" id="jurusan" placeholder="<?= $mh["jurusan"];?>">
			</td>
		</tr>
		<tr class="su">
			<td class="n"><label for="gambar"> </label>
		<img src="img/<?= $mh['gambar'];?>" width="80"></td>
			<td class="l"><input type="file" name="gambar" id="gambar" class="o"></td>
		</tr>
		<tr class="su">
			<td class="n"><label for="email">Email  </label></td>
			<td class="l"><input type="text" name="email" id="email" placeholder="<?= $mh["email"];?>" class="o"></td>
		</tr>
		<tr class="su">
			<td class="but"><button type="submit" name="submit"> Ubah Data</button>
		</td>
		</tr>
	</table>
	</div>
	</form>

</body>
</html>