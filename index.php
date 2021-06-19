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
        <title>Perpustakaan</title>
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
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Buku</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <!-- button modals -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Buku
                            </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Buku</th>
                                                <th>Penulis</th>
                                                <th>Tahun Terbit</th>
                                                <th>Jumlah Buku</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $getallbook = mysqli_query($conn, "SELECT * FROM data_buku");
                                            $i = 1;
                                            while($data=mysqli_fetch_array($getallbook)) {
                                                $judul_buku = $data['judul_buku'];
                                                $penulis = $data['penulis'];
                                                $tahun_terbit = $data['tahun_terbit'];
                                                $jumlah_buku = $data['jumlah_buku'];
                                                $id_bk = $data['id_buku'];
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$judul_buku;?></td>
                                                <td><?=$penulis;?></td>
                                                <td><?=$tahun_terbit;?></td>
                                                <td><?=$jumlah_buku;?></td>
                                                <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?=$id_bk;?>"><i class="fa fa-cog"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?=$id_bk;?>"><i class="fa fa-trash"></i></button>
                                                <input type="hidden" name="idhapusbuku" value="<?=$id_bk;?>">
                                                </td>
                                            </tr>

                                            <!-- The Edit Modal -->
                                            <div class="modal fade" id="edit<?=$id_bk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Buku</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="text" name="judulBuku" value="<?=$judul_buku?>" class="form-control" required><br>
                                                            <input type="text" name="penulis" value="<?=$penulis?>" class="form-control" required><br>
                                                            <input type="text" name="tahunTerbit" value="<?=$tahun_terbit?>" class="form-control" required><br>

                                                            <input type="hidden" name="idbk" value="<?=$id_bk;?>">

                                                            <button type="submit" class="btn btn-info" name="updateBook">Update Buku</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>
                                            
                                            <!-- The Delete Modal -->
                                            <div class="modal fade" id="hapus<?=$id_bk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Buku</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus buku "<?=$judul_buku?>" ?
                                                            <input type="hidden" name="idbk" value="<?=$id_bk;?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="deleteBook">Hapus Buku</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>

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
            <h4 class="modal-title">Tambah Buku</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">
                    <input type="text" name="judulBuku" placeholder="Judul Buku" class="form-control" required><br>
                    <input type="text" name="penulis" placeholder="Penulis Buku" class="form-control" required><br>
                    <input type="text" name="tahunTerbit" placeholder="Tahun Terbit" class="form-control" required><br>
                    <input type="number" name="jumlah" placeholder="Jumlah Buku" class="form-control" required><br>

                    <button type="submit" class="btn btn-primary" name="addBook">Tambah Buku</button>
                </div>
            </form>
            
        </div>
        </div>
    </div>
</html>
