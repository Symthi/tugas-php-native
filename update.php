<?php
/*
 * File: update.php
 * Deskripsi: FITUR Update - Logika update data
 */
session_start();
require_once 'config/database.php';

// Hanya proses jika request method adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil data
    $id = $_POST['id'];
    $kode_barang = trim($_POST['kode_barang']);
    $nama_barang = trim($_POST['nama_barang']);
    $jumlah = trim($_POST['jumlah']);
    $deskripsi = trim($_POST['deskripsi']) ?: null;

    // 2. FITUR: Validasi Sisi Server
    $errors = [];
    if (empty($id) || !is_numeric($id)) {
        $errors[] = "ID barang tidak valid.";
    }
    if (empty($kode_barang)) {
        $errors[] = "Kode barang wajib diisi.";
    }
    if (empty($nama_barang)) {
        $errors[] = "Nama barang wajib diisi.";
    }
    if ($jumlah === '') {
        $errors[] = "Jumlah wajib diisi.";
    } elseif (!is_numeric($jumlah) || $jumlah < 0) {
        $errors[] = "Jumlah harus berupa angka positif atau nol.";
    }

    // Validasi duplikat kode (jika kode diubah dan duplikat dengan ID lain)
    if (empty($errors)) {
        try {
            $stmt_check = $pdo->prepare("SELECT id FROM barang WHERE kode_barang = ? AND id != ?");
            $stmt_check->execute([$kode_barang, $id]);
            if ($stmt_check->fetch()) {
                $errors[] = "Kode barang '$kode_barang' sudah digunakan oleh barang lain.";
            }
        } catch (\PDOException $e) {
            $errors[] = "Gagal memvalidasi kode barang.";
            error_log("PDO Error (Check Duplikat Update): " . $e->getMessage());
        }
    }

    // 3. Jika ada error validasi, kembali ke form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header("Location: edit.php?id=" . $id);
        exit;
    }

    // 4. Jika validasi lolos, update ke DB
    try {
        // FITUR Keamanan: SQL Injection dicegah
        $sql = "UPDATE barang SET 
                    kode_barang = :kode, 
                    nama_barang = :nama, 
                    jumlah = :jml, 
                    deskripsi = :desk
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':kode' => $kode_barang,
            ':nama' => $nama_barang,
            ':jml'  => $jumlah,
            ':desk' => $deskripsi,
            ':id'   => $id
        ]);

        $_SESSION['pesan'] = "Data barang berhasil diperbarui.";
        header("Location: index.php");
        exit;

    } catch (\PDOException $e) {
        $errors[] = "Gagal memperbarui data. Terjadi kesalahan database.";
        error_log("PDO Error (Update): " . $e->getMessage());

        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header("Location: edit.php?id=" . $id);
        exit;
    }

} else {
    header("Location: index.php");
    exit;
}