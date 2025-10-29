<?php
session_start();
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil data
    $kode_barang = trim($_POST['kode_barang']);
    $nama_barang = trim($_POST['nama_barang']);
    $jumlah = trim($_POST['jumlah']);
    $deskripsi = trim($_POST['deskripsi']) ?: null;

    $errors = [];
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

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header("Location: tambah.php");
        exit;
    }

    try {
        $sql = "INSERT INTO barang (kode_barang, nama_barang, jumlah, deskripsi) 
                VALUES (:kode, :nama, :jml, :desk)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':kode' => $kode_barang,
            ':nama' => $nama_barang,
            ':jml'  => $jumlah,
            ':desk' => $deskripsi
        ]);

        $_SESSION['pesan'] = "Data barang baru berhasil disimpan.";
        header("Location: index.php");
        exit;

    } catch (\PDOException $e) {
        if ($e->getCode() == 23000) {
            $errors[] = "Kode barang '$kode_barang' sudah ada. Silakan gunakan kode lain.";
        } else {
            $errors[] = "Gagal menyimpan data. Terjadi kesalahan database.";
            error_log("PDO Error (Simpan): " . $e->getMessage()); // Log error
        }

        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header("Location: tambah.php");
        exit;
    }

} else {
    header("Location: index.php");
    exit;
}