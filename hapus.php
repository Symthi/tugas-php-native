<?php
session_start();
require_once 'config/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['pesan'] = "Data barang berhasil dihapus.";

    } catch (\PDOException $e) {
        error_log("Error Hapus: " . $e->getMessage());
        $_SESSION['pesan'] = "Gagal menghapus data. Terjadi kesalahan.";
    }

} else {
    $_SESSION['pesan'] = "ID tidak valid.";
}

header("Location: index.php");
exit;