<?php
// Buat koneksi ke database PostgreSQL, sesuaikan dengan informasi koneksi Anda
$conn = pg_connect("host=localhost port=5432 dbname=pemasukanbarang user=postgres password=Sayangmama14");

// Cek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

// Ambil data ID barang dari parameter URL
$id_barang = $_GET["id"];

// Ambil data barang dari database
$sql = "SELECT * FROM barang WHERE id = $id_barang";
$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
} else {
    echo "Data barang tidak ditemukan.";
    pg_close($conn);
    exit;
}

// Proses jika tombol "Update" ditekan
if (isset($_POST["update"])) {
    $nama_barang = $_POST["nama_barang"];
    $stok = $_POST["stok"];

    // Update data barang ke database
    $sql = "UPDATE barang SET nama_barang = '$nama_barang', stok = $stok WHERE id = $id_barang";

    if (pg_query($conn, $sql)) {
        header("Location: index.php"); // Redirect kembali ke halaman utama
    } else {
        echo "Error updating record: " . pg_last_error($conn);
    }
}

// Tutup koneksi database
pg_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang</h1>
    <form action="" method="post">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?php echo $row["nama_barang"]; ?>" required>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" value="<?php echo $row["stok"]; ?>" required>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
