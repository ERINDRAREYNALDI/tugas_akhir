<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi, "SELECT * FROM tbl_pesanan INNER JOIN tbl_pengguna ON tbl_pesanan.id_pengguna =  tbl_pengguna.id_pengguna INNER JOIN tbl_studio ON tbl_pesanan.id_studio = tbl_studio.id_studio");
$html = '<center><h3>Daftar Riwayat Penyewaan Studio Musik</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
	<tr>
	<th>No</th>
	<th>ID Pesanan</th>
    <th>Studio</th>
    <th>Nama Pemesan</th>
    <th>Telp Pemesan</th>
    <th>Tanggal</th>
    <th>Mulai</th>
    <th>Selesai</th>
    <th>Durasi</th>
    <th>Total Harga</th>
	</tr>';
$no=1;
while ($row = mysqli_fetch_array($query)) {
	$html .= "<tr>
	<td>".$no."</td>
	<td>".$row['id_pesanan']."</td>
	<td>".$row['nama_studio']."</td>
	<td>".$row['nama_pengguna']."</td>
	<td>".$row['no_telp']."</td>
	<td>".$row['tanggal']."</td>
	<td>".$row['jam_mulai']."</td>
	<td>".$row['jam_berakhir']."</td>
	<td>".$row['durasi']."</td>
	<td>".$row['total_harga']."</td>
	</tr>";
	$no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML ke PDF
$dompdf->render();
// Melakukan output file PDF
$dompdf->stream('laporan data penyewaan studio.pdf');
?>