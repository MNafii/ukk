<?php
session_start();
include '../config/koneksi.php';
$userid = $_SESSION['userid'];
$user = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
        alert('Login terlebih dahulu..');
        location.href = '../auth/login.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Galeri Foto - Home</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Web Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php"><u>Home</u></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="foto.php">Foto</a>
                    </li>
                </ul>
                <div class="ms-auto d-flex align-items-center">
                    <p style="font-weight: 600; width: 105px;" class="me-3 m-0 d-inline-block text-truncate text-white">Hai <?php echo "$_SESSION[username]" ?></p>
                    <a href="../config/aksi_logout.php" class="btn btn-danger">LOGOUT</a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid = '$userid'");
            while ($data = mysqli_fetch_array($query)) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" alt="" class="card-img-top" style="height: 12rem;">
                        <div class="card-body">
                            <h3 class="text-center"><?php echo $data['judulfoto'] ?></h3>
                        </div>
                        <div class="card-footer text-center">
                            <?php
                            $fotoid = $data['fotoid'];
                            $cekSuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid = '$fotoid' AND userid = '$userid'");

                            if (mysqli_num_rows($cekSuka) == 1) { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka" style=" background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 15%, rgba(0,212,255,1) 100%); -webkit-text-fill-color: transparent; background-clip: text;"><i class="fa fa-heart me-1"></i></a>
                            <?php } else { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka" style=" background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 15%, rgba(0,212,255,1) 100%); -webkit-text-fill-color: transparent; background-clip: text;"><i class="fa-regular fa-heart me-1"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid = '$fotoid'");
                            echo mysqli_num_rows($like) . ' Suka';
                            ?>

                            <a class="ms-3" href="" style=" background: linear-gradient(250deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 75%, rgba(0,212,255,1) 100%); -webkit-text-fill-color: transparent; background-clip: text;"><i class="fa-regular fa-comment me-1"></i>1 Komentar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL | MNafii</p>
    </footer>
</body>

</html>