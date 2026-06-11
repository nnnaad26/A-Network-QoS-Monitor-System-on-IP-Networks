<?php
require_once '../helper/connection.php';

function getData($connection, $raspi_id) {
    $query = "SELECT bandwidth, latency, jitter, packet_loss, DATE_FORMAT(created_at, '%H:%i:%s') as timestamp 
              FROM data_raspi 
              WHERE raspi_id = $raspi_id 
              ORDER BY created_at DESC 
              LIMIT 10";
    return mysqli_query($connection, $query);
}

// Ambil data untuk Raspberry Pi 1
$raspi_id_1 = 1;
$data_1 = getData($connection, $raspi_id_1);

// Ambil data untuk Raspberry Pi 2
$raspi_id_2 = 2;
$data_2 = getData($connection, $raspi_id_2);

$data_1_result = mysqli_fetch_all($data_1, MYSQLI_ASSOC);
$data_2_result = mysqli_fetch_all($data_2, MYSQLI_ASSOC);

// Mengeluarkan data dalam format JSON
echo json_encode([
    'raspi_1' => $data_1_result,
    'raspi_2' => $data_2_result
]);
?>
