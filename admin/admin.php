<?php
include 'koneksi.php';

if (isset($_POST['masuk'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Level = $_POST['Level'];

    $sql1 = "SELECT * FROM user WHERE Username = '$Username' AND Password = '$Password' And Level = '$Level'";

    $result = mysqli_query($koneksi, $sql1);

    if (mysqli_num_rows($result) > 0) {
      // Ambil data user
      $row = mysqli_fetch_assoc($result);
       // Simpan informasi pengguna ke dalam session
       session_start();
       $_SESSION['UserID'] = $row['UserID'];
       $_SESSION['Username'] = $row['Username'];
       $_SESSION['Password'] = $row['Password'];
        
          // Memeriksa Level dari pengguna
          if ($row['Level'] == 1) {
              // Jika Level adalah 1, arahkan ke halaman berikutnya
              header("location: halaman.php");
          } 
          if ($row['Level'] == 2) {
            // Jika Level adalah 2, arahkan ke halaman berikutnya
            header("location: ../petugas/home.php");
        } else {
              // Jika Level bukan 1/2, tampilkan pesan gagal
              echo "Gagal: Hanya Admin Yang Bisa Login";
          }
      } else {
          echo "Gagal: Username, Password, atau Level salah.";
      }
    }

    // Setelah verifikasi username dan password
// ...

// Simpan level pengguna ke dalam sesi
$_SESSION['Level'] = $row['Level']; // Ambil level dari hasil query

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
          <input type="text" name="Level" id="Level" required="" />
          <span>Level</span>
        </div>
          
       <div class="input-group ">
          <input type="submit" name="masuk" value="masuk" />
       </div>
        <div>
          <a href="../index.php">Kembali</a>
        </div>
        
      </div>
    </form>
  </body>
</html>
