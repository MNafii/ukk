<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Galeri Foto - Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
    <div class="vh-100 d-flex align-items-center">
        <div class="container d-flex flex-column align-items-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-top container mt-3">
                        <div class="text-center">
                            <h3 class="fw-bold">LOGIN</h3>
                            <hr>
                        </div>
                    </div>
                    <form action="../config/aksi_login.php" method="post">
                        <div class="card-body">
                            <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control my-1 mb-4" placeholder="Username..." name="username" required>
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control my-1 mb-4" placeholder="Password..." name="password" required>
                        </div>
                        <div class="card-footer">
                            <div class="container">
                                <div class="row justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-primary my-2">MASUK</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="w-100 d-flex justify-content-between my-2">
                    <a href="../index.php" class="text-white"><i class="fa fa-home me-2"></i>Kembali</a>
                    <a href="register.php" class="text-white p-0">Belum memiliki akun?</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>