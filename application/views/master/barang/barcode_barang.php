<!-- <div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Barcode
                </h6>
            </div>
            <div class="card-body">
                <?php
                // This will output the barcode as HTML output to display in the browser
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barangs->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                ?>
                <br>
                <?= $barangs->barcode ?>
                <br></br>
                <a href="<?= site_url('barang/barcode_print/' . $barangs->id_barang) ?>" target="_blank" class="btn btn-fa-circle-notch  btn-primary">
                    <i class="fas fa-print"></i>
                </a>

                <a href="<?= site_url("barang") ?>" target="_blank" class="btn btn-fa-circle-notch  btn-info">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
            </tfoot>
            <tbody>
                <tr>
                    <td>
                        <?php
                        // This will output the barcode as HTML output to display in the browser
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barangs->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                        ?>
                        </br>
                        <?= $barangs->barcode ?>
                    </td>
                    <td>
                        <a href="<?= site_url('barang/barcode_print/' . $barangs->id_barang) ?>" target="_blank" class="btn btn-fa-circle-notch  btn-primary">
                            <i class="fas fa-print"></i>
                        </a>

                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div> -->


<div class="container-fluid">
    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800">Barcode Barang</h1>
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Barcode</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            // This will output the barcode as HTML output to display in the browser
                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barangs->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                            ?>
                            </br>
                            <?= $barangs->barcode ?>
                        </td>
                        <td>
                            <a href="<?= site_url('barang/barcode_print/' . $barangs->id_barang) ?>" target="_blank" class="btn btn-fa-circle-notch btn-primary">
                                <i class="fas fa-print"></i>
                            </a>
                            <!-- <a class="badge badge-warning" href="#">Edit</a>
                            <a class="badge badge-danger" href="#">Delete</a> -->
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>