<?php
require_once 'config/database.php';

$id = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    header("Location: index.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
    $stmt->execute([$id]);
    $barang = $stmt->fetch();

    if (!$barang) {
        session_start();
        $_SESSION['pesan'] = "Data barang dengan ID $id tidak ditemukan.";
        header("Location: index.php");
        exit;
    }

} catch (\PDOException $e) {
    error_log("Error Detail: " . $e->getMessage());
    die("Gagal mengambil data.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang: <?php echo htmlspecialchars($barang['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Detail Barang</h1>
        
        <table class="table-detail">
            <tr>
                <th>ID</th>
                <td><?php echo $barang['id']; ?></td>
            </tr>
            <tr>
                <th>Kode Barang</th>
                <td><?php echo htmlspecialchars($barang['kode_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Nama Barang</th>
                <td><?php echo htmlspecialchars($barang['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td><?php echo htmlspecialchars($barang['jumlah'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>
                    <?php 
                    $deskripsi = $barang['deskripsi'] ? $barang['deskripsi'] : '(Tidak ada deskripsi)';
                    echo nl2br(htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8')); 
                    ?>
                </td>
            </tr>
             <tr>
                <th>Dibuat Pada</th>
                <td><?php echo date('d-m-Y H:i:s', strtotime($barang['created_at'])); ?></td>
            </tr>
             <tr>
                <th>Diperbarui Pada</th>
                <td><?php echo date('d-m-Y H:i:s', strtotime($barang['updated_at'])); ?></td>
            </tr>
        </table>
        
        <br>
        <a href="index.php" class="btn btn-secondary">Kembali ke Daftar</a>
        <a href="edit.php?id=<?php echo $barang['id']; ?>" class="btn btn-warning">Edit Data Ini</a>

    </div>
</body>
</html>