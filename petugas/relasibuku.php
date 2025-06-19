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
// Sertakan file koneksi database
include '../admin/koneksi.php';
// Proses form saat dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $BukuID = $_POST['BukuID'];
    $KategoriID = $_POST['KategoriID'];
    // Query untuk menyimpan data ke dalam tabel peminjaman
    $query = "INSERT INTO kategoribuku_relasi (BukuID, KategoriID)
     VALUES ('$BukuID','$KategoriID')";
    if ($koneksi->query($query) === TRUE) {
      header("Location: relasibuku.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}
// Query untuk mendapatkan data buku
$query_buku = "SELECT * FROM buku";
$result_buku = $koneksi->query($query_buku);
// Check for errors in the query execution
if (!$result_buku) {
    die("Error in query_buku: " . $koneksi->error);
}
$query_kategori = "SELECT * FROM kategoribuku";
$result_kategori = $koneksi->query($query_kategori);
if  (!$result_kategori) {
  die("Error in query_kategori: " . $koneksi->error);
}
// Query untuk mendapatkan data buku yang telah dipinjam oleh user
$query_relasi = "SELECT k.NamaKategori, b.Judul
                FROM kategoribuku_relasi r
                INNER JOIN buku b ON r.BukuID = b.BukuID
                INNER JOIN kategoribuku k ON r.KategoriID = k.KategoriID
                WHERE r.KategoribukuID = ?";
$stmt = $koneksi->prepare($query_relasi);
$stmt->bind_param("s", $KategoribukuID);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($NamaKategori, $Judul);

while ($stmt->fetch()) {
  echo "<tr>";
  echo "<td>" . $NamaKategori . "</td>";
  echo "<td>" . $Judul . "</td>";
  echo "</tr>";
}
?>
<?php
// Proses penghapusan peminjaman saat tombol "Hapus" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_BukuID'])) {
  $hapus_BukuID = $_POST['hapus_BukuID'];

  // Query untuk menghapus peminjaman berdasarkan BukuID
  $query_hapus = "DELETE FROM kategoribuku_relasi WHERE BukuID = '$hapus_BukuID'";
  $result_hapus = $koneksi->query($query_hapus);
  if ($result_hapus) {
    $succes = "Berhasil menghapus koleksi";
  }else{
    $error  = "Gagal menghapus";
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700
&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
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
      <!--sidebar-->
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
  <!-- Masukkan -->
  <div class="main-content">
    
  <form action="" method="post" class="card">
    <label for="buku">Pilih Buku:</label>
    <select name="BukuID" required>
        <option>Daftar Buku</option>
        <?php
        while ($row = $result_buku->fetch_assoc()) {
            echo "<option value='" . $row['BukuID'] . "'>" . $row['Judul'] . "</option>";
        }
        ?>
    </select><br>
    <label for="buku">Pilih Kategori:</label>
    <select name="KategoriID" required>
        <option>Daftar Kategori</option>
        <?php
        while ($row = $result_kategori->fetch_assoc()) {
            echo "<option value='" . $row['KategoriID'] . "'>" . $row['NamaKategori'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Simpan">
</form>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Buku</th>
                    <th>Aksi</th>                   
                </tr>
            </thead>
            <tbody>
            <?php
           // Reset pointer data ke awal
              $result_buku->data_seek(0);
              $result_kategori->data_seek(0);
              // Menampilkan data buku dan kategori
              while ($row_buku = $result_buku->fetch_assoc()) {
                  // Query untuk mendapatkan kategori yang terkait dengan buku ini
                  $query_relasi = "SELECT k.NamaKategori
                                  FROM kategoribuku_relasi r
                                  INNER JOIN kategoribuku k ON r.KategoriID = k.KategoriID
                                  WHERE r.BukuID = " . $row_buku['BukuID'];
                  $u = 1;
                  $result_relasi = $koneksi->query($query_relasi);
                  if (!$result_relasi) {
                      die("Error in query_relasi: " . $koneksi->error);
                  }
                  echo "<tr>";
                  echo "<td>" . $u++ . "</td>";
                  echo "<td>";
                  // Menampilkan nama kategori terkait dengan buku ini
                  while ($row_relasi = $result_relasi->fetch_assoc()) {
                      echo $row_relasi['NamaKategori'] . " ";     }
                  echo "</td>";
                  echo "<td>" . $row_buku['Judul'] . "</td>";
                  echo "</td>";
                   // Tambahkan tombol hapus dan input hidden untuk menyimpan BukuID
                   echo "<td>";
                   echo "<form method='post'>";
                   echo "<input type='hidden' name='hapus_BukuID' value='" . $row_buku['BukuID'] . "'>";
                   echo "<button type='submit' class='btn btn-danger'>Hapus</button>";
                   echo "</form>";
                   echo "</td>";
                   echo "</tr>";                 
              }  ?>
            </tbody>
        </table>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>