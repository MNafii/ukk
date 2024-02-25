<?php
session_start();
include '../config/koneksi.php';
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
    <title>Web Galeri Foto - Foto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php">Web Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="foto.php"><u>Foto</u></a>
                    </li>
                </ul>
                <div class="ms-auto d-flex align-items-center justify-content-between">
                    <p style="font-weight: 600; width: 105px;" class="me-3 m-0 d-inline-block text-truncate text-white">Hai <?php echo "$_SESSION[username]" ?></p>
                    <a href="../config/aksi_logout.php" class="btn btn-danger">LOGOUT</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">
                        <h3>Tambah Foto</h3>
                    </div>
                    <form action="../config/aksi_foto.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" class="form-control mb-3" name="judulfoto" placeholder="Judul Foto..." required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control mb-3" name="deskripsifoto" required placeholder="Deskripsi..."></textarea>
                            <label class="form-label">Album</label>
                            <select name="albumid" class="form-control mb-3">
                                <?php
                                $userid = $_SESSION['userid'];
                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid = '$userid'");
                                while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                    <option value="<?php echo $data_album['albumid'] ?>">
                                        <?php echo $data_album['namaalbum'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label class="form-label">File Foto</label>
                            <input type="file" class="form-control mb-3" name="lokasifile" required>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-outline-primary w-100 my-2" type="submit" name="tambah">
                                Tambahkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">
                        <h3>Data Foto</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <?php
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid = '$userid'");
                            $cekData = mysqli_num_rows($sql);
                            if ($cekData > 0) { ?>
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Judul Foto</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = '1';
                                    $userid = $_SESSION['userid'];
                                    $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid = $userid");
                                    while ($data = mysqli_fetch_array($sql)) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++ ?></td>
                                            <td class="text-center"><img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="img-thumbnail" width="150px"></td>
                                            <td class="text-center"><?php echo $data['judulfoto'] ?></td>
                                            <td class="text-center">
                                                <p class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo $data['deskripsifoto'] ?></p>
                                            </td>
                                            <td class="text-center"><?php echo $data['tanggalunggah'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- hapus -->
                                        <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Foto <strong><?php echo $data['judulfoto'] ?></strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="../config/aksi_foto.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?php echo $data['fotoid'] ?>" name="fotoid">
                                                            <p>Yakin untuk menghapus foto?</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- edit -->
                                        <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Foto <?php echo $data['judulfoto'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="../config/aksi_foto.php" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?php echo $data['fotoid'] ?>" name="fotoid">
                                                            <label class="form-label">Nama Album</label>
                                                            <input type="text" class="form-control mb-3" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" placeholder="Judul Foto..." required>
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsifoto" required placeholder="Deskripsi Foto..."><?php echo $data['deskripsifoto'] ?></textarea>
                                                            <label class="form-label">Album</label>
                                                            <select name="albumid" class="form-control mb-3">
                                                                <?php
                                                                $userid = $_SESSION['userid'];
                                                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid = '$userid'");
                                                                while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                    <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid'] ?>">
                                                                        <?php echo $data_album['namaalbum'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="img-thumbnail" width="150px">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="form-label">File Foto</label>
                                                                    <input type="file" class="form-control mb-3" name="lokasifile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-warning" name="edit">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            <?php } else { ?>
                                <div class="container d-flex flex-column justify-content-center align-items-center">
                                    <h3 class="m-0">Data Kosong</h3>
                                    <p class="m-0">Isi data terlebih dahulu</p>
                                </div>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL | MNafii</p>
    </footer>
</body>

</html>