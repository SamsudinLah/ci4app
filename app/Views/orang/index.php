<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <!-- judul halaman -->
            <h1 class="mt-2">Daftar Orang</h1>
            <form action="" method="post">
                <!-- pencarian -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan keyword pencarian" name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- tabel daftar komik -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($orang as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                            <td>
                                <!-- TOMBOL MODAL -->
                                <a class="btn btn-primary" id="tombolDetail" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="<?= $o['id']; ?>" data-nama="<?= $o['nama']; ?>" data-alamat="<?= $o['alamat']; ?>">
                                    Detail
                                </a>
                                <!-- TOMBOL MODAL EDIT -->
                                <a class="btn btn-warning" id="tombolEdit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $o['id']; ?>" data-nama="<?= $o['nama']; ?>" data-alamat="<?= $o['alamat']; ?>">
                                    Edit
                                </a>
                                <!-- MODAL DETAIL -->
                                <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Orang</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="form-group">
                                                        <label for="nama" class="col-form-label">Nama</label>
                                                        <input type="text" class="form-control" id="nama" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat" class="col-form-label">Alamat</label>
                                                        <input type="text" class="form-control" id="alamat" disabled>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL EDIT -->
                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Orang</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="form-group">
                                                        <label for="nama" class="col-form-label">Nama</label>
                                                        <input type="text" class="form-control" id="nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat" class="col-form-label">Alamat</label>
                                                        <input type="text" class="form-control" id="alamat">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Save</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(''); ?>