<?php
include 'koneksi.php';
// menyimpan data ke dalam variabel
$username=$_POST['username'];
$password=$_POST['password'];
$nama=$_POST['nama'];
$telp=$_POST['telp'];
$email=$_POST['email'];
// query SQL untuk insert data
$query="INSERT INTO tbl_pengguna SET username='$username', password='$password', nama_pengguna='$nama', no_telp='$telp', email='$email'";
mysqli_query($koneksi, $query);
// mengalihkan ke halaman Login
header("location:login_pengguna.php?pesan=daftar");
?>