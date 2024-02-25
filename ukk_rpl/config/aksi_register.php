<?php
include 'koneksi.php';


$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];

$sql = mysqli_query($koneksi, "INSERT INTO user VALUES (0, '$username', '$password', '$namalengkap', '$email')");

if ($sql) {
    echo "<script>
            alert('Berhasil membuat akun');
            location.href = '../auth/login.php';
        </script>";
}
