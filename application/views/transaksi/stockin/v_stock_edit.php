<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Barang Masuk
                </h6>
            </div>
            <div class="card-body">
                <form method="post" class="form" action="<?= base_url('stock/proses') ?>">
                    <div class="form-group">
                        <label for=""> Date</label>
                        <input type="hidden" name="id_barang" id="id_barang">
                        <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" id="date" name="date" required>
                    </div>
                    <!-- <div class="form-group input-group">
                        <input type="text" value="" class="form-control" id="barcode" name="barcode" placeholder="Barcode" required>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-barang">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div> -->
                    <div class="form-group">
                        <label for=""> barang</label>
                        <select name="id_barang" class="form-control" id="select-barang">
                            <option value="" disabled selected>Pilih Barang</option>
                            <?php
                            foreach ($barangs as $b) {
                                echo "<option data-nama='$b->nama' "
                                    . "data-harga='$b->harga' "
                                    . "data-stock='$b->stock' "
                                    . "data-kode='$b->barcode' "
                                    . "data-kategori='$b->kat' "
                                    . "value='$b->id_barang'> "
                                    . "$b->barcode / $b->nama/ $b->stock"
                                    . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" value="" class="form-control" id="nama" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="">Kategori</label>
                                <input type="text" value="" class="form-control" id="kategori" name="kategori" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for=""> Stock</label>
                                <input type="text" value="" class="form-control" id="stock" name="stock" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for=""> Detail</label>
                        <input type="text" value="" class="form-control" id="detail" name="detail" required>
                    </div>
                    <div class="form-group">
                       
                        <label for=""> Suplier</label>
                        <select class="form-control" id="supplier" name="supplier" value="">
                            <option value="" disabled selected>Pilih Supplier</option>
                            <?php
                            foreach ($sups as $data) { ?>
                                <option value="<?= $data->id ?>" <?= $data->id ?>>
                                    <?= $data->nama; ?></option>
                            <?php
                            } ?>
                        </select>


                    </div>
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="number" value="" class="form-control" id="qty" name="qty" required>
                    </div>

                    <div class="card-footer">
                        <a type="button" class="btn btn-danger" href="<?= base_url('stock/in') ?>">Close</a>
                        <button type="submit" name="in_add" class="btn btn-success btn-flat">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal-barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary text-center" id="tambahUserTitle">
                    </i>Stok
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stcok</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($barangs as $user) { ?>
                            <tr>
                                <td><?= $user->barcode ?></td>
                                <td><?= $user->nama ?></td>
                                <td><?= format_rupiah($user->harga) ?></td>
                                <td><?= $user->stock ?></td>
                                <td><?= $user->kat ?></>
                                <td>
                                    <button class="btn btn-xs btn-primary" id="select" data-id="<?= $user->id_barang ?>" data-barcode="<?= $user->barcode ?>" data-nama="<?= $user->nama ?>" data-kategori="<?= $user->kat ?>" data-stock="<?= $user->stock ?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
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
</div>
<script>
    $(function() {

        $("#supplier").select2()
    });
</script>


<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var id_barang = $(this).data('id');
            var barcode = $(this).data('barcode');
            var nama = $(this).data('nama');
            var kategori = $(this).data('kategori');
            var stock = $(this).data('stock');

            $('#id_barang').val(id_barang);
            $('#barcode').val(barcode);
            $('#nama').val(nama);
            $('#kategori').val(kategori);
            $('#stock').val(stock);



            $('.modal-backdrop').hide()
            $('body').removeClass('modal-open');
            $('#modal-barang').modal('hide');
        });




    });
</script>



<script>
    $(function() {
        let barang;
        $("#select-barang")
            .select2().on("change", function() {
                var optionSelected = $(this).children("option:selected");
                $("#barcode").val(optionSelected.data("kode"));
                $("#nama").val(optionSelected.data("nama"));
                $("#harga").val(optionSelected.data("harga"));
                $("#stock").val(optionSelected.data("stock"));
                $("#kategori").val(optionSelected.data("kategori"));
            });

    });
</script>