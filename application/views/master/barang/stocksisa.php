
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?= $judul; ?>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered col-lg-12">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Stock Masuk</th>
                                <th>Stock Keluar</th>
                                <th>Stock Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($stocks as $s) {
                                ?>
                            <tr>
                                    <td><?=$no++ ?></td>
                                    <td><?=$s->produk_kode ?></td>
                                    <td><?=$s->produk_nama ?></td>
                                    <td><?=$s->stock_masuk ?></td>
                                    <td><?=$s->stock_keluar ?></td>
                                    <td><?=$s->stock_sisa ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>