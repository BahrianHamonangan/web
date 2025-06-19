<?php
// menghubungkan ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "dbs_perpustakaan";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { 
  die("Tidak bisa terkoneksi dengan database");
}
?> 