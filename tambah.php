<?php
// Buat koneksi ke database PostgreSQL, sesuaikan dengan informasi koneksi Anda
$conn = pg_connect("host=localhost port=5432 dbname=pemasukanbarang user=postgres password=Sayangmama14");

// Cek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

// Ambil data dari form
$nama_barang = $_POST["nama_barang"];
$stok = $_POST["stok"];

// Tambahkan data barang ke database
$sql = "INSERT INTO stok (jenis, namabarang, jumlahbarang) VALUES ('as', '$nama_barang', $stok)";

if (pg_query($conn, $sql)) {
    header("Location: index.php"); // Redirect kembali ke halaman utama
} else {
    echo "Error: " . $sql . "<br>" . pg_last_error($conn);
}

// Tutup koneksi database
pg_close($conn);
?>
