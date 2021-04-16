<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- tombol tambah -->
            <a href="/komik/create" class="btn btn-primary mt-3">Tambah Data Komik</a>
            <!-- judul halaman -->
            <h1 class="mt-2">Daftar Komik</h1>
            <!-- alert session -->
            <?php if (session()->getFlashdata('addsuccess')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('addsuccess'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('removed')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('removed'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('updated')) : ?>
                <div class="alert alert-warning" role="alert">
                    <?= session()->getFlashdata('updated'); ?>
                </div>
            <?php endif; ?>
            <!-- tabel daftar komik -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($komik as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $k['judul']; ?></td>
                            <td>
                                <a href="/komik/<?= $k['slug']; ?>" class=" btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(''); ?>