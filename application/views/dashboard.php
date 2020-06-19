<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>POS | <?= $header; ?></title>
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url('assets/') ?>dist/sweetalert2.min.js"></script>

    <!-- jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" />
    <!-- <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css" /> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.full.js"></script>

    <!-- chart -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/sweetalert2.min.css">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <script>
        window.base_url = "<?= base_url() ?>";
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>



</head>


<body id="page-top" class="<?= $this->uri->segment(1) == 'app' ? 'sidebar-collapse' : null ?>">

    <!-- Page Wrapper -->
    <div id="wrapper" class="">
        <!-- Sidebar -->
        <ul class="navbar-nav  bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> POS <sup>app</sup>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'dashboard'  ? 'class="  nav-item active sidebar-collapse"' : ' class="nav-item sidebar-collapse"' ?>>
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>


            <?php if ($this->fungsi->user_login1()->role_user == "admin") { ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li <?= $this->uri->segment(1) == 'customer'  ? 'class=" nav-item  active"' : 'class="nav-item "' ?>>
                    <a class="nav-link" href="<?= base_url('customer') ?>">
                        <i class="fas fa-user-tie"></i>
                        <span>Customer</span></a>
                </li>



                <li <?= $this->uri->segment(1) == 'supplier'  ? 'class=" nav-item  active"' : 'class="nav-item "' ?>>
                    <a class="nav-link" href="<?= base_url('supplier') ?>">
                        <i class="fas fa-users"></i>
                        <span>Supplier</span></a>
                </li>
                <li <?= $this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'barang' ? 'class=" nav-item  active"' : 'class="nav-item "' ?>>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="fab fa-bootstrap"></i>
                        <span> Data Master</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= base_url('kategori') ?>">Kategori Barang</a>
                            <a class="collapse-item" href="<?= base_url('barang') ?>">Barang</a>
                        </div>
                    </div>
                </li>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li <?= $this->uri->segment(1) == 'stock' || $this->uri->segment(1) == 'stock' ? 'class=" nav-item  active"' : 'class="nav-item "' ?>>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-bars"></i>
                        <span class=" fa-layers-text-black-50">Stock</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= base_url('stock/in'); ?>">Stock in</a>
                            <a class="collapse-item" href="<?= base_url('stock/out'); ?>">Stock out</a>
                        </div>
                    </div>
                </li>

                <li <?= $this->uri->segment(1) == 'transaksi/detail_print'  ? 'class=" nav-item  active "' : 'class="nav-item "' ?>>
                    <a class=" nav-link" href="<?= base_url('transaksi/laporan/') ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Laporan</span></a>
                </li>


            <?php
            } ?>
            <li <?= $this->uri->segment(1) == 'transaksi'  ? 'class=" nav-item  active "' : 'class="nav-item "' ?>>
                <a class=" nav-link" href="<?= base_url('transaksi') ?>"><i class="fab fa-bity"></i>
                    <span>Transaksi</span></a>
            </li>
            <li <?= $this->uri->segment(1) == 'app'  ? 'class=" nav-item  active "' : 'class="nav-item "' ?>>
                <a class=" nav-link" href="<?= base_url('app') ?>"><i class="fas fa-chalkboard"></i>
                    <span>App</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->

            <div class=" sidebar-heading">
                Addons
            </div>

            <?php if ($this->fungsi->user_login1()->role_user == "admin") { ?>
                <!-- Nav Item - Pages Collapse Menu -->

                <!-- Nav Item - Charts -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('user'); ?>"><i class="fas fa-user-circle"></i>
                        <span>My frofile</span></a>
                    </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('users'); ?>"><i class="fas fa-user-circle"></i>
                        <span>User</span></a>
                </li>
            <?php
            } ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('login/logout'); ?>"><i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="topbar-divider d-none d-sm-block"></div>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php $this->load->view($page); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; Copyright Point of sale <?= date('Y'); ?>. Build with <i style="color: #e25555;" class="fas fa-heart"></i> & <i class="fas fa-mug-hot"> </i> by <a href="https://www.instagram.com/ranus.ate/"> Ranus Ate </a>.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->




    <!--JQUERY VALIDATION-->
    <script src="<?= base_url() . 'assets/' ?>pt/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="<?= base_url() . 'assets/' ?>pt/plugins/jquery-validation/additional-methods.js"></script>
    <script src="<?= base_url() . 'assets/' ?>pt/plugins/jquery-validation/localization/messages_id.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url('assets/') ?>dist/sweetalert2.min.js"></script>
    <li nk rel="stylesheet" href="<?= base_url('assets/') ?>dist/sweetalert2.min.css">
        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- <script src="<?= base_url('assets/'); ?>js/myscript.js"></script> -->
        <!-- <script src="sweetalert2.all.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/swal/sweetalert.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/swal/sweetalert-dev.js"></script>
        <!-- Page level plugins -->
        <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <!-- <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/demo/chart-bar-demo.js"></script> -->
        <!-- Page level plugins -->
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

        <script src="<?= base_url(); ?>assets/vendor/vendor/gijgo/js/gijgo.min.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
        <!-- <script>
            $(document).ready(function() {
                $('#table1').DataTable()
            });
        </script> -->

        <script type="text/javascript">
            // $.widget.bridge('uibutton', $.ui.button)
            $(document).ready(function() {
                var table = $('#dataTable').DataTable({
                    buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
                    dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
                        "<'row'<'col-md-12'tr>>" +
                        "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
                    lengthMenu: [
                        [5, 10, 25, 50, 100, -1],
                        [5, 10, 25, 50, 100, "All"]
                    ],
                    columnDefs: [{
                        targets: -1,
                        orderable: false,
                        searchable: false
                    }]
                });

                table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
            });
        </script>



</body>

</html>