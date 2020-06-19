<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Print | Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <h4>Detail Transaksi</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Discount</th>
                <th>Total</th>
            </tr>

        </thead>
        <tfoot>

        </tfoot>
        <tbody>
            <?php
            $total = 0;
            $no = 1;
            foreach ($detail as $user) {
                $totalharga = (int) $user->total;
                $total += $totalharga;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user->nama_barang ?></td>
                    <td><?= format_rupiah($user->harga) ?></td>
                    <td><?= $user->qty ?></td>
                    <td><?= format_rupiah($user->discount_barang) ?></td>
                    <td><?= format_rupiah($user->total) ?></td>

                </tr>
            <?php
            } ?>
            <tr>
                <td colspan="5">Total Semua</td>
                <td><?= format_rupiah($total) ?></td>
            </tr>

        </tbody>


    </table>

</body>

</html>