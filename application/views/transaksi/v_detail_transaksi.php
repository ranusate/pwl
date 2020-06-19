 <!-- Page Heading -->
 <?php $this->view('alert'); ?>
 <h1 class="h3 mb-2 text-gray-800">Detail Transaksi</h1>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <!-- <a href="#" target="_blank" class="btn btn-primary btn-lg active" role="button" aria-pressed="true"> <i class="fas fa-print"></i> Print</a> -->
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Barang</th>
                         <th>Harga</th>
                         <th>Qty</th>
                         <th>Discount</th>
                         <th>Total</th>
                     </tr>
                 </thead>
                 <tfoot>
                 </tfoot>
                 <tbody>
                     <?php
                        $total = 0;
                        $no = 1;
                        foreach ($detail as $user) {
                            $totalharga = (int) $user->total;
                            $total += $totalharga;
                        ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $user->nama_barang ?></td>
                             <td><?= format_rupiah($user->harga) ?></td>
                             <td><?= $user->qty ?></td>
                             <td><?= format_rupiah($user->discount_barang) ?></td>
                             <td><?= format_rupiah($user->total) ?></td>
                         </tr>
                     <?php
                        } ?>
                     <tr>
                         <td colspan="5">Total Semua</td>
                         <td><?= format_rupiah($total) ?></td>
                     </tr>
                 </tbody>
             </table>
             <!-- <div class="card-footer">
                 <a href="<?= site_url('transaksi/detail_print/') . $user->id_penjualan ?>" target="_blank" class="btn btn-info active" role="button" aria-pressed="true"> <i class="fas fa-print"></i>Print</a>
                 <a href="<?= site_url('app/cetak_nota/') . $user->id_penjualan ?>" target="_blank" class="btn btn-primary active" role="button" aria-pressed="true"> <i class="fas fa-print"></i> Struk</a>
             </div> -->
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