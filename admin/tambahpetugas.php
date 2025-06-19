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
// menghubungkan ke database
include 'koneksi.php';
// create 
if (isset($_POST['regis'])) {  
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];
  $Email = $_POST['Email'];
  $NamaLengkap = $_POST['NamaLengkap'];
  $Alamat = $_POST['Alamat'];
  // menambahkan data ke database
   {$sql1 = "INSERT INTO user(Username, Password, Email, NamaLengkap, Alamat, Level)
   VALUES ('$Username','$Password','$Email','$NamaLengkap','$Alamat','2')";
    $q1 = mysqli_query;
    if(mysqli_query($koneksi, $sql1)) {
      header("location: tambahpetugas.php");
     } else {
      echo "Registrasi Gagal : " . mysqli_error($koneksi);
     }
   }
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&f
amily=Ubuntu:wght@400;500;700&display=swap"
 rel="stylesheet">
<!-- style css -->
<link rel="stylesheet" href="admin.css">
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

   <form action="" method="post">
      <div class="login">
        <h2>REGISTRASI PETUGAS</h2>
       
        <div class="form-control">
        <label>Username</label>
          <input type="text" name="Username" id="Username" class="form-control" required="" />
        </div>
        <div class="form-control">
        <label>Password</label>
          <input type="password" name="Password" id="Password" class="form-control" required="" />
        </div>
        <div class="form-control">
        <label>Email</label>
          <input type="email" name="Email" id="Email" class="form-control" required="" />
        </div>
        <div class="form-control">
        <label>Nama Lengkap</label>
          <input type="text" name="NamaLengkap" id="NamaLengkap" class="form-control" required="" />
        </div>
        <div class="form-control">
        <label>Alamat</label>
          <input type="text" name="Alamat" id="Alamat" class="form-control" required="" />
        </div>
            <input type="submit" name="regis" value="Simpan" class="btn btn-primary" />
    </form>
  </div>
      </div>
    </form>

   </div>
  </div>
  <script src="script.js"></script>
</body>
</html>