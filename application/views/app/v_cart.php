<?php $no = 1;
foreach ($carts as $user) { ?>
	<tr align="center">
		<td><?= $no++ ?></td>
		<td class="bb"><?= $user->barcode ?></td>
		<td><?= $user->b_nama ?></td>
		<td><?= $user->c_harga ?></td>
		<td id="yu"> <?= $user->qty ?></td>
		<!-- <td><?= $user->discount_barang ?></td> -->
		<td id="total"><?=$user->total ?></td>
		<td>
			<button id="del_cart" data-cartid="<?= $user->id_cart ?>" class="btn btn-sm btn-danger">
				<i class="fa fa-trash" aria-hidden="true"></i>
			</button>
		</td>
	</tr>
<?php } ?>