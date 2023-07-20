<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Stok Barang</title>
</head>
<body>
    <h1>Manajemen Stok Barang</h1>

    <?php
    // Buat koneksi ke database PostgreSQL, sesuaikan dengan informasi koneksi Anda
    $conn = pg_connect("host=localhost port=5432 dbname=pemasukanbarang user=postgres password=Sayangmama14");

    // Cek apakah koneksi berhasil
    if (!$conn) {
        die("Koneksi gagal: " . pg_last_error());
    }

    // Tampilkan daftar barang
    $sql = "SELECT * FROM stok";
    $result = pg_query($conn, $sql);

    if (pg_num_rows($result) > 0) {
        echo "<h2>Daftar Barang:</h2>";
        echo "<ul>";
        while ($row = pg_fetch_assoc($result)) {
            echo "<li>".$row["jenis"]. " ". $row["namabarang"] . " - Stok: " . $row["jumlahbarang"] . " <a href='edit.php'>Edit</a> <a href='hapus.php'>Hapus</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Belum ada data barang.</p>";
    }

    // Tutup koneksi database
    pg_close($conn);
    ?>

    <h2>Tambah Barang:</h2>
    <form action="tambah.php" method="post">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" required>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
