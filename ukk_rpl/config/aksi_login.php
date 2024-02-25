<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
$cekLogin = mysqli_num_rows($sql);

if ($cekLogin > 0) {
    $data = mysqli_fetch_array($sql);

    $_SESSION['username'] = $data['username'];
    $_SESSION['userid'] = $data['userid'];
    $_SESSION['status'] = 'login';

    echo "<script>
        alert('Berhasil Login, Selamat datang $_SESSION[username]');
        location.href='../admin/index.php';
    </script>";
} else {
    echo "<script>
        alert('Username atau password salah!');
        location.href='../auth/login.php';
    </script>";
}
