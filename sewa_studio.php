<?php
session_start();

if(!isset($_SESSION['status_pengguna'])){
    header("location: login_pengguna.php");
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
        <title>Sewa Studio</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="tables.php">Dashboard Pengguna</a>
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
                        <li><a class="dropdown-item" href="logout_pengguna.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Riwayat Saya
                            </a>
                            <a class="nav-link" href="pilihan_studio.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Daftar Pilihan Studio
                            </a>
                            <a class="nav-link" href="sewa_studio.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Sewa Studio
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['nama_pengguna'];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Sewa Studio</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-book-open me-1"></i>
                                Form Persewaan Studio
                            </div>
                            <div class="card-body">
                                <form method="post" action="simpan_pesanan.php">
                                    <div class="form-group row">
                                        <label for="inputStudio" class="col-sm-3 col-form-label">Studio</label>
                                        <div class="col-sm-9">
                                            <input type="radio" name="studio" value=1 required> Reguler (35K/Jam)
                                            &emsp;&emsp;&emsp;
                                            <input type="radio" name="studio" value=2> VIP (50K/Jam)
                                            &emsp;&emsp;&emsp;
                                            <input type="radio" name="studio" value=3> VVIP (100K/Jam)
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputJam" class="col-sm-3 col-form-label">Jam</label>
                                        <div class="col-sm-9">
                                            <select name="jam">
                                                <option value="09:00:00">09:00</option>
                                                <option value="10:00:00">10:00</option>
                                                <option value="11:00:00">11:00</option>
                                                <option value="12:00:00">12:00</option>
                                                <option value="13:00:00">13:00</option>
                                                <option value="14:00:00">14:00</option>
                                                <option value="15:00:00">15:00</option>
                                                <option value="16:00:00">16:00</option>
                                                <option value="17:00:00">17:00</option>
                                                <option value="18:00:00">18:00</option>
                                                <option value="19:00:00">19:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTanggal" class="col-sm-3 col-form-label">Tanggal Sewa</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="inputTanggal" type="date" placeholder="Durasi" name="tanggal" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputDurasi" class="col-sm-3 col-form-label">Durasi</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="inputDurasi" type="number" placeholder="Durasi" name="durasi" required />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <input type="submit" class= "btn btn-primary" name="btnCek" value="Sewa Studio" >
                                    </div>
                                </form>
                                <div class="form-group row">
                                    <?php 
                                        if(isset($_GET['pesan_sewa'])){
                                            if($_GET['pesan_sewa'] == "sudah_terpesan"){
                                                echo "<center><p style='color:red'>Jadwal sudah terisi, silahkan lihat jadwal dibawah.</p></center>";
                                            }
                                            else if($_GET['pesan_sewa'] == "salah_jam"){
                                                echo "<center><p style='color:red'>Batas akhir sewa studio pukul 21:00</p></center>";
                                            }
                                            else if($_GET['pesan_sewa'] == "tanggal_salah"){
                                                echo "<center><p style='color:red'>Masukkan Tanggal >= Hari Ini</p></center>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar Studio Terpakai</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Data Studio Terpakai
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Studio</th>
                                            <th>Tanggal</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Durasi</th>
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
                                                <td>".$row['nama_studio']."</td>
                                                <td>".$row['tanggal']."</td>
                                                <td>".$row['jam_mulai']."</td>
                                                <td>".$row['jam_berakhir']."</td>
                                                <td>".$row['durasi']."</td>
                                                </tr>";
                                                $no++;  
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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