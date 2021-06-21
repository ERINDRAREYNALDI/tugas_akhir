<?php
session_start();

if(!isset($_SESSION['status_admin'])){
    header("location: login_admin.php");
    exit;
}

include 'koneksi.php';

if(isset($_GET['id_pengguna'])){

	// Memperbarui data
	$sql= "UPDATE tbl_pengguna SET status='terblokir' WHERE id_pengguna='$_GET[id_pengguna]'";
	if(mysqli_query($koneksi, $sql)){
		echo "Berhasil Memblokir Pengguna";
		//pindah ke tugas3main.php
		echo "<meta HTTP-EQUIV='REFRESH' content='1; url=daftar_blokir.php'>";
	} else{
		echo "Error: ". $sql ."<br>". mysqli_error($koneksi);
	}
}
else{
	header("location:tables.php");
    exit;
}
?>