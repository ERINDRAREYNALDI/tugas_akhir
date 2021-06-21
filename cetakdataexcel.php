<?php
include('koneksi.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet=new Spreadsheet();
$sheet=$spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'ID Pesanan');
$sheet->setCellValue('C1', 'Studio');
$sheet->setCellValue('D1', 'Nama Pemesan');
$sheet->setCellValue('E1', 'Telp. Pemesan');
$sheet->setCellValue('F1', 'Tanggal');
$sheet->setCellValue('G1', 'Mulai');
$sheet->setCellValue('H1', 'Selesai');
$sheet->setCellValue('I1', 'Durasi');
$sheet->setCellValue('J1', 'Total Harga');

$query=mysqli_query($koneksi, "SELECT * FROM tbl_pesanan INNER JOIN tbl_pengguna ON tbl_pesanan.id_pengguna =  tbl_pengguna.id_pengguna INNER JOIN tbl_studio ON tbl_pesanan.id_studio = tbl_studio.id_studio");
$i=2;
$no=1;
while ($row=mysqli_fetch_array($query)) {
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['id_pesanan']);
	$sheet->setCellValue('C'.$i, $row['nama_studio']);
	$sheet->setCellValue('D'.$i, $row['nama_pengguna']);
	$sheet->setCellValue('E'.$i, $row['no_telp']);
	$sheet->setCellValue('F'.$i, $row['tanggal']);
	$sheet->setCellValue('G'.$i, $row['jam_mulai']);
	$sheet->setCellValue('H'.$i, $row['jam_berakhir']);
	$sheet->setCellValue('I'.$i, $row['durasi']);
	$sheet->setCellValue('J'.$i, $row['total_harga']);
	$i++;
}

$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
$i=$i-1;
$sheet->getStyle('A1:J'.$i)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Report Data Persewaan Studio.xlsx');
?>
<!DOCTYPE html>
<html>
<head>
	<meta HTTP-EQUIV="REFRESH" content="2; url=tables.php">
	<title>Berhasil Cetak Excel</title>
</head>
<body>
<br><br><br><center><h1>Berhasil Simpan Data</h1></center>
</body>
</html>