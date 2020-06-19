<h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Suppliers (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->fungsi->hitungsup();
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Customer (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->fungsi->hitungcus();
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $this->fungsi->hitungbarang();
                                                                                            ?></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Total stock Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stock; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xl-12 col-lg-7">
        <!-- Area Chart -->
        <div class="panel">
            <div class="panel-heading">
                <!-- <h3>Grafik Total Transaksi </h3> -->
            </div>
            <div class="panel-body">
                <div class="" id="chart"></div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Total Transaksi Barang Perbulan pada Tahun <?= date('Y'); ?></h6>
            </div>

            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Area Chart -->



</div>

<div class="row">

    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-info py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">Stok Barang Minimum</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 text-center table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Stok</th>
                            <th>Pasok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($barang_min) :
                            foreach ($barang_min as $b) :
                        ?>
                                <tr>
                                    <td><?= $b['nama']; ?></td>
                                    <td><?= $b['stock']; ?></td>
                                    <td>
                                        <!-- <a href="<?= base_url() ?>stock/in/add" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Stock in
                                        </a> -->

                                        <a href="<?= base_url('stock/in/add/')?>" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    Tidak ada barang stok minim
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-warning py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">5 Barang Paling laris</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped text-center">
                    <thead>
                        <tr>
                            <!-- <th>Tanggal</th> -->
                            <th> Nama Barang</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($laris as $tbk) : ?>
                            <tr>
                                <!-- <td><strong><?= $tbk->date; ?></strong></td> -->
                                <td><?= $tbk->namabarang; ?></td>
                                <td><span class="badge badge-danger"><?= $tbk->totalas; ?></span></td>
                                <td><span class="badge badge-info"><?= format_rupiah($tbk->hargatotal); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-danger py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">5 Terakhir Barang Keluar</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped text-center">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangk as $tbk) : ?>
                            <tr>
                                <td><strong><?= $tbk['date']; ?></strong></td>
                                <td><?= $tbk['nama']; ?></td>
                                <td><span class="badge badge-danger"><?= $tbk['qty']; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-success py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">5 Terakhir Barang Masuk</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped text-center">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangm as $tbm) : ?>
                            <tr>
                                <td><strong><?= $tbm['date']; ?></strong></td>
                                <td><?= $tbm['namabarang']; ?></td>
                                <td><span class="badge badge-success"><?= $tbm['qty']; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [
                <?php
                if (count($detail) > 0) {
                    foreach ($detail as $data) {
                        echo "'" . bulan($data->bulan) . "',";
                    }
                }
                ?>
            ],
            datasets: [{
                // label: "Earnings",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                label: 'Total Transaksi',
                // backgroundColor: 'rgb(255, 99, 132)',
                // borderColor: 'rgb(255, 99, 132)',
                data: [
                    <?php
                    if (count($detail) > 0) {
                        foreach ($detail as $data) {
                            echo "'" . $data->totals . "',";
                        }
                    }
                    ?>
                ]
            }]
        },

        //Configuration options go here
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }

            }
        }
    });

    // });
</script>