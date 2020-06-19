<h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                     kategori
                </h6>
            </div>
            <div class="card-body">
                <?php
				?>
                <form method="post" class="form" action="<?= base_url('kategori/proses') ?>">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <input type="text" value="<?= $row->nama ?>" class="form-control" id="nama" name="nama"
                            placeholder="Nama kategori" required>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger">Close</button>
                        <button type="submit" name="<?= $apa ?>" class="btn btn-success btn-flat">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>