<h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Supplier
                </h6>
            </div>
            <div class="card-body">
                <?php
                ?>
                <form method="post" role="form" class="form" id="form-supplier" action="<?= base_url('supplier/proses_tambah') ?>">
                    <div class="form-group form-group-lg has-feedback">
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <input type="text" value="<?= $row->nama ?>" class="form-control textbox" id="sup_nam" name="sup_nam" placeholder="Nama Supplier" required>
                        <i class="form-control-feedback"></i>
                        <span class="text-danger"></span>

                    </div>

                    <div class="form-group form-group-lg has-feedback">
                        <input type="number" name="no" value="<?= $row->no_tlpn ?>" class="form-control textbox" id="no_tlpn" placeholder="No Telphon" required>
                        <i class="form-control-feedback"></i>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group form-group-lg has-feedback">
                        <input type="text" value="<?= $row->alamat ?>" placeholder="Alamat" name="alamat" class="form-control textbox">
                        </input>
                        <i class="form-control-feedback"></i>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group form-group-lg has-feedback">
                        <input type="text" value="<?= $row->decripsi ?>" class="form-control textbox" name="decripsi" placeholder="Deskripsi" required></input>
                        <i class="form-control-feedback"></i>
                        <span class="text-danger"></span>
                    </div>
                    <div class="card-footer ">
                        <a href="<?= site_url(array("supplier")) ?>" class="btn btn-danger btn-xs">
                            Cancel
                        </a>
                        <button type="submit" id="btn-simpan" name="<?= $apa ?>" class="btn btn-success btn-flat">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    $(function() {
        $("#form-supplier").validate({
            rules: {
                sup_nam: {
                    required: true
                },
                no: {
                    required: true,
                    digits: true,
                    minlength: 10,
                },
                alamat: {
                    required: true
                },
                decripsi: {
                    required: true
                }
            },
            messages: {
                sup_nam: {
                    required: "Nama Supplier Wajib",
                },
                no: {
                    required: "Anda belum masukkan no telpon supplier",
                    minlength: "Nomer yang anda masukkan kurang",
                    digits: "Nomer Berupa Angka !"
                },
                alamat: {
                    required: "Anda belum memasukkan alamat"
                },
                decripsi: {
                    required: "Deskripsi Wajib Diisi"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('has-danger');
                element.closest('.form-control-feedback').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script> -->

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
        $('#sup_nam').blur(function() {
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
        $('#decripsi').blur(function() {
            var nama = $(this).val();
            var len = nama.length;
            if (len > 0) { //jika ada isinya
                if (!deskripsi(nama)) { //jika nama tidak valid
                    $(this).parent().find('.text-danger').text("");
                    $(this).parent().find('.text-danger').text("Deskripsi Tidak Valid");
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
        // //Mengecek textbox tanggal lahir
        // $('#tgl_lahir').blur(function() {
        //     var tgl = $(this).val();
        //     var len = tgl.length;
        //     if (len > 0) {
        //         if (!valid_tanggal(tgl)) {
        //             $(this).parent().find('.text-danger').text("");
        //             $(this).parent().find('.text-danger').text("Format Tanggal yang diperbolehkan mm-dd-yyy, mm/dd/yyyy atau dd/mm/yyyy, dd-mm-yyyy");
        //             return apply_feedback_error(this);
        //         }
        //     }
        // });
        // //mengecek text box email
        // $('#email').blur(function() {
        //     var email = $(this).val();
        //     var len = email.length;
        //     if (len > 0) {
        //         if (!valid_email(email)) {
        //             $(this).parent().find('.text-danger').text("");
        //             $(this).parent().find('.text-danger').text("E-mail Tidak Valid (ex: aaaa@yahoo.co.id)");
        //             return apply_feedback_error(this);
        //         } else {
        //             if (len > 30) {
        //                 $(this).parent().find('.text-danger').text("");
        //                 $(this).parent().find('.text-danger').text("Maximal Karakter 30");
        //                 return apply_feedback_error(this);
        //             } else {
        //                 var valid = false;
        //                 $.ajax({
        //                     url: "checkemail.php",
        //                     type: "POST",
        //                     data: "email=" + email,
        //                     dataType: "text",
        //                     success: function(data) {
        //                         if (data == 0) { //pada file check email.php, apabila email sudah ada di database makan akan mengembalikan nilai 0
        //                             $('#email').parent().find('.text-danger').text("");
        //                             $('#email').parent().find('.text-danger').text("email sudah ada");
        //                             return apply_feedback_error('#email');
        //                         }
        //                     }
        //                 });
        //             }
        //         }
        //     }
        // });
        //mengecek password
        // $('#password').blur(function() {
        //     var password = $(this).val();
        //     var len = password.length;
        //     if (len > 0 && len < 8) {
        //         $(this).parent().find('.text-danger').text("");
        //         $(this).parent().find('.text-danger').text("password minimal 8 karakter");
        //         return apply_feedback_error(this);
        //     } else {
        //         if (len > 35) {
        //             $(this).parent().find('.text-danger').text("");
        //             $(this).parent().find('.text-danger').text("password maximal 35 karakter");
        //             return apply_feedback_error(this);
        //         }
        //     }
        // });
        // //mengecek konfirmasi password
        // $('#conf_password').blur(function() {
        //     var pass = $("#password").val();
        //     var conf = $(this).val();
        //     var len = conf.length;
        //     if (len > 0 && pass !== conf) {
        //         $(this).parent().find('.text-danger').text("");
        //         $(this).parent().find('.text-danger').text("Konfirmasi Password tidak sama dengan password");
        //         return apply_feedback_error(this);
        //     }
        // });

        //mengecek nomer hp
        $('#no_tlpn').blur(function() {
            var hp = $(this).val();
            var len = hp.length;
            if (len > 0 && len <= 10) {
                $(this).parent().find('.text-danger').text("");
                $(this).parent().find('.text-danger').text("Nomer HP terlalu pendek");
                return apply_feedback_error(this);
            } else {
                if (!valid_hp(hp)) {
                    $(this).parent().find('.text-danger').text("");
                    $(this).parent().find('.text-danger').text("Format nomer hp tidak sah.(ex: +6285736262623)");
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

        //submit form validasi
        // $('#btn-simpan').submit(function(e) {
        //     e.preventDefault();
        //     var valid = true;
        //     $(this).find('.textbox').each(function() {
        //         if (!$(this).val()) {
        //             get_error_text(this);
        //             valid = false;
        //             $('html,body').animate({
        //                 scrollTop: 0
        //             }, "slow");
        //         }
        //         if ($(this).hasClass('no-valid')) {
        //             valid = false;
        //             $('html,body').animate({
        //                 scrollTop: 0
        //             }, "slow");
        //         }
        //     });
        //     if (valid) {
        //         swal({
        //             title: "Konfirmasi Simpan Data",
        //             text: "Data Akan di Simpan Ke Database",
        //             type: "info",
        //             showCancelButton: true,
        //             confirmButtonColor: "#1da1f2",
        //             confirmButtonText: "Yakin, dong!",
        //             closeOnConfirm: false,
        //             showLoaderOnConfirm: true,
        //         }, function() { //apabila sweet alert d confirm maka akan mengirim data ke simpan.php melalui proses ajax
        //             $.ajax({
        //                 url: "simpan.php",
        //                 type: "POST",
        //                 data: $('#form-supplier').serialize(), //serialize() untuk mengambil semua data di dalam form
        //                 dataType: "html",
        //                 success: function() {
        //                     setTimeout(function() {
        //                         swal({
        //                             title: "Data Berhasil Disimpan",
        //                             text: "Terimakasih",
        //                             type: "success"
        //                         }, function() {
        //                             window.location = "tampil.php";
        //                         });
        //                     }, 2000);
        //                 },
        //                 error: function(xhr, ajaxOptions, thrownError) {
        //                     setTimeout(function() {
        //                         swal("Error", "Tolong Cek Koneksi Lalu Ulangi", "error");
        //                     }, 2000);
        //                 }
        //             });
        //         });
        //     }
        // });
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
    // //fungsi cek tanggal lahir
    // function valid_tanggal(tanggal) {
    //     var pola = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
    //     return pola.test(tanggal);
    // }
    // //fungsi cek email
    // function valid_email(email) {
    //     var pola = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);
    //     return pola.test(email);
    // }
    //fungsi cek phone 
    function valid_hp(hp) {
        var pola = new RegExp(/^[0-9-+]+$/);
        return pola.test(hp);
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