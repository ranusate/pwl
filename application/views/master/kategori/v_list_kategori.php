 <!-- Page Heading -->

 <?php $this->view('alert'); ?>
 <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <a href="<?= base_url() ?>kategori/tambah" class=" active btn btn-primary">
             <i class="fas fa-plus"></i> kategori
         </a>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Nama</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tfoot>

                 </tfoot>
                 <tbody>

                     <?php $no = 1;
                        foreach ($kategoris as $user) { ?>
                         <tr>
                             <td style="width:5%;"><?= $no++ ?></td>
                             <td><?= $user->nama ?></td>
                             <td>
                                 <a href="<?= site_url("kategori/update/$user->id") ?>" class="btn btn-sm btn-warning">
                                     <i class="fas fa-edit"></i>
                                 </a>
                                 <a href="<?= site_url("kategori/delete/$user->id") ?>" class=" btn btn-sm btn-danger  tombol-hapus">
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
     const flashDatea = $('.flash-error').data('flashdata');
     if (flashData) {
         Swal.fire({
             title: 'Data Kategori',
             text: '' + flashData,
             icon: 'success'
         });
     }
     if (flashDatea) {
         Swal.fire({
             title: 'Data Kategori',
             text: '' + flashDatea,
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



 <!-- 
 <script>

     Swal.fire({
         title: 'Submit your Github username',
         input: 'text',
         inputAttributes: {
             autocapitalize: 'off'
         },
         showCancelButton: true,
         confirmButtonText: 'Look up',
         showLoaderOnConfirm: true,
         preConfirm: (login) => {

             return fetch(`//api.github.com/users/${login}`)
                 .then(response => {
                     
                     if (!response.ok) {
                         throw new Error(response.statusText)
                     }
                     return response.json()
                 })
                 .catch(error => {
                     Swal.showValidationMessage(
                         `Request failed: ${error}`
                     )
                 })
         },
         allowOutsideClick: () => !Swal.isLoading()

     }).then((result) => {
         if (result.value) {
             Swal.fire({
                 title: `${result.value.login}'s avatar`,
                 imageUrl: result.value.avatar_url
             })
         }
     })
 </script> -->