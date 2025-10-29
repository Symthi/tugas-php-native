<?php
/*
 * File: tambah.php
 * Deskripsi: FITUR Create - Form tambah data
 */
session_start();

// Ambil data lama (jika ada) untuk pre-fill form saat validasi gagal
$old_input = $_SESSION['old_input'] ?? [];
// Ambil pesan error (jika ada)
$errors = $_SESSION['errors'] ?? [];

// Hapus session setelah data diambil
unset($_SESSION['old_input']);
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Barang Baru</h1>
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

        <form action="simpan.php" method="POST" class="form-crud">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" id="kode_barang" name="kode_barang" required 
                       value="<?php echo htmlspecialchars($old_input['kode_barang'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" required
                       value="<?php echo htmlspecialchars($old_input['nama_barang'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" required min="0"
                       value="<?php echo htmlspecialchars($old_input['jumlah'] ?? '0', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($old_input['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>

    </div>
</body>
</html>