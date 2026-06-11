<?php
session_start();
require_once '../helper/connection.php';

// Terima ID yang dikirimkan via URL
$data_raspi_id = isset($_GET['data_raspi_id']) ? $_GET['data_raspi_id'] : null;  // ID untuk data_raspi yang akan dihapus

// Pastikan nilai data_raspi_id ada
if ($data_raspi_id === null) {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'ID Data Raspi tidak ditemukan.'
    ];
    header('Location: ./pi2.php');
    exit();
}

// Pastikan nilai-nilai tersebut aman
$data_raspi_id = mysqli_real_escape_string($connection, $data_raspi_id);

// Mulai transaksi untuk memastikan konsistensi data
mysqli_begin_transaction($connection);

try {
    // Hapus data dari tabel data_raspi
    $query_data_raspi = "DELETE FROM data_raspi WHERE data_raspi_id = '$data_raspi_id'";
    $result = mysqli_query($connection, $query_data_raspi);

    // Periksa apakah query berhasil
    if ($result) {
        // Jika berhasil, commit transaksi
        mysqli_commit($connection);
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Berhasil menghapus data'
        ];
    } else {
        // Jika gagal, rollback transaksi
        mysqli_rollback($connection);
        $_SESSION['info'] = [
            'status' => 'failed',
            'message' => 'Gagal menghapus data. Error: ' . mysqli_error($connection)
        ];
    }

    // Arahkan kembali ke halaman utama
    header('Location: ./pi2.php');
    exit();
} catch (Exception $e) {
    // Jika terjadi error lain, rollback transaksi
    mysqli_rollback($connection);

    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Gagal menghapus data: ' . $e->getMessage()
    ];
    header('Location: ./pi2.php');
    exit();
}
?>
