<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/user.css" rel="stylesheet">

</head>

<body class="bg-white">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-2 mt-5 ">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Daftar ArsipKu!</h1>
                    </div>
                    <div class="text-danger font-weight-bold text-center">
                        <?php echo validation_errors(); ?>
                    </div>

                    <form class="user" action="<?=base_url()?>auth/daftar" method="post">

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" placeholder="Nama Lengkap"
                                name="nama" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control form-control-user" placeholder="Nomor HP/Telp"
                                name="telp" required>
                        </div>
                        <div class="form-group">
                            <textarea name="alamat" id="" class="form-control form-control-user" placeholder="Alamat"
                                required></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                    placeholder="Buat Kata Sandi" name="password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                    placeholder="Masukkan Lagi Kata Sandi" name="passconf" required>
                            </div>
                        </div>
                        <input type="submit" value="Daftar" class="btn btn-warning btn-user btn-block">
                        <hr>

                    </form>
                    <hr>

                    <div class="text-center">
                        <span class="small">Sudah memiliki akun? </span><a class="small font-weight-bold"
                            href="<?=base_url()?>auth"><u>Masuk!</u> </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>