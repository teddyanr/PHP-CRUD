<?php

// connection to db
$conn = mysqli_connect("localhost", "root", "", "pwss_uas");

// add new book
if (isset($_POST['addBook'])) {
    $judul_buku = $_POST['judulBuku'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $jumlah_buku = $_POST['jumlah'];

    $addtotable = mysqli_query($conn, "INSERT INTO data_buku (judul_buku, penulis, tahun_terbit, jumlah_buku) VALUES ('$judul_buku', '$penulis', '$tahun_terbit',' $jumlah_buku')");

    if ($addtotable) {
        header('location:index.php');
    } else {
        echo "Gagal menambahkan buku.";
        header('location:index.php');
    }
}

// return book
if (isset($_POST['returnBook'])) {
    $bukunya = $_POST['bukunya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $total_buku = mysqli_query($conn, "SELECT * FROM data_buku where id_buku='$bukunya'");
    $ambil_total = mysqli_fetch_array($total_buku);
    
    $total_sekarang = $ambil_total['jumlah_buku'];
    $tambah_buku_kembali = $total_sekarang + $qty;

    $bukukembali = mysqli_query($conn, "INSERT INTO kembali_buku (id_buku, keterangan, qty) VALUES ('$bukunya','$keterangan','$qty')");
    $updatejumlah = mysqli_query($conn, "UPDATE data_buku SET jumlah_buku=$tambah_buku_kembali WHERE id_buku='$bukunya'");

    if ($bukukembali && $updatejumlah) {
        header('location:kembali.php');
    } else {
        echo "Gagal untuk menambahkan buku yang dikembalikan ke sistem.";
        header('location:kembali.php');
    }
}

// borrow book
if (isset($_POST['borBook'])) {
    $bukunya = $_POST['bukunya'];
    $peminjam = $_POST['peminjam'];
    $qty = $_POST['qty'];

    $total_buku = mysqli_query($conn, "SELECT * FROM data_buku where id_buku='$bukunya'");
    $ambil_total = mysqli_fetch_array($total_buku);
    
    $total_sekarang = $ambil_total['jumlah_buku'];
    $ambil_buku = $total_sekarang - $qty;

    $pinjambuku = mysqli_query($conn, "INSERT INTO pinjam_buku (id_buku, peminjam, qty) VALUES ('$bukunya','$peminjam','$qty')");
    $updatejumlah = mysqli_query($conn, "UPDATE data_buku SET jumlah_buku=$ambil_buku WHERE id_buku='$bukunya'");

    if ($bukukembali && $updatejumlah) {
        header('location:pinjam.php');
    } else {
        echo "Gagal untuk menambahkan buku yang dikembalikan ke sistem.";
        header('location:pinjam.php');
    }
}

// update book
if (isset($_POST['updateBook'])) {
    $id_buku = $_POST['idbk'];
    $judul_buku = $_POST['judulBuku'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahunTerbit'];

    $update = mysqli_query($conn, "UPDATE data_buku SET judul_buku='$judul_buku', penulis='$penulis', tahun_terbit='$tahun_terbit' WHERE id_buku='$id_buku'");

    if ($update) {
        header('location:index.php');
    } else {
        echo "Gagal untuk update buku.";
        header('location:index.php');
    }
}

// delete book
if (isset($_POST['deleteBook'])) {
    $id_buku = $_POST['idbk'];

    $delete = mysqli_query($conn, "DELETE FROM data_buku WHERE id_buku=$id_buku");

    if ($delete) {
        header('location:index.php');
    } else {
        echo "Gagal untuk menghapus buku.";
        header('location:index.php');
    }
}
?>