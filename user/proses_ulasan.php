<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    header("Location: index.php");
  
}

include '../admin/koneksi.php'; // Sertakan file koneksi database

// Ambil data dari formulir
$UserID = $_SESSION['UserID'];
$BukuID = $_POST['BukuID'];
$Ulasan = $_POST['Ulasan'];
$Rating = $_POST['Rating'];

// Query untuk menyimpan ulasan ke dalam tabel
$query = "INSERT INTO UlasanBuku (UserID, BukuID, Ulasan, Rating)
          VALUES ('$UserID', '$BukuID', '$Ulasan', '$Rating')";

if ($koneksi->query($query) === TRUE) {
    header("Location: ../user/ulasan.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

// Tutup koneksi
$koneksi->close();
?>
