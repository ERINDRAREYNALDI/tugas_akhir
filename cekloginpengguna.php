<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from tbl_pengguna where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$ambil_nama_pengguna = mysqli_query($koneksi,"select * from tbl_pengguna where username='$username' and password='$password'");
	while ($row = $ambil_nama_pengguna->fetch_assoc()) {
	    $nama_pengguna = $row['nama_pengguna'];
	    $id_pengguna = $row['id_pengguna'];
	    $status = $row['status'];
	}
	if($status == 'terblokir'){
		header("location:login_pengguna.php?pesan=terblokir");	
	}
	else{
		$_SESSION['nama_pengguna'] = $nama_pengguna;
		$_SESSION['id_pengguna'] = $id_pengguna;
	    $_SESSION['username_pengguna'] = $username;
	    $_SESSION['status_pengguna'] = "login";
	    header("location:index.php");
	}
}else{
    header("location:login_pengguna.php?pesan=gagal");
}
?>
?>