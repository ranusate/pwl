 <!-- Page Heading -->
 <?php $this->view('alert'); ?>

 <h1 class="h3 mb-2 text-gray-800"> <?= $judul; ?></h1>
 <!-- <h1 class="h3 mb-2 text-gray-800">Data stock in</h1> -->

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <a href="<?= base_url() ?>stock/in/add" class="btn btn-primary">
             <i class="fas fa-plus"></i> Stock in
         </a>
         <a href="<?= base_url() ?>stock/out/add" class="btn btn-success">
             <i class="fas fa-plus"></i> Stock out
         </a>
         <a href="<?= base_url() ?>barang" class="btn btn-info">
            <i class="fas"></i> Barang
         </a>

     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Barcode</th>
                         <th>Nama Barang</th>
                         <th>Jumlah Barang</th>
                         <th>Date</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tfoot>

                 </tfoot>
                 <tbody>
                     <?php $no = 1;
                        foreach ($stocks as $user) { ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $user->barcode ?></td>
                             <td><?= $user->namabrg ?></td>
                             <td><?= $user->qty ?></td>
                             <td><?= $user->date ?></td>

                             <td>
                                 <a href="<?= site_url("stock/in/delete/$user->stock_id/$user->id_barang") ?>" class=" btn btn-sm btn-danger active tombol-hapus">
                                     <i class="fas fa-trash "></i>
                                 </a>

                                 <!-- <a href="<?= site_url("stock/in/delete/$user->stock_id/$user->id_barang") ?>"
                                 onclick="return confirm('Anda yakin menghapus data ?')" class="btn btn-sm btn-danger">
                                 <i class="fas fa-trash"></i>
                             </a> -->
                                 <a class="btn btn-sm  btn-warning active" id="detail-barang" data-toggle="modal" data-target="#modal-detail" data-id="<?= $user->id_barang ?>" data-barcode="<?= $user->barcode ?>" data-nama="<?= $user->namabrg ?>" data-supplier="<?= $user->supplier ?>" data-qty="<?= $user->qty ?>" data-detail="<?= $user->detail ?>" data-date="<?= $user->date ?>">
                                     <i class="fa fa-eye" aria-hidden="true"></i>
                                 </a>
                             </td>
                         </tr>
                     <?php
                        } ?>
                 </tbody>
             </table>


         </div>
     </div>
 </div>
 <!-- Modal -->
 <div class="modal fade " id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title font-weight-bold text-primary text-center" id="tambahUserTitle">
                     </i> Detail stock in
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body table-responsive">
                 <table class="table table-bordered no-margin">
                     <tbody>
                         <tr>
                             <th>Barcode</th>
                             <td><span id="barcode"></span></td>
                         </tr>
                         <tr>
                             <th>Nama Barang</th>
                             <td><span id="nama"></span></td>
                         </tr>
                         <tr>
                             <th>Detail</th>
                             <td><span id="detail"></span></td>
                         </tr>
                         <tr>
                             <th>Supplier</th>
                             <td><span id="supplier"></span></td>
                         </tr>
                         <tr>
                             <th>Jumlah</th>
                             <td><span id="qty"></span></td>
                         </tr>
                         <tr>
                             <th>Date</th>
                             <td><span id="date"></span></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>


 <!-- modal hapus -->

 <div class="modal fade" id="modaldel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title font-weight-bold text-primary text-center" id="exampleModalLabel">Hapus Data
                     Stok In
                 </h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <h5 class="modal-title">
                     yakin hapus data ini?
                 </h5>
             </div>

             <div class="modal-footer">
                 <form id="formdel" action="" method="POST">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <button class="btn btn-danger" type="submit" id="linkHapus" href="">Delete</button>
                 </form>
             </div>

         </div>
     </div>
 </div>

 <script>
     const flashData = $('.flash-data').data('flashdata');
     if (flashData) {
         Swal.fire({
             title: 'Data Stock In',
             text: '' + flashData,
             icon: 'success'
         });
     }
 </script>



 <script>
     const flashData = $('.flash-error').data('flashdata');
     if (flashData) {
         Swal.fire({
             title: 'Data Stock In',
             text: '' + flashData,
             icon: 'error'
         });
     }
 </script>

 <script>
     //swall barang hapus
     $('.tombol-hapus').on('click', function(e) {
         e.preventDefault();
         const href = $(this).attr('href')
         Swal.fire({
             title: 'Anda yakin?',
             text: "Hapus data!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya'
         }).then((result) => {
             if (result.value) {
                 document.location.href = href;
             }
         });
     });
 </script>
 <script>
     $(document).ready(function() {
         $(document).on('click', '#detail-barang', function() {
             // var id_barang = $(this).data('id');
             var barcode = $(this).data('barcode');
             var nama = $(this).data('nama');
             var detail = $(this).data('detail');
             var supplier = $(this).data('supplier');
             var qty = $(this).data('qty');
             var date = $(this).data('date');
             // $('#id_barang').val(id_barang);
             $('#barcode').text(barcode);
             $('#nama').text(nama);
             $('#detail').text(detail);
             $('#supplier').text(supplier);
             $('#qty').text(qty);
             $('#date').text(date);
         });
     });
 </script>