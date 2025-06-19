<?php
//apabila user belum login maka tidak bisa masuk halaman ini
session_start();
if (!isset($_SESSION['UserID'])) {
  // Alihkan ke halaman login atau tangani kasus di mana user tidak login
  header("Location: ../index.php");
}
$UserID = $_SESSION['UserID'];
// Ambil level pengguna dari sesi
$level = isset($_SESSION['Level']) ? $_SESSION['Level'] : 0;

// Periksa apakah level pengguna adalah admin (misalnya, level 2)
if ($level != 0) {
    // Jika tidak, arahkan ke halaman yang sesuai atau berikan pesan error
    header("Location: ../index.php"); // Ganti dengan halaman yang sesuai
   
}
?>

<?php
// menghubungkan ke database
include '../admin/koneksi.php';
 
// create 
$KategoriID   = "";
$NamaKategori = "";
$succes       = "";
$error        = "";

    

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
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
<!-- style css -->
<link rel="stylesheet" href="../admin/admin.css">
<!-- style css boostrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

      <!--sidebar-->
      <div class="main">
      <div class="list-item">
          <a href="../user/home.php" class="">
            <img src="../asset/home.png" alt="" class="icon">
            <span class="description-header">HOME</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/user.php" class="">
            <img src="../asset/user.png" alt="" class="icon">
            <span class="description-header">USER</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/biodata.php" class="">
            <img src="../asset/biodat.png" alt="" class="icon">
            <span class="description-header">Biodata</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/kategoribuku.php" class="">
            <img src="../asset/ktgri1.png" alt="" class="icon">
            <span class="description-header">KATEGORI BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/buku.php" class="">
            <img src="../asset/buku.png" alt="" class="icon">
            <span class="description-header">BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/koleksipribadi.php" class="">
            <img src="../asset/koleksi.png" alt="" class="icon">
            <span class="description-header">KOLEKSI PRIBADI</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/peminjaman.php" class="">
            <img src="../asset/peminjmn.png" alt="" class="icon">
            <span class="description-header">PEMINJAMAN</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/ulasan.php" class="">
            <img src="../asset/buku.png" alt="" class="icon">
            <span class="description-header">Berikan Ulasan</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../user/keluar.php" class="">
            <img src="../asset/keluar.png" alt="" class="icon">
            <span class="description-header">KELUAR</span>
          </a>
        </div>
      </div>
    </div>
 
  <!-- Masukkan -->
  <div class="main-content">
 
  <div class="card-body">

<!-- Tampilan-->

<div class="card">
  <div class="card-header">
    Kategori Buku
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">KategoriID</th>
          <th scoups="col">NamaKategori</th>
         
        </tr>
        <tbody>
          <?php
          $sql2 = "SELECT * FROM kategoribuku order by KategoriID desc";
          $q2   = mysqli_query($koneksi,$sql2);
          $urut = 1;
          while($r2 = mysqli_fetch_array($q2)){
            $KategoriID   = $r2['KategoriID'];
            $NamaKategori = $r2['NamaKategori'];
            ?>
            <tr>
              <th scope="row"><?php echo $urut++ ?></th>
              <td scope="row"><?php echo $KategoriID ?></td>
              <td scope="row"><?php echo $NamaKategori ?></td>
              
            </tr>
            <?php
          }
          ?>
        </tbody>
      </thead>
    </table>
  </div>
</div>

</div> 
  </div>
 
  <script src="script.js"></script>

</body>
</html>