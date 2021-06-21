<?php
session_start();

if(!isset($_SESSION['status_admin'])){
    header("location: login_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Daftar Pesanan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="tables.php">Dashboard Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Daftar Pemesanan
                            </a>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Chart Pemesanan
                            </a>
                            <a class="nav-link" href="daftar_blokir.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Daftar Blokir
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['username'];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar Pemesanan</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Data Pemesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
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
                                            <th>Blokir Pengguna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include 'koneksi.php';
                                            $pesanan=mysqli_query($koneksi, "SELECT * FROM tbl_pesanan INNER JOIN tbl_pengguna ON tbl_pesanan.id_pengguna =  tbl_pengguna.id_pengguna INNER JOIN tbl_studio ON tbl_pesanan.id_studio = tbl_studio.id_studio");
                                            $no=1;
                                            foreach ($pesanan as $row) {
                                                echo "<tr>
                                                <td>$no</td>
                                                <td>".$row['id_pesanan']."</td>
                                                <td>".$row['nama_studio']."</td>
                                                <td>".$row['nama_pengguna']."</td>
                                                <td>".$row['no_telp']."</td>
                                                <td>".$row['tanggal']."</td>
                                                <td>".$row['jam_mulai']."</td>
                                                <td>".$row['jam_berakhir']."</td>
                                                <td>".$row['durasi']."</td>
                                                <td>".$row['total_harga']."</td>";
                                                if(!$row['status'] == 'terblokir'){
                                                    echo "<td><a href='proses_blokir.php?id_pengguna=$row[id_pengguna]'>Blokir</a></td>
                                                    </tr>";
                                                }
                                                else{
                                                    echo "<td>Pelanggan Telah Terblokir</td>
                                                    </tr>";
                                                }
                                                $no++;  
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Button Cetak Excel -->
                    <button onclick="location.href = 'cetakdataexcel.php';" id="cetak" class="btn btn-warning" style="margin-left:2%;">Cetak File Excel</button>
                    <!-- Button Cetak PDF -->
                    <button onclick="location.href = 'cetakdatapdf.php';" id="cetakpdf" class="btn btn-success" >Cetak File PDF</button>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Muhammad Daffa & Reynaldi Diaz 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
