<?php
include '../admin/koneksi.php';

if (isset($_GET['KategoriID'])) {
    $KategoriID = $_GET['KategoriID'];

    $query_books = "SELECT kategoribuku_relasi.BukuID, buku.Judul
                    FROM kategoribuku_relasi
                    JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID
                    WHERE kategoribuku_relasi.KategoriID = '$KategoriID'";

    $result_books = $koneksi->query($query_books);

    if ($result_books) {
        $output = "<option value=''>Pilih Buku</option>";
        while ($row_books = $result_books->fetch_assoc()) {
            $output .= "<option value='" . $row_books['BukuID'] . "'>" . $row_books['Judul'] . "</option>";
        }
        echo $output;
    } else {
        echo "<option value=''>Tidak ada buku</option>";
    }
}
?>

