<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Pilih Barang
                </h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for=""> barang</label>
                    <select name="id_barang" class="js-example-basic-single form-control" id="select-barang">
                        <option value="" disabled selected>Pilih Barang</option>
                        <?php
                        foreach ($barangs as $b) {
                            echo "<option data-nama='$b->nama' "
                                . "data-id='$b->id_barang' "
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
                    <input type="hidden" id="id_barang">
                    <input type="hidden" id="harga">
                    <input type="hidden" id="stock">

                    <input type="hidden" id="bcd">
                    <input type="hidden" id="qty_cart">
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" id="qty" name="qty" value="1" min="1" class="form-control">

                </div>
                <div class="form-group">
                <label for="kasir"> Kasir</label>
                    <input type="text" id="user" value="<?= $this->fungsi->user_login1()->nama_user ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                <label for="date"> Date</label>
                    <input type="date" id="date" value="<?= date('Y-m-d') ?>" class="form-control">

                </div>
                <div class="form-group">
            <label for="customer"> Customer</label>
                    <select class="form-control" id="customer" name="customer" placeholder="" required>
                        <option value="" disabled selected>Pilih Customer</option>
                        <?php $no = 1;
                        foreach ($customer as $data) { ?>
                            <option value="<?= $data->id ?>">
                                <?= $data->nama; ?></option>
                        <?php
                        } ?>
                    </select>
                </div>
                <div class="card-footer">
                    <button type="button" id="add_cart" class="btn active btn-primary apaya">
                        <i class="fa fa-cart-plus">Tambah</i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?= $judul; ?>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive col-md-12">
                    <table class="table table-bordered col-md-12">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart_table">
                            <?php $this->load->view('app/v_cart'); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5 offset-7">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                            <!-- <h1><b><span style="text-align:right;">Rp. </span><span style="text-align:center;" id="total1">0</span></b></h1> -->
                            <h1><b>Rp.<span id="grand_total2" style="font-size:30pt">0</span></b></h1>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Sub Total</label>
                        <div class="col-sm-8">
                            <input type="number" id="sub_total" value="" class="form-control" readonly>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Diskon</label>
                        <div class="col-sm-8">
                            <input type="number" id="discount" value="0" min="0" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Grand Total</label>
                        <div class="col-sm-8">
                            <input type="number" id="grand_total" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bayar</label>
                        <div class="col-sm-8">
                            <input type="number" id="cash" value="0" min="0" class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kembalian</label>
                        <div class="col-sm-8">
                            <input type="number" id="change" class="form-control" readonly>
                            <input type="hidden" id="note" rows="3" class="form-control"></input>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button id="proses_bayar" class="btn btn-flat active btn-flat btn-primary">
                    <i class="fa fa-paper-plane-o"></i>Proses
                </button>
                <button id="proses_cancel" class="btn btn-flat active  btn-flat btn-warning">
                    <i class="fa fa-paper-plane-o"></i>Cancel
                </button>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#customer").select2()
        allowClear: true
        $("#select-barang")
            .select2().on("change", function() {
                var optionSelected = $(this).children("option:selected");
                $("#id_barang").val(optionSelected.data("id"));
                $("#bcd").val(optionSelected.data("kode"));
                var barcode = $("#bcd").val();
                $("#nama").val(optionSelected.data("nama"));
                $("#harga").val(optionSelected.data("harga"));
                $("#stock").val(optionSelected.data("stock"));
                $("#kategori").val(optionSelected.data("kategori"));


                get_qty_keranjang2(barcode)

            });



        $(document).on('click', '#add_cart', function() {


            var id_barang = $('#id_barang').val()
            var bcd = $('#barcode').val();
            var harga = $('#harga').val()
            var qty = $('#qty').val()
            var stock = $('#stock').val()
            var cartqty = $("#qty_cart").val();
            var sisa = parseInt(stock) - parseInt(cartqty);

            if (id_barang == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Barang',
                    text: 'belum dipilih!',
                });
            } else if (stock < qty) {

                Swal.fire({
                    icon: 'error',
                    title: 'Jumlah Barang Melebihi Stock',
                    text: 'Sisa Stock ' + stock,
                });
            } else if (parseInt(stock) < qty || parseInt(stock) < (parseInt(cartqty) + parseInt(qty))) {

                Swal.fire({
                    icon: 'error',
                    title: 'Stok tidak cukup',
                    text: 'Sisa Stock ' + sisa,
                });
                $('#id_barang').focus()
                $('#qty').val(1)



            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('app/proses') ?>',
                    dataType: 'JSON',
                    data: {

                        'add_cart': true,
                        'id_barang': id_barang,
                        'harga': harga,
                        'qty': qty
                    },

                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_table').load('<?= site_url('app/cart_data') ?>', function() {
                                kalkulasi()
                            })
                            $('#id_barang').focus()
                            $('#bcd').val(0).change()
                            $('#qty').val(1)
                            $('#bcd').val()
                            $('#qty_cart').focus()

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Wadaoo...',
                                text: 'Gagal!',
                            });
                        }
                    }
                })
            }
        })

        // Function Validasi Cek Stock 
        function get_qty_keranjang(barcode, jml) {

            // Validasi berdasarkan barcode yang sama 

            $('#cart_table tr').each(function() {
                var qty_cart = $("#cart_table td.bb:contains('" + barcode + "')").parent().find('td').eq(4).html()
                if (qty_cart != null) {
                    $('#qty_cart').val(parseInt(qty_cart) + parseInt(jml))
                } else {
                    $('#qty_cart').val(0)
                }
            })
        }

        // Function Validasi Cek Stock 
        function get_qty_keranjang2(barcode) {
            // Validasi berdasarkan barcode yang sama 
            $('#cart_table tr').each(function() {
                var qty_cart = $("#cart_table td.bb:contains('" + barcode + "')").parent().find('td').eq(4).html()
                if (qty_cart != null) {
                    $('#qty_cart').val(parseInt(qty_cart))
                } else {
                    $('#qty_cart').val(0)
                }
            })
        }

        $(document).on('click', '#del_cart', function() {
            // if (confirm('apakah anda yakin ?')) {
            var id_cart = $(this).data('cartid')
            $.ajax({
                type: 'POST',
                url: '<?= site_url('app/cart_del') ?>',
                dataType: 'JSON',
                data: {
                    'id_cart': id_cart
                },
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('app/cart_data') ?>',
                            function() {
                                kalkulasi()
                            })

                        $('#barcode_barang').focus()
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Wadaoo...',
                            text: 'Gagal hapus!',
                        });

                    }
                }

            })
            // }

        })
        //kalkulasi
        function kalkulasi() {
            var subtotal = 0;
            $('#cart_table tr').each(function() {

                subtotal += parseInt($(this).find('#total').text())
            })
            isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

            var discount = $('#discount').val()

            var gran_total = subtotal - discount

            if (isNaN(gran_total)) {
                $('#grand_total').val(0)
                $('#grand_total2').text(0)

            } else {
                $('#grand_total').val(gran_total)
                $('#grand_total2').text(gran_total)
            }
            var cash = $('#cash').val()
            cash != 0 ? $('#change').val(cash - gran_total) : $('#change').val(0)

            if (discount == '') {
                $('#discount').val(0)
            }
        }
        $(document).on('keyup mouseup', '#discount, #cash', function() {
            kalkulasi()
        })

        $(document).ready(function() {
            kalkulasi()
        });


        $(document).on('click', '#proses_bayar', function() {
            var id_customer = $('#customer').val()
            var subtotal = $('#sub_total').val()
            var discount = $('#discount').val()
            var grandtotal = $('#grand_total').val()
            var cash = $('#cash').val()
            var change = $('#change').val()
            var note = $('#note').val()
            var date = $('#date').val()
            if (subtotal == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'barang',
                    text: 'belum dipilih!',
                });
                $('#barcode').focus()
            } else if (cash < 1) {
                Swal.fire({
                    icon: 'info',
                    title: 'Uang cash',
                    text: 'belum diinput!',
                });
                $('#cash').focus()

            } else {

                Swal.fire({
                    title: ' Apakah Anda Yakin ?',
                    text: "Proses Transaksi!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    timer: 5000,
                    confirmButtonText: 'Yes, Proses!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            // icon: 'sucess',
                            title: "Processing Data..",
                            text: "Data sedang berkelana",
                            text: '',
                            imageUrl: '<?= base_url() ?>' + "assets/gif/hm.gif",
                            timer: 3000,
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        $.ajax({
                            type: 'POST',
                            url: '<?= site_url('app/proses') ?>',
                            data: {
                                'proses_bayar': true,
                                'id_customer': id_customer,
                                'subtotal': subtotal,
                                'discount': discount,
                                'grandtotal': grandtotal,
                                'cash': cash,
                                'change': change,
                                'note': note,
                                'date': date
                            },
                            dataType: 'JSON',
                            success: function(result) {
                                if (result.success == true) {
                                    // window.location.replace("<?= site_url('transaksi'); ?>");
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Proses Berhasil',
                                        text: 'Berhasil!'
                                    });
                                    window.open('<?= site_url('app/cetak_nota/') ?>' + result.id_penjualan, '_blank')
                                } else {
                                    alert('gagal trans')
                                }
                                location.href = '<?= site_url('app') ?>'
                            }
                        })
                    }
                })

            }
        })

        $(document).on('click', '#proses_cancel', function() {
            Swal.fire({
                title: ' Apakah Anda Yakin ?',
                text: "Batal Transaksi!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                timer: 5000,
                confirmButtonText: 'Yes, Proses!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: "Processing Data..",
                        text: "Data sedang berkelana",
                        text: '',
                        imageUrl: '<?= base_url() ?>' + "assets/gif/hm.gif",
                        timer: 3000,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('app/cart_del') ?>',
                        data: {
                            'proses_cancel': true
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            if (result.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Membatalkan!',
                                });
                                $('#cart_table').load('<?= site_url('app/cart_data'); ?>', function() {
                                    hitung_edit_modal()
                                    location.href = '<?= site_url('app') ?>'
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Membatalkan!',
                                });
                            }
                        }
                    })
                    $('#discount').val(0)
                    $('#cash').val(0)
                    $('#customer').val(0).change()
                    $('#barcode').val('')
                    $('#barcode').focus()
                }
            })

        })
    });
</script>