<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Pos - Struk Transaksi</title>


    <style type="text/css">
        html {
            font-family: "Verdana, Arial";
        }

        .content {
            width: 88mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;

        }

        .thanks {
            margin-top: 10px;
            padding-top: 12px;
            padding-bottom: 8px;
            text-align: center;
            border-top: 1px solid;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">

        <div class="title">

            <b>Toko-Kita</b>
            <br>
            Jl.yang Benar
            <br>
        </div>

        <div class="head">

            <table cellspasing="0" cellpadding="0">
                <tr>
                    <td style="width: 200px">
                        <?php

                        use Sabberworm\CSS\Value\Value;

                        echo date("d/m/Y", strtotime($penjualan->date)) . "" . date("H:i", strtotime($penjualan->created));
                        ?>
                    </td>
                    <td>Kasir</td>
                    <td style="text-align:center; width: 10px">:</td>
                    <td style="text-align: right">
                        <?= ucfirst($penjualan->usname) ?>
                    </td>
                </tr>
                <tr>
                    <td><?= $penjualan->invoice ?></td>
                    <td>Customer</td>
                    <td style="text-align:center; width: 10px">:</td>
                    <td style="text-align: right">
                        <?= $penjualan->id_customer == null ? "Umum" : $penjualan->cusnama ?>
                    </td>
                </tr>
            </table>
        </div>


        <div class="trasaction">
            <table class="transaction-table" cellsapcing="0" cellspadding="0">
                <?php
                $arr_discount  = array();
                foreach ($detail as $key => $value) { ?>
                    <tr>
                        <td style="width: 165px"> <?= $value->nama ?></td>
                        <td><?= $value->qty ?></td>
                        <td style=" text-align: right; width: 60px"> <?= format_rupiah($value->harga) ?></td>
                        <td style=" text-align: right; width: 60px">
                            <?= format_rupiah(($value->harga - $value->discount_barang) * $value->qty) ?></td>
                    </tr>
                    <?php
                    if ($value->discount_barang > 0) {
                        $arr_discount[] = $value->discount_barang;
                    }
                }
                foreach ($arr_discount as $key => $value) { ?>

                    <tr>
                        <td></td>
                        <td colspan="2" style="text-align: right">Disc.<?= ($key + 1) ?></td>
                        <td style="text-align: right"><?= $value ?></td>
                    </tr>
                <?php
                } ?>
                <tr>
                    <td colspan="4" style="border-bottom: 1px dashed; padding-top: 5px"></td>
                </tr>

                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top: 5px">Sub Total</td>
                    <td style="text-align: right; padding-top: 5px"><?= format_rupiah($penjualan->total_harga) ?></td>

                </tr>
                <?php if ($penjualan->discount > 0) { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right; padding-bottom: 5px">Disc. Penjualan</td>
                        <td style="text-align: right; padding-bottom: 5px"><?= format_rupiah($penjualan->discount) ?></td>
                    </tr>
                <?php
                } ?>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-bottom: 5px">Grant Total</td>
                    <td style="text-align: right; padding-bottom: 5px 0"><?= format_rupiah($penjualan->final_harga) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-bottom: 5px">Cash</td>
                    <td style="text-align: right; padding-bottom: 5px 0"><?= format_rupiah($penjualan->cash) ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-bottom: 5px">Change</td>
                    <td style="text-align: right; padding-bottom: 5px 0"><?= format_rupiah($penjualan->remaining) ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            -----Terima kasih-----
            <br>
            www.tokokita.com
        </div>
    </div>
</body>

</html>