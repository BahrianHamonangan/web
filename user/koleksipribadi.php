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

$UserID = $_SESSION['UserID'];
// koneksi
include '../admin/koneksi.php';
// create 
$succes       = "";
$error        = "";
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['Username'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: ../index.php");
    exit(); // Hentikan eksekusi script setelah mengarahkan pengguna
}

// Proses form saat dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $BukuID = $_POST['BukuID'];

    // Query untuk menyimpan data ke dalam tabel peminjaman
    $query = "INSERT INTO koleksipribadi (UserID, BukuID)
              VALUES ('$UserID', '$BukuID')";

    if ($koneksi->query($query) === TRUE) {
      $succes = "Berhasil menambahkan koleksi baru";
    }else{
      $error  = "Gagal menambahkan koleksi";
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
$query_peminjaman = "SELECT u.UserID, b.Judul, k.BukuID
                    FROM koleksipribadi k
                    JOIN user u ON k.UserID = u.UserID
                    JOIN kategoribuku_relasi kr ON k.BukuID = kr.BukuID
                    JOIN buku b ON kr.BukuID = b.BukuID
                    WHERE k.UserID = '$UserID'";
$result_peminjaman = $koneksi->query($query_peminjaman);

// Check for errors in the query execution
if (!$result_peminjaman) {
    die("Error in query_peminjaman: " . $koneksi->error);
}
?>

<?php
// Proses penghapusan peminjaman saat tombol "Hapus" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_BukuID'])) {
  $hapus_BukuID = $_POST['hapus_BukuID'];

  // Query untuk menghapus peminjaman berdasarkan BukuID
  $query_hapus = "DELETE FROM koleksipribadi WHERE BukuID = '$hapus_BukuID'";
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
 
   <div class="main-content">
  <!-- menambahkan kata sukses dan error -->
   <?php
      if($error){
        ?>
          <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
          </div>
        <?php  
        header("refresh:1;url=koleksipribadi.php"); //3 detik
      }
      ?>
      <?php
      if ($succes) {
        ?>
         <div class="alert alert-success" role="alert">
             <?php echo $succes ?>
          </div>
        <?php
        header("refresh:1;url=koleksipribadi.php"); //3 detik
      }
    ?>

   <form action="" method="post" class="card">
    <label for="kategori">Pilih Kategori:</label>
    <select name="KategoriID" id="kategoriDropdown" onchange="loadBooks()">
        <option value="">Pilih Kategori</option>
        <!-- Isi dropdown dengan data NamaKategori dari tabel kategoribuku -->
        <?php
        include '../admin/koneksi.php';

        $query_kategori = "SELECT * FROM kategoribuku";
        $result_kategori = $koneksi->query($query_kategori);

        while ($row_kategori = $result_kategori->fetch_assoc()) {
            echo "<option value='" . $row_kategori['KategoriID'] . "'>" . $row_kategori['NamaKategori'] . "</option>";
        }
        ?>
    </select>

    <label for="buku">Pilih Buku:</label>
    <select name="BukuID" id="bukuDropdown" required>
        <option value="">Pilih Buku</option>
        <!-- Opsi buku akan diisi menggunakan AJAX -->
    </select>

    <!-- Fungsi JavaScript -->
    <script>
    function loadBooks() {
        var kategoriID = document.getElementById("kategoriDropdown").value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("bukuDropdown").innerHTML = this.responseText;
            }
        };
      
        xhr.open("GET", "load_books.php?KategoriID=" + kategoriID, true);
        xhr.send();
    }
    </script>
    <input type="submit" value="Tambah">
</form>


    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>User </th>
                    <th>Buku </th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              
                <?php
                while ($row_peminjaman = $result_peminjaman->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_peminjaman['UserID'] . "</td>";
                    echo "<td>" . $row_peminjaman['Judul'] . "</td>";
                     // Tambahkan tombol hapus dan input hidden untuk menyimpan BukuID
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='hapus_BukuID' value='" . $row_peminjaman['BukuID'] . "'>";
                    echo "<button type='submit' class='btn btn-danger'>Hapus</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
        </table>
       
    </div>
  </div>
   </div>
  </div>
  <script src="script.js"></script>
</body>
</html>