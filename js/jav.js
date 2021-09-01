//ambil elemen yang dibutuhkan

var keyword = document.getElementById('keyword');
var tombolcari = document.getElementById('tombolcari');
var container = document.getElementById('container');


keyword.addEventListener('keyup', function(){
	
	//buat object ajax
	var xhr = new XMLHttpRequest();

	//cek kesiapan ajax
	xhr.onreadystatechange = function() {
		if (xhr.readystate == 4 && xhr.status == 200){
			console.log('memek');
		}
	}


	//eksekusi ajax
	xhr.open('GET', 'ajax/coba.txt', true);
	xhr.send();

});