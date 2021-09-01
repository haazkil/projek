<?php 
session_start();

if(!isset($_SESSION["login"])){
	header("location: login.php");
	exit;
}

require 'function.php';

//pagination


//konfigurasi 
$jumlahdataperhalaman = 4 ;
$jumlahdata = count(query("SELECT * FROM coba"));
$jumlahhalaman = ceil($jumlahdata/$jumlahdataperhalaman);
//ternary 
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
//awaldata
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;


$xc = query("SELECT * FROM coba LIMIT $awaldata, $jumlahdataperhalaman");

//jika tombol cari di klik 

if (isset($_POST["cari"])){
	$xc = cari($_POST["keyword"]); 
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title> web admin </title>
	<link rel="stylesheet" type="text/css" href="ss.css">
</head>
<body>

<h1 class="k">Daftar  Mahasiswa </h1>

<div class="tam">
	<button> 
		<a href="tambah.php">Tambah</a>
	</button>
</div>

<form action="" method="post" class="from">

	<input type="text" name="keyword" size="40" autofocus="" placeholder="masukan keyword pencarian.." autocomplete="off" id="keyword">
	<button type="submit" name="cari" id="tombolcari">cari!</button>
</form>
<div class="nom">
 <!-- navigasi -->
<?php if ($halamanaktif > 1): ?>
	 <a href="?halaman=<?= $halamanaktif - 1;?>"> &laquo </a>
<?php endif; ?>

 <?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
 	<?php if($i == $halamanaktif) : ?>
 	<a href="?halaman=<?= $i; ?>" style = "font-weight:bold; color:black;"><?php echo "$i";?></a>
 	<?php else : ?>
 		<a href="?halaman=<?= $i; ?>"><?php echo "$i";?></a>
 	<?php endif; ?>
 <?php endfor; ?>
<?php if ($halamanaktif < $jumlahhalaman): ?>
	<a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo </a>

<?php endif ?>
</div>
 

<div id="contain"> 

<table border="1" cellspacing="0" cellpadding="10" class="tabel" style="margin-left:auto;margin-right:auto;" border="1">
	
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Nrp</th>
		<th>Nama</th>
		<th>email</th>
		<th>jurusan</th>
	</tr>
	<?php $i = 1; ?>

	<?php foreach ($xc as $x) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $x["id"];?>">ubah</a> |
			<a href="hapus.php?id=<?= $x["id"];?>" onclick=" return confirm('yakin?');">Hapus</a>
		</td>
		<td><img src="img/<?= $x ["gambar"] ;?>" width="50px"></td>
		<td><?= $x ["nrp"]; ?></td>
		<td><?= $x ["nama"] ?></td>
		<td><?= $x ["email"] ?></td>
		<td><?= $x ["jurusan"] ?></td>
	</tr>
	<?php $i ++ ?>
<?php endforeach; ?>

</table>
<div class="log">
	<button>
<a href="logout.php">Logout</a>
</button>
</div>
</div>
<script src="js/jav.js"></script>


</body>
</html>