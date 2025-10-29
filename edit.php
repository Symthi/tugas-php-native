<?php
session_start();
require_once 'config/database.php';

$errors = $_SESSION['errors'] ?? [];
$old_input = $_SESSION['old_input'] ?? null;
unset($_SESSION['errors'], $_SESSION['old_input']);

$id = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    $_SESSION['pesan'] = "ID tidak valid untuk diedit.";
    header("Location: index.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
    $stmt->execute([$id]);
    $barang = $stmt->fetch();

    if (!$barang) {
        $_SESSION['pesan'] = "Data barang dengan ID $id tidak ditemukan.";
        header("Location: index.php");
        exit;
    }
} catch (\PDOException $e) {
    error_log("Error Edit (Fetch): " . $e->getMessage());
    die("Gagal mengambil data untuk diedit.");
}

$kode_val = $old_input['kode_barang'] ?? ($barang['kode_barang'] ?? '');
$nama_val = $old_input['nama_barang'] ?? ($barang['nama_barang'] ?? '');
$jumlah_val = $old_input['jumlah'] ?? ($barang['jumlah'] ?? '');
$deskripsi_val = $old_input['deskripsi'] ?? ($barang['deskripsi'] ?? '');

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang: <?php echo htmlspecialchars($barang['nama_barang'] ?? 'Data Barang', ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Barang</h1>
        <a href="index.php" class="btn btn-secondary">Kembali ke Daftar</a>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <strong>Validasi Gagal!</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="update.php" method="POST" class="form-crud">
            <input type="hidden" name="id" value="<?php echo $barang['id']; ?>">

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" id="kode_barang" name="kode_barang" required 
                       value="<?php echo htmlspecialchars($kode_val, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" required
                       value="<?php echo htmlspecialchars($nama_val, ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" required min="0"
                       value="<?php echo htmlspecialchars($jumlah_val, ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($deskripsi_val, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>

    </div>
</body>
</html>