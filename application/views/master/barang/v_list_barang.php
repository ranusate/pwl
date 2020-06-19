<?php $this->view('alert'); ?>
<h1 class="h3 mb-2 text-gray-800"> <?= $judul; ?></h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?= base_url() ?>barang/tambah" class="active btn btn-primary">
            <i class="fas fa-plus"></i> Barang
        </a>
        <a href="<?= base_url() ?>stock/in/add" class="btn btn-info">
            <i class="fas fa-plus"></i> Stock in
        </a>
        <a href="<?= base_url() ?>stock/out/add" class="btn btn-success">
            <i class="fas fa-plus"></i> Stock out
        </a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($barangs as $user) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php
                                    // This will output the barcode as HTML output to display in the browser
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                                    ?></br>
                                    <?= $user->barcode ?>
                                    <br>
                                </td>
                                <td><?= $user->nama ?></td>
                                <td><?= format_rupiah($user->harga) ?></td>
                                <td><?= $user->stock ?></td>
                                <td style="text-align:center;" class="image">
                                    <img src='<?= base_url('assets/img/') . $user->image ?>' onerror="this.onerror=null;this.src='<?= base_url() . "assets/img/no_img.png" ?>';" alt="<?= $user->image  ?>" width="100" alt="">
                                </td>
                                <td><?= $user->kat ?></td>
                                <td>
                                    <a href="<?= site_url("barang/update/$user->id_barang") ?>" class="btn btn-sm btn-warning active">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url("barang/delete/$user->id_barang") ?>" class="active btn btn-sm btn-danger tombol-hapus">
                                        <i class="fas fa-trash "></i>
                                    </a>
                                    <!-- <a href="<?= site_url("barang/barcode_qr/$user->id_barang") ?>" class="btn btn-sm btn-info active" id="detail-barang">
                                        <i class="fas fa-barcode"></i>
                                    </a> -->
                                    <button class="btn btn-sm btn-info active" id="detail-barang" data-toggle="modal" data-target="#modal-detail" data-id="<?= $user->id_barang ?>" data-barcode="<?= $user->barcode ?>">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal hapus -->
    <div class="modal fade " id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary text-center" id="tambahUserTitle">
                        </i> Barcode Barang
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <div class="card-body">
                            <?php
                            // This will output the barcode as HTML output to display in the browser
                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                            ?>
                            <br>
                            <?= $user->barcode ?>
                            <br></br>
                            <a href="<?= site_url('barang/barcode_print/' . $user->id_barang) ?>" target="_blank" class="btn btn-fa-circle-notch  btn-primary">
                                <i class="fas fa-print"></i>
                            </a>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        const flashsuccess = $('.flash-data').data('flashdata');
        if (flashsuccess) {
            Swal.fire({
                title: 'Data barang',
                text: '' + flashsuccess,
                icon: 'success'
            });
        }
    </script>

    <script>
        const flashEror = $('.flash-barcode').data('flashdata');
        if (flashEror) {
            Swal.fire({
                title: 'Barcode',
                text: '' + flashEror,
                icon: 'error'
            });
        }
    </script>


    <script>
        const flashData = $('.flash-error').data('flashdata');
        if (flashData) {
            Swal.fire({
                title: 'Data barang',
                text: '' + flashData,
                icon: 'error'
            });
        }
    </script>

    <script>
        //swall barang hapus
        $('.tombol-hapus').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Anda yakin?',
                text: "Hapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            });
        });
    </script>