<?php
//apabila user belum login maka tidak bisa masuk halaman ini
session_start();
if (!isset($_SESSION['UserID'])) {
  // Alihkan ke halaman login atau tangani kasus di mana user tidak login
  header("Location: admin.php");
}
$UserID = $_SESSION['UserID'];
// Ambil level pengguna dari sesi
$level = isset($_SESSION['Level']) ? $_SESSION['Level'] : 0;
// Periksa apakah level pengguna
if ($level != 1) {
    // Jika tidak, arahkan ke halaman yang sesuai atau berikan pesan error
    header("Location: admin.php"); // Ganti dengan halaman yang sesuai
}
?>

<?php
include '../admin/koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    header("Location: admin.php");
}
// Query untuk mendapatkan informasi buku
$query_buku = "SELECT BukuID, Judul FROM Buku";
$result_buku = $koneksi->query($query_buku);
// Query untuk mendapatkan ulasan yang sudah terdaftar
$query_ulasan = "SELECT UlasanBuku.UlasanID, User.Username, Buku.Judul, UlasanBuku.Ulasan, UlasanBuku.Rating
                 FROM UlasanBuku
                 JOIN User ON UlasanBuku.UserID = User.UserID
                 JOIN Buku ON UlasanBuku.BukuID = Buku.BukuID";
$u = 1;
$result_ulasan = $koneksi->query($query_ulasan);

// Tutup koneksi
$koneksi->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
<!-- fonts google -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&
family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
<!-- style css -->
<link rel="stylesheet" href="../admin/admin.css">
<!-- style css boostrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <div class="header">
        <div class="list-item">
          <a href="#">
            <span class="description-header-icon">PERPUSTAKAAN DIGITAL</span>
          </a>
        </div>
      </div>
      <!-- GAMBAR HEADER -->
      <div class="ilustration">
        <img src="../asset/icon1.png" alt="">
      </div>
      <!-- End -->
      <div class="main">
      <div class="list-item">
          <a href="../admin/halaman.php" class="">
            <img src="../asset/home.png" alt="" class="icon">
            <span class="description-header">HOME</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/adminuser.php" class="">
            <img src="../asset/user.png" alt="" class="icon">
            <span class="description-header">USER</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/kategoribuku.php" class="">
            <img src="../asset/ktgri1.png" alt="" class="icon">
            <span class="description-header">KATEGORI BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/buku.php" class="">
            <img src="../asset/buku.png" alt="" class="icon">
            <span class="description-header">BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/relasibuku.php" class="">
            <img src="../asset/koleksi.png" alt="" class="icon">
            <span class="description-header">Relasi Buku</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/peminjaman.php" class="">
            <img src="../asset/peminjmn.png" alt="" class="icon">
            <span class="description-header">PEMINJAMAN</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/tambahpetugas.php" class="">
            <img src="../asset/user.png" alt="" class="icon">
            <span class="description-header">+ Tambah Petugas</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/ulasan.php" class="">
            <img src="../asset/buku.png" alt="" class="icon">
            <span class="description-header">Ulasan</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../admin/keluar.php" class="">
            <img src="../asset/keluar.png" alt="" class="icon">
            <span class="description-header">KELUAR</span>
          </a>
        </div>
      </div>
    </div>
   <div class="main-content">
   <div class="card">      
<div class="card-body">
    <h5>Ulasan yang Telah Terdaftar</h5>
       
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Judul</th>
                    <th>Ulasan</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        if ($result_ulasan) {
                            while ($row_ulasan = $result_ulasan->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $u++ . "</td>";
                                echo "<td>" . $row_ulasan['Username'] . "</td>";
                                echo "<td>" . $row_ulasan['Judul'] . "</td>";
                                echo "<td>" . $row_ulasan['Ulasan'] . "</td>";
                                echo "<td>" . $row_ulasan['Rating'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada ulasan terdaftar.</td></tr>";
                        }
                ?>
            </tbody>
            
        </table>

   </div>
  </div>
  <script src="script.js"></script>
</body>
</html>