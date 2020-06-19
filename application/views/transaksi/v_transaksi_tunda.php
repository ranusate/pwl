 <!-- Page Heading -->
 <?php $this->view('alert'); ?>
 <h1 class="h3 mb-2 text-gray-800"><?= $judul ?></h1>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <a href="<?= base_url() ?>app" class="btn btn-primary">
             <i class="fas fa-plus"></i>Transaksi
         </a>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>No transaksi</th>
                         <!-- <th>User</th> -->
                         <th>Tanggal Transaksi</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tfoot>

                 </tfoot>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($trs as $user) {
                        ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $user->no_tunda ?></td>
                             <!-- <td><?= $user->id_user ?></td> -->
                             <td><?= $user->tgl_transaksi ?></td>
                             <td>
                                 <button href="" id="btn-trans-tunda" data-tunda="<?= $user->id_trans_tunda ?>" class=" active btn btn-sm btn-warning">
                                     Proses
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
 <script>
     $(document).on('click', '#btn-trans-tunda', function() {
         var id_transaksi_tunda = $(this).data('tunda');
         $.ajax({
             type: "POST",
             url: "<?php echo base_url('app/prosesTunda') ?>",

             dataType: "JSON",
             data: {
                 id_trans_tunda: id_transaksi_tunda
             },
             cache: false,
             success: function(result) {
                 if (result.success == true) {
                     window.location.replace("<?= site_url('app'); ?>");
                     $('#cart_table').load('<?= site_url('app/cart_data') ?>', function() {
                         kalkulasi()
                     })
                     $('#id_barang').val('')
                     $('#barcode').val('')
                     $('#qty').val(1)
                     $('#barcode').focus()
                 } else {
                     Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'Gagal!',
                     });
                 }
             }
         });
     });
 </script>