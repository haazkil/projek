<?php 
$db = mysqli_connect("localhost", "root","","mahasiswa");




function query($query) {
	 global $db;
	 $result = mysqli_query($db, $query);
	 $row = [];
	 while($row = mysqli_fetch_assoc($result)){
	 	$rows[] = $row;
	 }

	 return $rows;
}


function tambah($data) {
		global $db;
		$nrp= htmlspecialchars($data["nrp"]);
		$nama= htmlspecialchars($data["nama"]);
		$email= htmlspecialchars($data["email"]);
		$jurusan= htmlspecialchars($data["jurusan"]);
		// upload gambar 
		$gambar = upload();

		if(!$gambar){
			return false;
		}
		
		// $gambar= htmlspecialchars($data["gambar"]);


		$query = "INSERT INTO coba
				VALUES 
				('','$nrp','$nama','$email','$jurusan','$gambar')
				 ";
		mysqli_query($db, $query);


		return mysqli_affected_rows($db);


}

function upload() {
	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang di upload

	if ($error === 4 ){
		echo "<script>
				alert('pilih gambar terlebih dahulu');
			  </script>";
		return false;
	}

	//upload hanya gambar
	$ekstensiv = ['jpg','jpeg','png','webp'];
	$ekstensia = strtolower(pathinfo($namafile,PATHINFO_EXTENSION));

	if( !in_array($ekstensia, $ekstensiv))
	{
			echo "<script>
				alert('upload harus bentuk jpg,jpeg,png,webp');
			  </script>";
		return false;
	}

	//cek jika ukurannya terlalu besar

	if($ukuranfile > 10000000) {

				echo "<script>
				alert('ukuran gambar terlalu besar');
			  </script>";
		return false;
	}

	// lolos pengecekan 
	// generate nama gambar baru
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensia;

	move_uploaded_file($tmpname, 'img/'.$namafilebaru);
	

	return $namafilebaru;
}

function hapus($id){
	global $db;
	mysqli_query($db, "DELETE FROM coba WHERE id = $id");
	return mysqli_affected_rows($db);
}

function ubah($data){
	global $db;
		$id = $data["id"];
		$nrp= htmlspecialchars($data["nrp"]);
		$nama= htmlspecialchars($data["nama"]);
		$email= htmlspecialchars($data["email"]);
		$jurusan= htmlspecialchars($data["jurusan"]);
		$gambarlama = htmlspecialchars($data["gambarlama"]);
		// cek apakah user pilih gambar baru atau tidak 
		if($_FILES['gambar']['error'] === 4) {
			$gambar = $gambarlama;
		} else {
			$gambar = upload();
		}
	


		$query = "UPDATE coba SET

				 nrp = '$nrp',
				 nama = '$nama',
				 email = '$email',
				 jurusan = '$jurusan',
				 gambar = '$gambar'

				 WHERE id = $id 

				 ";
		mysqli_query($db, $query);


		return mysqli_affected_rows($db);


}


function cari($keyword){
	$query = "SELECT * FROM coba WHERE 
		nama LIKE '$keyword%' OR 
		nrp LIKE '$keyword%' OR 
		email LIKE '$keyword%' OR 
		jurusan LIKE '$keyword%' 

	";

	return query($query);
	
}

function registrasi($data) {
	global $db;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($db, $data["password"]);
	$password2 = mysqli_real_escape_string($db, $data["password2"]);

	//cek username sudah ada atau belum

	$result = mysqli_query($db, "SELECT username FROM user WHERE username ='$username'");

	if(mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar')
			  </script>";
			  return false;
	}


	// cek konfirmasi password

	if ($password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
				</script>
		";
		return false;
	}

	// enkripsi data / password

	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user baru ke database

	mysqli_query($db, "INSERT INTO user VALUES ('','$username','$password')");

	return mysqli_affected_rows($db);

    }


 ?>