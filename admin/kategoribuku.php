<?php
include 'koneksi.php';
//apabila user belum login maka tidak bisa masuk halaman ini
session_start();
if (!isset($_SESSION['UserID'])) {
  // Alihkan ke halaman login atau tangani kasus di mana user tidak login
  header("Location: admin.php");
}
$UserID = $_SESSION['UserID'];
// Ambil level pengguna dari sesi
$level = isset($_SESSION['Level']) ? $_SESSION['Level'] : 0;
// Periksa apakah level pengguna adalah admin (misalnya, level 2)
if ($level != 1) {
    // Jika tidak, arahkan ke halaman yang sesuai atau berikan pesan error
    header("Location: admin.php"); // Ganti dengan halaman yang sesuai   
}
?>
<?php
// create 
$KategoriID   = "";
$NamaKategori = "";
$succes       = "";
$error        = "";
//membuat update atau edit
if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op ="";
}
//hapus
if($op == 'delete'){
  $KategoriID  = $_GET[KategoriID];
  $sql1        = "DELETE FROM kategoribuku where KategoriID = '$KategoriID'";
  $q1          = mysqli_query($koneksi,$sql1);
  if($q1){
    $succes = "Berhasil di hapus";
  }else{
    $error  = "Gagal menghapus";
  }
}
//edit
if($op == 'edit'){
  $KategoriID   = $_GET['KategoriID'];
  $sql1         = "SELECT * FROM kategoribuku where KategoriID = '$KategoriID'";
  $q1           = mysqli_query($koneksi,$sql1);
  $r1           = mysqli_fetch_array($q1);
  $KategoriID   = $r1['KategoriID'];
  $NamaKategori = $r1['NamaKategori'];

  if($KategoriID == ''){
    $error = "Data tidak ditemukan";
  }
}
 // menambahkan data ke database
if (isset($_POST['simpan'])) {
  $KategoriID   = $_POST['KategoriID'];
  $NamaKategori = $_POST['NamaKategori'];
  //untuk memerintah Harus diisi
  if($KategoriID && $NamaKategori){
    if($op == 'edit'){//update data
      $sql1      = "UPDATE kategoribuku SET KategoriID ='$KategoriID',
      NamaKategori='$NamaKategori' where KategoriID='$KategoriID'";
      $q1        = mysqli_query($koneksi,$sql1);
      if($q1){
        $succes = "Data berhasil di edit";
      }else{
        $error  = "Data gagal di edit";
      }
    }else{//insert data
      $sql1 = "INSERT INTO kategoribuku(KategoriID,NamaKategori)
   VALUES ('$KategoriID','$NamaKategori')";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
      $succes = "Berhasil memasukkan Kategori baru";
    }else{
      $error  = "Gagal memasukkan data, karena data telah ada";
    }
    }
}else{
  $error = "Silahkan masukkan semua data";
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&
family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
<!-- style css -->
<link rel="stylesheet" href="admin.css">
<!-- style css boostrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
  crossorigin="anonymous">
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
      <!--sidebar-->
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
  <!-- Masukkan -->
  <div class="main-content">
  <div class="card">
  <div class="card-header text-white bg-secondary">
    Masukkan Kategori
  </div>
  <div class="card-body">
    <?php
      if($error){
        ?>
          <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
          </div>
        <?php  
        header("refresh:3;url=kategoribuku.php"); //3 detik
      }
      ?>
      <?php
      if ($succes) {
        ?>
         <div class="alert alert-success" role="alert">
             <?php echo $succes ?>
          </div>
        <?php
        header("refresh:3;url=kategoribuku.php"); //3 detik
      }
    ?>
    <form action="" method="POST">
    <div class="mb-3 row">
    <label for="KategoriID" class="col-sm-2 col-form-label">Kategori ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="KategoriID" name="KategoriID" value="
      <?php echo $KategoriID ?>">
    </div>
  </div>
    <div class="mb-3 row">
    <label for="NamaKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="NamaKategori" name="NamaKategori" value="
      <?php echo $NamaKategori ?>">
    </div>
  </div>
  <div class="col-12">
    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
    </div>
    </form>
  </div>
</div>
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
          <th scope="col">Aksi</th>
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
              <td scope="row">
               <a href="kategoribuku.php?op=edit&KategoriID=<?php echo $KategoriID?>">
                <button type="button" class="btn btn-danger">EDIT</button>          
              </a> 
              <a href="kategoribuku.php?op=delete&KategoriID=<?php echo $KategoriID?>" 
              onclick="return confirm('Yakin mau HAPUS?')"> 
              <button type="button" class="btn btn-warning">HAPUS</button>
              </a>
              </td>
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