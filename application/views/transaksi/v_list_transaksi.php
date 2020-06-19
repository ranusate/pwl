 <!-- Page Heading -->
 <?php $this->view('alert'); ?>
 <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <a href="<?= base_url() ?>app" class="btn btn-primary">
             <i class="fas fa-plus"></i>Transaksi
         </a>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>No transaksi</th>
                         <th>Customer</th>
                         <th>Subtotal</th>
                         <th>Discount</th>
                         <th>Total</th>
                         <th>Bayar</th>
                         <th>Kembalian</th>
                         <!-- <th>Note</th> -->
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
                             <td><?= $user->invoice ?></td>
                             <td><?= $user->id == null ? "Umum"  :$user->cusnama?></td>
                             <td><?= format_rupiah($user->total_harga) ?></td>
                             <td><?= format_rupiah($user->discount) ?></td>
                             <td><?= format_rupiah($user->final_harga) ?></td>
                             <td><?= format_rupiah($user->cash) ?></td>
                             <td><?= format_rupiah($user->remaining) ?></td>
                             <!-- <td><?= $user->note ?></td> -->
                             <td>
                                 <a href="<?= site_url('app/cetak_nota/') . $user->p_id ?>" target="_blank"  class="btn btn-sm btn-outline-primary" role="button" aria-pressed="true">Print</a>
                                 </a>
                                 <a href="<?= base_url('transaksi/detail/') . $user->p_id ?>"  class="btn btn-sm btn-outline-warning">
                                     Detail
                                 </a>


                             </td>
                         </tr>
                     <?php
                        } ?>
                 </tbody>
             </table>
         </div>
     </div>


     