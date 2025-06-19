<?php
include '../admin/koneksi.php';
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
 
// create 
$BiodataID    = "";
$Nama         = "";
$Umur         = "";
$Alamat       = "";
$JenisKelamin = "";
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
  $BiodataID  = $_GET[BiodataID];
  $sql1        = "DELETE FROM biodata where BiodataID = '$BiodataID'";
  $q1          = mysqli_query($koneksi,$sql1);
  if($q1){
    $succes = "Berhasil di hapus";
  }else{
    $error  = "Gagal menghapus";
  }
}
//edit
if($op == 'edit'){
  $BiodataID   = $_GET['BiodataID'];
  $sql1         = "SELECT * FROM biodata where BiodataID = '$BiodataID'";
  $q1           = mysqli_query($koneksi,$sql1);
  $r1           = mysqli_fetch_array($q1);
  $BiodataID = $r1['BiodataID'];
  $Nama = $r1['Nama'];
  $Umur = $r1['Umur'];
  $Alamat = $r1['Alamat'];
  $JenisKelamin = $r1['JenisKelamin'];

  if($BiodataID == ''){
    $error = "Data tidak ditemukan";
  }
}
 // menambahkan data ke database
if (isset($_POST['simpan'])) {
  $Nama = $_POST['Nama'];
  $Umur = $_POST['Umur'];
  $Alamat = $_POST['Alamat'];
  $JenisKelamin = $_POST['JenisKelamin'];
  //untuk memerintah Harus diisi
  if($Nama && $Umur && $Alamat && $JenisKelamin){
    if($op == 'edit'){//update data
      $sql1      = "UPDATE biodata SET Nama ='$Nama',Umur='$Umur',Alamat='$Alamat',JenisKelamin='$JenisKelamin' where BiodataID='$BiodataID'";
      $q1        = mysqli_query($koneksi,$sql1);
      if($q1){
        $succes = "Data berhasil di edit";
      }else{
        $error  = "Data gagal di edit";
      }
    }else{//insert data
      $sql1 = "INSERT INTO biodata (Nama,Umur,Alamat,JenisKelamin)
   VALUES ('$Nama','$Umur','$Alamat','$JenisKelamin')";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
      $succes = "Berhasil menambahkan biodata baru";
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
  <div class="card">
  <div class="card-header text-white bg-secondary">
    Masukkan Biodata
  </div>
  <div class="card-body">
    <?php
      if($error){
        ?>
          <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
          </div>
        <?php  
        header("refresh:3;url=biodata.php"); //3 detik
      }
      ?>
      <?php
      if ($succes) {
        ?>
         <div class="alert alert-success" role="alert">
             <?php echo $succes ?>
          </div>
        <?php
        header("refresh:3;url=biodata.php"); //3 detik
      }
    ?>

    <form action="" method="POST">
    <div class="mb-3 row">
    <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Nama" name="Nama" value="<?php echo $Nama ?>">
    </div>
  </div>

    <div class="mb-3 row">
    <label for="Umur" class="col-sm-2 col-form-label">Umur </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Umur" name="Umur" value="<?php echo $Umur ?>">
    </div>
  </div>

    <div class="mb-3 row">
    <label for="Alamat" class="col-sm-2 col-form-label">Alamat </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $Alamat ?>">
    </div>
  </div>

  <div class="mb-3 row">
   <label for="JenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
   <div class="col-sm-10">
      <select class="form-select" id="JenisKelamin" name="JenisKelamin">
         <option value="Laki-laki" <?php echo ($JenisKelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
         <option value="Perempuan" <?php echo ($JenisKelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
        
      </select>
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
    Biodata
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scoups="col">Umur</th>
          <th scoups="col">Alamat</th>
          <th scoups="col">JenisKelamin</th>
          <th scope="col">Aksi</th>
        </tr>
        <tbody>
          <?php
          $sql2 = "SELECT * FROM biodata order by BiodataID desc";
          $q2   = mysqli_query($koneksi,$sql2);
          $urut = 1;
          while($r2 = mysqli_fetch_array($q2)){
            $Nama   = $r2['Nama'];
            $Umur = $r2['Umur'];
            $Alamat = $r2['Alamat'];
            $JenisKelamin = $r2['JenisKelamin'];
            ?>
            <tr>
              <th scope="row"><?php echo $urut++ ?></th>
              <td scope="row"><?php echo $Nama ?></td>
              <td scope="row"><?php echo $Umur ?></td>
              <td scope="row"><?php echo $Alamat ?></td>
              <td scope="row"><?php echo $JenisKelamin ?></td>
              <td scope="row">
               <a href="biodata.php?op=edit&BiodataID=<?php echo $r2['BiodataID']?>">
                <button type="button" class="btn btn-danger">EDIT</button>          
              </a> 
              <a href="biodata.php?op=delete&BiodataID=<?php echo $r2['BiodataID']?>" onclick="return confirm('Yakin mau HAPUS?')">
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
  </div>
 
  <script src="script.js"></script>

</body>
</html>