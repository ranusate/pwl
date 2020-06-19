<?php $this->view('alert'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">

                    <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
                </h6>
            </div>
            <div class="card-body">
                <?php
                ?>
                <?php echo form_open_multipart('barang/proses') ?>
                <div class="form-group">
                    <label for=""> Barcode</label>
                    <input type="hidden" name="id_barang" value="<?= $row->id_barang ?>">
                    <input type="text" value="<?= $row->barcode ?>" class="form-control textbox" id="barcode" name="barcode" required>
                    <i class="form-control-feedback"></i>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" value="<?= $row->nama ?>" class="form-control textbox" id="nama_barang" name="nama_barang" required>
                    <i class="form-control-feedback"></i>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for=""> Harga Barang</label>
                    <input type="number" value="<?= $row->harga ?>" class="form-control textbox" id="harga_barang" name="harga_barang" required>
                    <i class="form-control-feedback"></i>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Kategori Barang</label>
                    <select class="form-control" id="select-kategori" name="kategori_id" required value="">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <?php
                        foreach ($kategoris as $data) { ?>
                            <option value="<?= $data->id ?>" <?= $data->id == $row->id_kategori ? "selected" : '' ?>>
                                <?= $data->nama; ?></option>
                        <?php
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""> Gambar Barang</label>
                    <?php if ($apa == 'Update') {
                        if ($row->image != null) { ?>
                            <div style="margin-bottom:5px">
                                <img src="<?= base_url('assets/img/') . $row->image ?>" style="width:20%" alt="" />
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="card-footer">
                    <!-- <button id="btn-reset" type="reset" class="btn btn-info"></i>Reset</button> -->
                    <a href="<?= site_url(array("barang")) ?>" class="btn btn-danger btn-xs">
                        Cancel
                    </a>
                    <button type="submit" name="<?= $apa ?>" class="btn btn-success btn-flat">Tambah</button>
                </div>
                <?= form_close() ?>



            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#select-kategori").select2()
    });

    const flashData = $('.flash-error').data('flashdata');
    if (flashData) {
        Swal.fire({
            title: 'Barcode',
            text: '' + flashData,
            icon: 'error'
        });
    }
</script>



<script type="text/javascript">
    $(document).ready(function() {
        //semua element dengan class text-danger akan di sembunyikan saat load
        $('.text-danger').hide();
        //untuk mengecek bahwa semua textbox tidak boleh kosong
        $('input').each(function() {
            $(this).blur(function() { //blur function itu dijalankan saat element kehilangan fokus
                if (!$(this).val()) { //this mengacu pada text box yang sedang fokus
                    return get_error_text(this); //function get_error_text ada di bawah
                } else {
                    $(this).removeClass('no-valid');
                    $(this).parent().find('.text-danger').hide(); //cari element dengan class has-danger dari element induk text yang sedang focus
                    $(this).closest('div').removeClass('has-danger');
                    $(this).closest('div').addClass('has-success');
                    $(this).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-danger-sign');
                    $(this).parent().find('.form-control-feedback').addClass('glyphicon glyphicon-ok');
                }
            });
        });
        //mengecek textbox Nama Valid Atau Tidak
        $('#nama_barang').blur(function() {
            var nama = $(this).val();
            var len = nama.length;
            if (len > 0) { //jika ada isinya
                if (!valid_nama(nama)) { //jika nama tidak valid
                    $(this).parent().find('.text-danger').text("");
                    $(this).parent().find('.text-danger').text("Nama Tidak Valid");
                    return apply_feedback_error(this);
                } else {
                    if (len > 30) { //jika karakter >30
                        $(this).parent().find('.text-danger').text("");
                        $(this).parent().find('.text-danger').text("Maximal Karakter 30");
                        return apply_feedback_error(this);
                    }
                }
            }
        });
        //mengecek textbox Nama Valid Atau Tidak
        $('#alamat').blur(function() {
            var nama = $(this).val();
            var len = nama.length;
            if (len > 0) { //jika ada isinya
                if (!valid_alamat(nama)) { //jika nama tidak valid
                    $(this).parent().find('.text-danger').text("");
                    $(this).parent().find('.text-danger').text("alamat Tidak Valid");
                    return apply_feedback_error(this);
                } else {
                    if (len > 30) { //jika karakter >30
                        $(this).parent().find('.text-danger').text("");
                        $(this).parent().find('.text-danger').text("Maximal Karakter 30");
                        return apply_feedback_error(this);
                    }
                }
            }
        });
       //mengecek nomer hp
        $('#harga_barang').blur(function() {
            var hp = $(this).val();
            var len = hp.length;
            if (len > 0 && len <= 10) {
                $(this).parent().find('.text-danger').text("");
                $(this).parent().find('.text-danger').text("Nomer HP terlalu pendek");
                return apply_feedback_error(this);
            } else {
                if (!valid_hp(hp)) {
                    $(this).parent().find('.text-danger').text("");
                    $(this).parent().find('.text-danger').text("Format TIdak Valid");
                    return apply_feedback_error(this);
                } else {
                    if (len > 13) {
                        $(this).parent().find('.text-danger').text("");
                        $(this).parent().find('.text-danger').text("Nomer HP terlalu Panjang");
                        return apply_feedback_error(this);
                    }
                }
            }
        });

    });

    //fungsi cek nama
    function valid_nama(nama) {
        var pola = new RegExp(/^[a-z A-Z]+$/);
        return pola.test(nama);
    }

    function alamat(nama) {
        var pola = new RegExp(/^[a-z A-Z]+$/);
        return pola.test(nama);
    }

    function deskripsi(nama) {
        var pola = new RegExp(/^[a-z A-Z]+$/);
        return pola.test(nama);
    }
   
    //menerapkan gaya validasi form bootstrap saat terjadi eror
    function apply_feedback_error(textbox) {
        $(textbox).addClass('no-valid'); //menambah class no valid
        $(textbox).parent().find('.text-danger').show();
        $(textbox).closest('div').removeClass('has-success');
        $(textbox).closest('div').addClass('has-danger');
        $(textbox).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-ok');
        $(textbox).parent().find('.form-control-feedback').addClass('glyphicon glyphicon-danger-sign');
    }

    //untuk mendapat eror teks saat textbox kosong, digunakan saat submit form dan blur fungsi
    function get_error_text(textbox) {
        $(textbox).parent().find('.text-danger').text("");
        $(textbox).parent().find('.text-danger').text("Text Box Ini Tidak Boleh Kosong");
        return apply_feedback_error(textbox);
    }
</script>