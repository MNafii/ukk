<?php
session_start();
include 'koneksi.php';

$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];

$cekSuka =  mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid = '$fotoid' AND userid = '$userid'");

if (mysqli_num_rows($cekSuka)) {
    while ($row = mysqli_fetch_array($cekSuka)) {
        $likeid = $row['likeid'];
        $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE likeid = '$likeid'");

        echo "<script>
            location.href = '../admin/index.php';
        </script>";
    }
} else {
    $tanggallike = date('Y-m-d');

    $query = mysqli_query($koneksi, "INSERT INTO likefoto VALUES(0, '$fotoid', '$userid', '$tanggallike')");

    echo "<script>
        location.href = '../admin/index.php';
    </script>";
}
