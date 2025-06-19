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
// Sertakan file koneksi database
include '../admin/koneksi.php';
$succes = "";
$error = "";

// Proses form saat dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $BukuID = $_POST['BukuID'];
    $TanggalPeminjaman = $_POST['TanggalPeminjaman'];
    $TanggalPengembalian = $_POST['TanggalPengembalian'];
    
    // Ambil UserID dari sesi pengguna
    session_start();
    $UserID = $_SESSION['UserID'];

    // Set status peminjaman default
    $StatusPeminjaman = "Dipinjam";

    // Query untuk menyimpan data ke dalam tabel peminjaman
    $query = "INSERT INTO peminjaman ( PeminjamanID,UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman)
     VALUES ('$PeminjamanID','$UserID','$BukuID', '$TanggalPeminjaman', '$TanggalPengembalian', '$StatusPeminjaman')";

    if ($koneksi->query($query) === TRUE) {
      $succes = "Data berhasil di edit";
    } else {
        $error = "Data gagal di edit: " . mysqli_error($koneksi);
    }
}

// Query untuk mendapatkan data buku
$query_buku = "SELECT * FROM buku";
$result_buku = $koneksi->query($query_buku);

// Check for errors in the query execution
if (!$result_buku) {
    die("Error in query_buku: " . $koneksi->error);
}

// Query untuk mendapatkan data buku yang telah dipinjam oleh user
$query_peminjaman = "SELECT b.Judul, p.PeminjamanID, p.TanggalPeminjaman, p.TanggalPengembalian, p.StatusPeminjaman
                    FROM peminjaman p
                    JOIN buku b ON p.BukuID = b.BukuID
                    WHERE p.UserID = '$UserID'";
$result_peminjaman = $koneksi->query($query_peminjaman);

// Check for errors in the query execution
if (!$result_peminjaman) {
    die("Error in query_peminjaman: " . $koneksi->error);
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
<link rel="stylesheet" href="../admin/admin.css"><!-- style css boostrap-->
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
    <!--menambahkan pesan-->
  <?php
        if ($error) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
            header("refresh:3;url=peminjaman.php"); //3 detik
        }

        if ($succes) {
            echo "<div class='alert alert-success' role='alert'>$succes</div>";
            header("refresh:3;url=peminjaman.php"); //3 detik
        }
        ?>

  <!-- tambah search -->
  

  <form action="" method="post" class="card">
  
        <label for="buku">Pilih Judul Buku:</label>
        <select name="BukuID" required>
         <option>Daftar Buku</option>
            <?php
            // Loop melalui hasil query buku dan tambahkan ke opsi select
            while ($row = $result_buku->fetch_assoc()) {
                echo "<option value='" . $row['BukuID'] . "'>" . $row['Judul'] . "</option>";
            }
            ?>
        </select>

        <label for="TanggalPeminjaman">Tanggal Peminjaman:</label>
        <input type="date" name="TanggalPeminjaman" required>

        <label for="TanggalPengembalian">Tanggal Pengembalian:</label>
        <input type="date" name="TanggalPengembalian" required>

        <input type="submit" value="Pinjam">
    </form>
 
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              
                <?php
                while ($row_peminjaman = $result_peminjaman->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_peminjaman['Judul'] . "</td>";
                    echo "<td>" . $row_peminjaman['TanggalPeminjaman'] . "</td>";
                    echo "<td>" . $row_peminjaman['TanggalPengembalian'] . "</td>";
                    echo "<td>" . $row_peminjaman['StatusPeminjaman'] . "</td>";
                    echo "<td><a href='proses_peminjaman.php?op=edit&PeminjamanID=" . $row_peminjaman['PeminjamanID'] . "' >
                    Kembalikan
                    </a></td>"; // Tambahkan link edit dengan ID peminjaman
                    echo "</tr>";
                }
                
                ?>
            </tbody>
            
        </table>
    </div>
</div>

 

  <script src="script.js"></script>

</body>
</html>