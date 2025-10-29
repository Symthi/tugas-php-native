# Aplikasi Manajemen Inventaris Sederhana (PHP Native)

Aplikasi ini adalah sistem manajemen inventaris dasar yang dibangun murni menggunakan PHP Native. Tujuannya adalah untuk melacak dan mengelola daftar barang atau aset secara digital.

## Apa itu Manajemen Inventaris?

Manajemen Inventaris (atau *Inventory Management*) adalah proses mengawasi, melacak, dan mengelola stok barang yang dimiliki oleh sebuah organisasi atau individu. Ini mencakup segala hal mulai dari penerimaan barang baru (stok masuk), penyimpanan, hingga pengeluaran atau penggunaan barang (stok keluar).

Tujuan utamanya adalah untuk mengetahui:
* Barang apa saja yang kita miliki?
* Berapa jumlahnya saat ini?
* Di mana lokasinya? (meskipun tidak diimplementasikan di proyek ini)
* Kapan barang itu masuk?

Aplikasi ini menyederhanakan proses tersebut dengan menyediakan antarmuka digital untuk mencatat semua data barang.

## Cara Kerja Aplikasi Ini

Aplikasi ini bekerja dengan menyediakan antarmuka web sederhana untuk melakukan operasi **CRUD (Create, Read, Update, Delete)** pada database barang.

1.  **Read (Membaca Data):** Halaman utama (`index.php`) adalah *dashboard* Anda. Halaman ini membaca semua data dari tabel `barang` di database MySQL dan menampilkannya dalam format tabel yang rapi. Halaman ini juga dilengkapi fitur Pencarian dan Pagination.
2.  **Create (Membuat Data):** Saat Anda menekan tombol "Tambah Barang", Anda akan dibawa ke `tambah.php`. Setelah Anda mengisi form dan menekan "Simpan", data akan dikirim ke `simpan.php`. File ini akan **memvalidasi** data di sisi server (memastikan tidak ada yang kosong atau salah format) sebelum menyimpannya ke database menggunakan koneksi PDO.
3.  **Update (Memperbarui Data):** Saat Anda menekan "Edit", Anda akan dibawa ke `edit.php?id=...`. Halaman ini akan mengambil data barang yang *existing* dari database dan mengisikannya ke dalam form (proses **prefill**). Saat Anda menyimpan perubahan, `update.php` akan memvalidasi dan memperbarui data tersebut di database.
4.  **Delete (Menghapus Data):** Saat Anda menekan "Hapus", sebuah peringatan konfirmasi JavaScript akan muncul. Jika Anda setuju, `hapus.php` akan mengeksekusi perintah `DELETE` di database untuk menghapus data tersebut secara permanen.

Seluruh proses ini diamankan dari serangan umum seperti **SQL Injection** (menggunakan PDO Prepared Statements) dan **XSS** (menggunakan `htmlspecialchars` saat menampilkan data).

## Fitur yang Tersedia

* **Manajemen Barang (CRUD):**
    * **Create:** Menambah data barang baru (Kode, Nama, Jumlah, Deskripsi).
    * **Read:** Menampilkan semua data barang.
    * **Update:** Mengedit data barang yang sudah ada.
    * **Delete:** Menghapus data barang.
* **Detail Barang:** Halaman khusus (`detail.php`) untuk melihat rincian lengkap per item.
* **Pencarian:** Fitur pencarian *real-time* berdasarkan **Nama Barang** atau **Kode Barang**.
* **Pagination:** Data di halaman utama dibatasi 5 item per halaman untuk menjaga performa dan keterbacaan.
* **Validasi Server:** Memastikan data yang masuk ke database valid (misal: jumlah harus angka, nama tidak boleh kosong).
* **Notifikasi:** Pesan sukses atau gagal ditampilkan setelah setiap aksi (Create, Update, Delete).

---

## Kebutuhan Sistem

* **Server Lokal:** Laragon (Sangat direkomendasikan, sesuai spesifikasi).
* **PHP:** Versi 8.0 atau lebih baru.
* **Database:** MySQL (Bawaan Laragon).
* **Ekstensi PHP:** `pdo_mysql` (Harus aktif di Laragon. Cek via Menu > PHP > Extensions > pdo_mysql).
* **Browser Web:** Chrome, Firefox, Edge, dll.

## Cara Instalasi dan Konfigurasi

Berikut adalah langkah-langkah lengkap untuk menjalankan aplikasi ini dari awal di Laragon:

1.  **Unduh/Siapkan Proyek:**
    * Pastikan semua file proyek (`index.php`, `tambah.php`, `setup.sql`, folder `config/`, dll.) berada di dalam satu folder bernama `inventaris`.

2.  **Pindahkan Folder Proyek:**
    * Salin atau pindahkan folder `inventaris` Anda ke dalam direktori `www` milik Laragon.
    * Lokasi default: `C:\laragon\www\inventaris`

3.  **Jalankan Server Laragon:**
    * Buka aplikasi Laragon.
    * Klik tombol **"Start All"**.
    * Pastikan layanan **Apache** dan **MySQL** keduanya berjalan (ditandai "started").

4.  **Setup Database (Langkah Kritis):**
    * Di aplikasi Laragon, klik tombol **"Database"**.
    * Manajer Sesi HeidiSQL akan terbuka. Klik **"Open"** untuk terhubung (Password default Laragon kosong).
    * Sekarang Anda berada di dalam HeidiSQL. Buka file `setup.sql` (dari folder proyek Anda) menggunakan Notepad atau editor teks.
    * **Copy** seluruh isi dari file `setup.sql`.
    * **Paste** kode SQL tersebut ke dalam tab **"Query"** di HeidiSQL.
    * Klik tombol **"Run"** (ikon segitiga biru ▶️) untuk mengeksekusi query.
    * Query ini akan otomatis membuat database `db_inventaris` dan tabel `barang` beserta data contoh.
    * Tekan F5 (atau klik kanan > Refresh) di panel kiri untuk melihat database `db_inventaris` baru Anda.

5.  **Jalankan Aplikasi:**
    * Buka browser web Anda.
    * Ketik alamat berikut di address bar:
    * `http://localhost/inventaris/`

Aplikasi sekarang seharusnya berjalan dan menampilkan data inventaris.

## Struktur Folder
Berikut adalah struktur folder yang bersih dan benar untuk proyek ini:
    /inventaris               (Folder root proyek Anda di C:\laragon\www)
    |
    |-- config/               (Folder untuk file konfigurasi)
    |   |-- database.php      (File koneksi PDO ke database)
    |
    |-- setup.sql             (File script SQL untuk setup database & tabel)
    |-- index.php             (Halaman utama: Read, Search, Pagination)
    |-- tambah.php            (Formulir untuk Create data baru)
    |-- simpan.php            (Logika backend untuk proses Create + Validasi)
    |-- detail.php            (Halaman untuk Read Detail satu item)
    |-- edit.php              (Formulir untuk Update data + Prefill data lama)
    |-- update.php            (Logika backend untuk proses Update + Validasi)
    |-- hapus.php             (Logika backend untuk proses Delete)
    |-- style.css             (File styling untuk mempercantik tampilan)
    |-- README.md             (File ini, dokumentasi proyek)

## Contoh Environment Config
Proyek ini adalah PHP Native dan tidak menggunakan file `.env` seperti framework modern (misal: Laravel).

Semua konfigurasi "environment" (dalam hal ini, koneksi database) disimpan langsung di dalam file `config/database.php`.

Berikut adalah isi dari file `config/database.php` yang sudah disesuaikan untuk Laragon:

```php
<?php
/*
 * File: config/database.php
 * Deskripsi: Konfigurasi koneksi environment database.
 */

// Konfigurasi Database
$host = '127.0.0.1';       // Host database (default Laragon)
$db   = 'db_inventaris'; // Nama database dari file setup.sql
$user = 'root';            // User default MySQL di Laragon
$pass = '';                // Password default MySQL di Laragon (kosong)
$charset = 'utf8mb4';

// Data Source Name (DSN) untuk PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opsi konfigurasi PDO
$options = [
    // Tampilkan error sebagai Exceptions (Pesan error informatif)
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // Ambil data sebagai array asosiatif (contoh: $row['nama_barang'])
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Matikan emulasi prepared statements (lebih aman)
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// ... (Blok try-catch untuk membuat instance $pdo) ...