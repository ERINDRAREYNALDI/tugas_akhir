<?php
session_start();

include 'koneksi.php';
$id_studio = $_POST['studio'];
$id_pengguna = $_SESSION['id_pengguna'];
$durasi = $_POST['durasi'];
$jam_mulai = $_POST['jam'];
$jam_berakhir = date('H:i:s', strtotime($_POST['durasi'].' hour', strtotime($_POST['jam'])));
$tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
$jam_tutup = "21:01:00";
$jam_buka = "09:00:00";
$tanggal_sekarang = date_create();
                                            
if ($id_studio == 1) {
    $harga = 35000 * $durasi;
}   
else if ($id_studio == 2) {
    $harga = 50000 * $durasi;
}
else if ($id_studio == 3) {
    $harga = 100000 * $durasi;
}

$tanggal_str = date_create($tanggal);
$perbedaan = date_diff($tanggal_sekarang, $tanggal_str);
//$selisih_tanggal = $perbedaan->d;
$selisih_tanggal = $perbedaan->format('%R%a');

//$data = mysqli_query($koneksi,"select * from tbl_pesanan where id_studio='$id_studio' and tanggal='$tanggal'");

$data = mysqli_query($koneksi,"select * from tbl_pesanan where id_studio='$id_studio' and tanggal='$tanggal' and ('$jam_mulai' between jam_mulai and jam_berakhir or '$jam_berakhir' between jam_mulai and jam_berakhir)");

$cek_data = mysqli_num_rows($data);

if ($selisih_tanggal < 0) {
    header("location:sewa_studio.php?pesan_sewa=tanggal_salah");
}
else if ($cek_data > 0) {
    header("location:sewa_studio.php?pesan_sewa=sudah_terpesan");
}
// else if (!($jam_berakhir < strtotime($jam_buka) || $jam_berakhir > strtotime($jam_tutup))){
//     echo "Maksimal Jam 9 ".$jam_berakhir;
// }
else if($jam_mulai == "09:00:00" && $durasi > 12){
    //echo " selisihnya adalah " .$selisih_tanggal;
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "10:00:00" && $durasi > 11){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "11:00:00" && $durasi > 10){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "12:00:00" && $durasi > 9){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "13:00:00" && $durasi > 8){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "14:00:00" && $durasi > 7){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "15:00:00" && $durasi > 6){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "16:00:00" && $durasi > 5){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "17:00:00" && $durasi > 4){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "18:00:00" && $durasi > 3){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else if($jam_mulai == "19:00:00" && $durasi > 2){
    header("location:sewa_studio.php?pesan_sewa=salah_jam");
}
else{
    $query="INSERT INTO tbl_pesanan SET id_pengguna='$id_pengguna', id_studio='$id_studio', tanggal='$tanggal', jam_mulai='$jam_mulai', jam_berakhir='$jam_berakhir', durasi='$durasi', total_harga='$harga'";

    mysqli_query($koneksi, $query);
    // mengalihkan ke halaman Index
    header("location:index.php?pesan_sewa=sukses_pesan");
}
?>