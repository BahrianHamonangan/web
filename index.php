<?php

include 'admin/koneksi.php';
?>
<?php
if (isset($_POST['login'])) {
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];

  // Gunakan parameterized query atau hash password untuk keamanan lebih
  $sql1 = "SELECT * FROM user WHERE Username = '$Username' AND Password = '$Password'";
  $result = mysqli_query($koneksi, $sql1);

  if (mysqli_num_rows($result) > 0) {
      // Ambil data user
      $row = mysqli_fetch_assoc($result);

      // Simpan informasi pengguna ke dalam session
      session_start();
      $_SESSION['UserID'] = $row['UserID'];
      $_SESSION['Username'] = $row['Username'];
      $_SESSION['Password'] = $row['Password'];

      // Redirect ke halaman setelah login
      header("Location: user/home.php");
      
  } else {
      echo "Username atau Password salah";
  }
}
// Simpan level pengguna ke dalam sesi
$_SESSION['Level'] = $row['Level']; // Ambil level dari hasil query
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Form Login</title>
  </head>
  <body>
    <form action ="" method = "post">
      <div class="login">
        <h2>Form Login</h2>
        <div class="input-group">
          <input type="text" name="Username" id="Username" required="" />
          <span>username</span>
        </div>
        <div class="input-group">
          <input type="password" name="Password" id="Password" required="" />
          <span>Password</span>
        </div>  
        <div class="input-group">
          <input type="submit" name="login" value="login" />
         <div>
         <a href="user/regis.php">Belum ada akun?</a>
         </div>
       
        <div>
          <a href="admin/admin.php" >Masuk Sebagai Admin atau Petugas</a>
        </div>
      </div>
    </form>
  </body>
</html>
