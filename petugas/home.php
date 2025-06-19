<?php
//apabila user belum login maka tidak bisa masuk halaman ini
session_start();
if (!isset($_SESSION['UserID'])) {
  // Alihkan ke halaman login atau tangani kasus di mana user tidak login
  header("Location: ../admin/admin.php");
}
$UserID = $_SESSION['UserID'];
// Ambil level pengguna dari sesi
$level = isset($_SESSION['Level']) ? $_SESSION['Level'] : 0;
// Periksa apakah level pengguna adalah admin (misalnya, level 2)
if ($level != 2) {
    // Jika tidak, arahkan ke halaman yang sesuai atau berikan pesan error
    header("Location: ../admin/admin.php"); // Ganti dengan halaman yang sesuai
}
?>
<?php
include '../admin/koneksi.php';
?>
<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['Username'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: ../admin/admin.php");  
}
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
          <a href="../petugas/home.php" class="">
            <img src="../asset/home.png" alt="" class="icon">
            <span class="description-header">HOME</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/user.php" class="">
            <img src="../asset/user.png" alt="" class="icon">
            <span class="description-header">USER</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/kategoribuku.php" class="">
            <img src="../asset/ktgri1.png" alt="" class="icon">
            <span class="description-header">KATEGORI BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/buku.php" class="">
            <img src="../asset/buku.png" alt="" class="icon">
            <span class="description-header">BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/relasibuku.php" class="">
            <img src="../asset/koleksi.png" alt="" class="icon">
            <span class="description-header">RELASI BUKU</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/peminjaman.php" class="">
            <img src="../asset/peminjmn.png" alt="" class="icon">
            <span class="description-header">PEMINJAMAN</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/ulasan.php" class="">
            <img src="../asset/buku.png" alt="" class="icon">
            <span class="description-header">Ulasan</span>
          </a>
        </div>
        <div class="list-item">
        <a href="../petugas/keluar.php" class="">
            <img src="../asset/keluar.png" alt="" class="icon">
            <span class="description-header">KELUAR</span>
          </a>
        </div>
      </div>
    </div>
   <div class="main-content">
   <div class="alert alert-primary" role="alert" >
    Selamat Datang Di Perpustakaan Digital </br>
    HALO <?php echo $_SESSION['Username']?>
  </div>
   <!-- star tampilan -->
   <div class="card">
  <div class="card-header">
    Data User
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scoups="col">Username</th>
          <th scope="col">Nama Lengkap</th>
          <th scoups="col">Email</th>
          <th scope="col">Alamat</th>
          <th scope="col">Status</th>
        </tr>
        <tbody>
          <?php
          $sql2 = "SELECT * FROM user order by UserID asc";
          $q2   = mysqli_query($koneksi,$sql2);
          $urut = 1;
          while($r2       = mysqli_fetch_array($q2)){
            $Username     = $r2['Username'];
            $NamaLengkap  = $r2['NamaLengkap'];
            $Email        = $r2['Email'];
            $Alamat       = $r2['Alamat'];
            $Level        = $r2['Level'];
                    // Konversi nilai level ke teks
                    $levelText = '';
                    switch ($Level) {
                        case 0:
                            $levelText = 'User';
                            break;
                        case 1:
                            $levelText = 'Admin';
                            break;
                        case 2:
                            $levelText = 'Petugas';
                            break;
                        // Tambahkan kasus lain jika ada lebih banyak level
                        default:
                            $levelText = 'Tidak Diketahui';
                            break;
                    }
            ?>
            <form action="" methot="post">
            <tr>
              <th scope="row"><?php echo $urut++ ?></th>
              <td scope="row"><?php echo $Username ?></td>
              <td scope="row"><?php echo $NamaLengkap ?></td>
              <td scope="row"><?php echo $Email ?></td>
              <td scope="row"><?php echo $Alamat ?></td>
              <td scope="row"><?php echo $levelText ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </thead>
    </table>

    </form>
  
  </div>
  </div>
  <!--END-->
   </div>
  </div>
  <script src="script.js"></script>
</body>
</html>