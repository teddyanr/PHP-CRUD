<?php
session_start();
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pengembalian Buku</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Perpustakaan</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
                                Daftar Buku
                            </a>
                            <a class="nav-link" href="pinjam.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-arrow-up"></i></div>
                                Peminjaman Buku
                            </a>
                            <a class="nav-link" href="kembali.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-arrow-down"></i></div>
                                Pengembalian Buku
                            </a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Pengembalian Buku</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- button modals -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Pengembalian Buku
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Judul Buku</th>
                                                <th>Keterangan</th>
                                                <th>Jumlah Dikembalikan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getborbook = mysqli_query($conn, "SELECT * FROM kembali_buku a, data_buku b WHERE a.id_buku=b.id_buku");
                                            while($data=mysqli_fetch_array($getborbook)) {
                                                $tanggal = $data['tanggal'];
                                                $judul_buku = $data['judul_buku'];
                                                $keterangan = $data['keterangan'];
                                                $qty = $data['qty'];
                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$judul_buku;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$qty;?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Pengembalian Buku</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">
                    <select name="bukunya" class="form-control">
                        <?php
                            $getallbook = mysqli_query($conn, "SELECT * FROM data_buku");
                            while($fetcharray = mysqli_fetch_array($getallbook)){
                                $judul_buku = $fetcharray['judul_buku'];
                                $id_buku = $fetcharray['id_buku'];
                        ?>
                            <option value="<?=$id_buku;?>"><?=$judul_buku;?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <br>
                    <input type="number" name="qty" placeholder="Quantity" class="form-control" required><br>
                    <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required><br>

                    <button type="submit" class="btn btn-primary" name="returnBook">Pengembalian Buku</button>
                </div>
            </form>
            
        </div>
        </div>
    </div>
</html>
