<?php
/*
 * File: index.php
 * Deskripsi: Halaman utama (Read, Search, Pagination, link ke C-U-D)
 */
session_start();
require_once 'config/database.php';

// --- FITUR: Pagination (Minimal 5 data/halaman) ---
$data_per_halaman = 5;
$halaman_aktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_aktif = max(1, $halaman_aktif);
$offset = ($halaman_aktif - 1) * $data_per_halaman;

// --- FITUR: Pencarian (Keyword pada 1+ kolom) ---
$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$params = []; // Array untuk parameter PDO
$query_where = "";

if (!empty($keyword)) {
    $query_where = " WHERE nama_barang LIKE :keyword OR kode_barang LIKE :keyword";
    $params[':keyword'] = "%" . $keyword . "%";
}

// --- Query untuk menghitung total data (untuk pagination) ---
$sql_total = "SELECT COUNT(id) FROM barang" . $query_where;
$stmt_total = $pdo->prepare($sql_total);
$stmt_total->execute($params);
$total_data = $stmt_total->fetchColumn();
$total_halaman = ceil($total_data / $data_per_halaman);

// --- Query utama untuk mengambil data ---
// FITUR: Read, urutkan berdasarkan created_at desc
$sql_data = "SELECT id, kode_barang, nama_barang, jumlah, created_at 
             FROM barang" . $query_where . 
           " ORDER BY created_at DESC 
             LIMIT :limit OFFSET :offset";

$stmt_data = $pdo->prepare($sql_data);

// Bind parameter pencarian (jika ada)
foreach ($params as $key => &$val) {
    // FITUR Keamanan: SQL Injection dicegah dengan bindParam
    $stmt_data->bindParam($key, $val);
}

// Bind parameter pagination
$stmt_data->bindValue(':limit', $data_per_halaman, PDO::PARAM_INT);
$stmt_data->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt_data->execute();
$daftar_barang = $stmt_data->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Inventaris Barang</h1>

        <a href="tambah.php" class="btn btn-primary">Tambah Barang Baru</a>

        <form action="index.php" method="GET" class="form-cari">
            <input type="text" name="cari" placeholder="Cari nama atau kode..." 
                   value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); // FITUR Keamanan: XSS ?>">
            <button type="submit" class="btn btn-info">Cari</button>
            <?php if (!empty($keyword)): ?>
                <a href="index.php" class="btn btn-secondary">Reset</a>
            <?php endif; ?>
        </form>

        <?php if (isset($_SESSION['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                echo htmlspecialchars($_SESSION['pesan'], ENT_QUOTES, 'UTF-8');
                unset($_SESSION['pesan']);
                ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Barang</th> <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftar_barang)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php $nomor = $offset + 1; ?>
                    <?php foreach ($daftar_barang as $barang): ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo htmlspecialchars($barang['kode_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($barang['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($barang['jumlah'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($barang['created_at'])); ?></td>
                            <td class="aksi">
                                <a href="detail.php?id=<?php echo $barang['id']; ?>" class="btn btn-info">Detail</a>
                                <a href="edit.php?id=<?php echo $barang['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?php echo $barang['id']; ?>" class="btn btn-danger" 
                                   onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <nav class="pagination">
            <?php if ($total_halaman > 1): ?>
                <?php if ($halaman_aktif > 1): ?>
                    <a href="?halaman=<?php echo $halaman_aktif - 1; ?>&cari=<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>">&laquo;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                    <a href="?halaman=<?php echo $i; ?>&cari=<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>"
                       class="<?php echo ($i == $halaman_aktif) ? 'active' : ''; ?>">
                       <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($halaman_aktif < $total_halaman): ?>
                    <a href="?halaman=<?php echo $halaman_aktif + 1; ?>&cari=<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>">&raquo;</a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
    </div>
</body>
</html>