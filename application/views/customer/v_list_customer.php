 <!-- Page Heading -->
 <?php $this->view('alert'); ?>
 <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <a href="<?= base_url() ?>customer/tambah" class=" active btn btn-primary">
             <i class="fas fa-user-plus"></i>Customer
         </a>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Nama</th>
                         <th>Jenis Kelamin</th>
                         <th>No Telphon</th>
                         <th>Alamat</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tfoot>

                 </tfoot>
                 <tbody>

                     <?php $no = 1;
                        foreach ($customers as $user) { ?>
                         <tr>
                             <td style="width:5%;"><?= $no++ ?></td>
                             <td><?= $user->nama ?></td>
                             <td><?= getJenisKelaminLengkap($user->jk) ?></td>
                             <td><?= $user->no_tlpn ?></td>
                             <td><?= $user->alamat ?></td>
                             <td>
                                 <a href="<?= site_url("customer/update/$user->id") ?>" class=" active btn btn-sm btn-warning">
                                     <i class="fas fa-edit"></i>
                                 </a>

                                 <a href="<?= site_url("customer/delete/$user->id") ?>" class=" active btn btn-sm btn-danger  tombol-hapus">
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
     const flashData = $('.flash-data').data('flashdata');
     const flashDatai = $('.flash-error').data('flashdata');
     if (flashData) {
         Swal.fire({
             title: 'Data Customer',
             text: '' + flashData,
             icon: 'success'
         });
     }
     if (flashDatai) {
         Swal.fire({
             title: 'Data Customer',
             text: '' + flashDatai,
             icon: 'error'
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