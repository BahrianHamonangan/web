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
// Periksa apakah level pengguna adalah admin (misalnya, level 2)
if ($level != 1) {
    // Jika tidak, arahkan ke halaman yang sesuai atau berikan pesan error
    header("Location: admin.php"); // Ganti dengan halaman yang sesuai
}
?>
<?php
// menghubungkan ke database
include 'koneksi.php';
// create 
$BukuID   = "";
$Judul = "";
$Penulis = "";
$Penerbit = "";
$TahunTerbit = "";
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
  $BukuID  = $_GET[BukuID];
  $sql1        = "DELETE FROM buku where BukuID = '$BukuID'";
  $q1          = mysqli_query($koneksi,$sql1);
  if($q1){
    $succes = "Berhasil di hapus";
  }else{
    $error  = "Gagal menghapus";
  }
}
//edit
if($op == 'edit'){
  $BukuID   = $_GET['BukuID'];
  $sql1         = "SELECT * FROM buku where BukuID = '$BukuID'";
  $q1           = mysqli_query($koneksi,$sql1);
  $r1           = mysqli_fetch_array($q1);
  $BukuID       = $r1['BukuID'];
  $Judul        = $r1['Judul'];
  $Penulis      = $r1['Penulis'];
  $Penerbit     = $r1['Penerbit'];
  $TahunTerbit  = $r1['TahunTerbit'];

  if($BukuID == ''){
    $error = "Data tidak ditemukan";
  }
}
 // menambahkan data ke database
if (isset($_POST['simpan'])) {
  $BukuID       = $_POST['BukuID'];
  $Judul        = $_POST['Judul'];
  $Penulis      = $_POST['Penulis'];
  $Penerbit     = $_POST['Penerbit'];
  $TahunTerbit  = $_POST['TahunTerbit'];
  //untuk memerintah Harus diisi
  if($BukuID && $Judul && $Penulis && $Penerbit && $TahunTerbit){
    if($op == 'edit'){//update data
      $sql1      = "UPDATE buku SET BukuID ='$BukuID',Judul='$Judul',Penulis='$Penulis',
      Penerbit='$Judul',TahunTerbit='$TahunTerbit' where BukuID='$BukuID'";
      $q1        = mysqli_query($koneksi,$sql1);
      if($q1){
        $succes = "Data berhasil di edit";
      }else{
        $error  = "Data gagal di edit";
      }
    }else{//insert data
      $sql1 = "INSERT INTO buku(BukuID,Judul,Penulis,Penerbit,TahunTerbit)
   VALUES ('$BukuID','$Judul','$Penulis','$Penerbit','$TahunTerbit')";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
      $succes = "Berhasil memasukkan Buku baru";
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
    Masukkan Buku
  </div>
  <div class="card-body">
    <?php
      if($error){
        ?>
          <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
          </div>
        <?php  
        header("refresh:3;url=buku.php"); //3 detik
      }
      ?>
      <?php
      if ($succes) {
        ?>
         <div class="alert alert-success" role="alert">
             <?php echo $succes ?>
          </div>
        <?php
        header("refresh:3;url=buku.php"); //3 detik
      }
    ?>
    <form action="" method="POST">
    <div class="mb-3 row">
    <label for="KategoriID" class="col-sm-2 col-form-label">Buku ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="BukuID" name="BukuID" value="<?php echo $BukuID ?>">
    </div>
  </div>
    <div class="mb-3 row">
    <label for="NamaKategori" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Judul" name="Judul" value="<?php echo $Judul ?>">
    </div>
    </div>
    <div class="mb-3 row">
    <label for="NamaKategori" class="col-sm-2 col-form-label">Penulis</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Penulis" name="Penulis" value="<?php echo $Penulis ?>">
    </div>
    </div>
    <div class="mb-3 row">
    <label for="NamaKategori" class="col-sm-2 col-form-label">Penerbit</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Penerbit" name="Penerbit" value="<?php echo $Penerbit ?>">
    </div>
    </div>
    <div class="mb-3 row">
    <label for="NamaKategori" class="col-sm-2 col-form-label">Tahun Terbit</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="TahunTerbit" name="TahunTerbit" 
      value="<?php echo $TahunTerbit ?>">
    </div>
    </div>
  </div>
  <div class="col-12">
    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
    </form>
  </div>
</div>
<!-- Tampilan-->
<div class="card">
  <div class="card-header">
    Buku
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Buku ID</th>
          <th scoups="col">Judul</th>
          <th scope="col">Penulis</th>
          <th scoups="col">Penerbit</th>
          <th scope="col">Tahun Terbit</th>
          <th scope="col">Aksi</th>
        </tr>
        <tbody>
          <?php
          $sql2 = "SELECT * FROM buku order by BukuID desc";
          $q2   = mysqli_query($koneksi,$sql2);
          $urut = 1;
          while($r2 = mysqli_fetch_array($q2)){
            $BukuID   = $r2['BukuID'];
            $Judul = $r2['Judul'];
            $Penulis   = $r2['Penulis'];
            $Penerbit = $r2['Penerbit'];
            $TahunTerbit   = $r2['TahunTerbit'];
           
            ?>
            <form action="koleksi.php" methot="post">
            <tr>
              <th scope="row"><?php echo $urut++ ?></th>
              <td scope="row"><?php echo $BukuID ?></td>
              <td scope="row"><?php echo $Judul ?></td>
              <td scope="row"><?php echo $Penulis ?></td>
              <td scope="row"><?php echo $Penerbit ?></td>
              <td scope="row"><?php echo $TahunTerbit ?></td>
              <td scope="row">
               <a href="buku.php?op=edit&BukuID=<?php echo $BukuID?>">
                <button type="button" class="btn btn-danger">EDIT</button>          
              </a> 
              <td scope="row">
              <a href="buku.php?op=delete&BukuID=<?php echo $BukuID?>" 
              onclick="return confirm('Yakin mau HAPUS?')"> 
              <button type="button" class="btn btn-warning">HAPUS</button>
              </a>
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
</div>
</div>
  </div>
  <script src="script.js"></script>
</body>
</html>