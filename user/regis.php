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
// create 
if (isset($_POST['regis'])) {
  
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];
  $Email = $_POST['Email'];
  $NamaLengkap = $_POST['NamaLengkap'];
  $Alamat = $_POST['Alamat'];

  // menambahkan data ke database
   {$sql1 = "INSERT INTO user(Username, Password, Email, NamaLengkap, Alamat)
   VALUES ('$Username','$Password','$Email','$NamaLengkap','$Alamat')";
    $q1 = mysqli_query;
    if(mysqli_query($koneksi, $sql1)) {
      header("location: ../index.php");
     } else {
      echo "Registrasi Gagal : " . mysqli_error($koneksi);
     }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <title>Form Login</title>
  </head>

  <body>
    <form action="" method="post">
      <div class="login">
        <h2>REGISTRASI</h2>
       
        <div class="input-group">
          <input type="text" name="Username" id="Username" required="" />
          <span>Username</span>
        </div>
        <div class="input-group">
          <input type="password" name="Password" id="Password" required="" />
          <span>Password</span>
        </div>
        <div class="input-group">
          <input type="email" name="Email" id="Email" required="" />
          <span>Email</span>
        </div>
        <div class="input-group">
          <input type="text" name="NamaLengkap" id="NamaLengkap" required="" />
          <span>Nama Lengkap</span>
        </div>
        <div class="input-group">
          <input type="text" name="Alamat" id="Alamat" required="" />
          <span>Alamat</span>
        </div>
        <div class="input-group">
          <input type="submit" value="simpan" name="regis"/>
        </div>
      </div>
    </form>
  </body>
</html>