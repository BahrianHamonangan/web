<?php
include '../admin/koneksi.php';

$PeminjamanID = '';
$StatusPeminjaman = '';
$succes = "";
$error = "";

// membuat update atau edit
if (isset($_GET['op']) && $_GET['op'] == 'edit') {
    $PeminjamanID = $_GET['PeminjamanID'];
    $sql1 = "SELECT * FROM peminjaman WHERE PeminjamanID = '$PeminjamanID'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $PeminjamanID = $r1['PeminjamanID'];
    $StatusPeminjaman = $r1['StatusPeminjaman'];

    if ($PeminjamanID == '') {
        $error = "Data tidak ditemukan";
    }
}

// menambahkan data ke database
if (isset($_POST['simpan'])) {
    $PeminjamanID = $_POST['PeminjamanID'];
    $StatusPeminjaman = $_POST['StatusPeminjaman'];

    if ($StatusPeminjaman) {
        if ($PeminjamanID) { //update
            $sql1 = "UPDATE peminjaman SET StatusPeminjaman='$StatusPeminjaman' WHERE PeminjamanID='$PeminjamanID'";
            $q1 = mysqli_query($koneksi, $sql1);

            if ($q1) {
                $succes = "Data berhasil di edit";
            } else {
                $error = "Data gagal di edit: " . mysqli_error($koneksi);
            }
        } else {
            $error = "PeminjamanID tidak valid";
        }
    } else {
        $error = "Status Peminjaman harus dipilih";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card-body">
        <?php
        if ($error) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
            header("refresh:3;url=proses_peminjaman.php"); //3 detik
        }

        if ($succes) {
            echo "<div class='alert alert-success' role='alert'>$succes</div>";
            header("refresh:3;url=proses_peminjaman.php"); //3 detik
        }
        ?>

        <h2>Edit Status Peminjaman</h2>

        <form action="" method="post">
            <!-- Sertakan ID peminjaman sebagai input tersembunyi -->
            <input type="hidden" name="PeminjamanID" value="<?php echo $PeminjamanID; ?>">

            <label>Status Peminjaman:</label>
            <select name="StatusPeminjaman">
                
                <option value="Telah Di Kembalikan" <?php echo ($StatusPeminjaman == 'kembali') ? 'selected' : ''; ?>>Kembalikan Buku</option>
            </select>

            <input type="submit" name="simpan" value="Kembalikan">
        </form>
    </div>
</body>

</html>
