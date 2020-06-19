<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pos - Login</title>

    <script src="<?= base_url('assets/') ?>dist/sweetalert2.min.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/sweetalert2.min.css">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="flash-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

    <div class="flash-info" da ta-flashdata="<?= $this->session->flashdata('info'); ?>"></div>

    <div class="flash-email" da ta-flashdata="<?= $this->session->flashdata('email'); ?>"></div>

    <div class="flash-sucess" data-flashdata="<?= $this->session->flashdata('sucess'); ?>"></div>
    <div class="flash-succes" data-flashdata="<?= $this->session->flashdata('succes'); ?>"></div>
    <div class="flash-gege" data-flashdata="<?= $this->session->flashdata('gege'); ?>"></div>
    <div class="flash-sil" data-flashdata="<?= $this->session->flashdata('sil'); ?>"></div>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Page!</h1>
                                    </div>

                                    <?= $this->session->flashdata('message'); ?>
                                    <form class="user" method="POST" action="<?= base_url('au'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control
                          form-control-user" id="email" placeholder="Enter Emai Address..." name="email" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control
                          form-control-user" id="password" placeholder="Password" name="password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user
                        btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('au/forgotpassword'); ?>">Forgot
                                            Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('au/registration'); ?>">Create an
                                            Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/') ?>js/sb-admin-2.js"></script>
    <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>


    <script>
        const flasherror = $('.flash-error').data('flashdata');
        if (flasherror) {
            Swal.fire({
                title: 'Email',
                text: '' + flasherror,
                icon: 'error'
            });
        }
    </script>
    <script>
        const email = $('.flash-email').data('flashdata');
        if (email) {
            Swal.fire({
                title: 'Gagal',
                text: '' + email,
                icon: 'error'
            });
        }
    </script>
    <script>

        const flashInfo = $('.flash-info').data('flashdata');
        if (flashInfo) {
            Swal.fire({
                title: 'Aktivasi',
                text: '' + flashInfo,
                icon: 'info'
            });
        }
    </script>


    <script>
        const flashsucces = $('.flash-sucess').data('flashdata');
        if (flashsucces) {
            Swal.fire({
                title: ' Aktivasi Berhasil',
                text: '' + flashsucces,
                icon: 'success'
            });
        }
    </script>

    <script>
        const flashgege = $('.flash-gege').data('flashdata');
        if (flashgege) {
            Swal.fire({
                title: 'Password',
                text: '' + flashgege,
                icon: 'error'
            });
        }
    </script>


    <script>
        const flashsil = $('.flash-sil').data('flashdata');
        if (flashsil) {
            Swal.fire({
                title: ' Silakan Aktivasi ',
                text: '' + flashsil,
                icon: 'info'
            });
        }
    </script>

</body>

</html>