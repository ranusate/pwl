 <!-- Page Heading -->
 <?php $this->view('alert'); ?>

 <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <a href="<?= base_url() ?>supplier/tambah" class="btn btn-primary active">
             <i class="fas fa-plus"></i> Supplier
         </a> </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                 <thead>
                     <th>#</th>
                     <th>Nama</th>
                     <th>No Telphon</th>
                     <th>Alamat</th>
                     <th>Deskripsi</th>
                     <th>Action</th>
                     </tr>
                 </thead>
                 <tfoot>

                 </tfoot>
                 <tbody>

                     <?php $no = 1;
                        foreach ($suppliers as $user) { ?>
                         <tr>
                             <td style="width:5%;"> <?= $no++ ?></td>
                             <td class="username"><?= $user->nama ?></td>
                             <td class="name"><?= $user->no_tlpn ?></td>
                             <td><?= $user->alamat ?></td>
                             <td><?= $user->decripsi ?></td>
                             <td>
                                 <a href="<?= site_url("supplier/update/$user->id") ?>" class=" active btn btn-sm btn-warning">
                                     <i class="fas fa-edit"></i>
                                 </a>
                                 <a href="<?= site_url("supplier/delete/$user->id") ?>" class=" btn btn-sm btn-danger active tombol-hapus">
                                     <i class="fas fa-trash "></i>
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

 <script>
     const flashData = $('.flash-error').data('flashdata');
     const flashDat = $('.flash-data').data('flashdata');
     if (flashData) {
         Swal.fire({
             title: 'Data Supplier',
             text: '' + flashData,
             icon: 'error'
         });
     }
     if (flashDat) {
         Swal.fire({
             title: 'Data Supplier',
             text: '' + flashDat,
             icon: 'success'
         });
     }


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