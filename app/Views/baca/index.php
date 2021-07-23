<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-auto me-auto">
                <!-- judul halaman -->
                <h1 class="mt-2">Daftar Baca</h1>
            </div>
            <!-- tombol tambah -->
            <!-- <div class="col-md-auto ms-md-auto"><a href="/baca/create" class="btn btn-primary mt-3">Tambah Data Komik</a></div> -->
        </div>
        <div class="col">
            <!-- tombol tambah -->
            <!-- <a href="/komik/create" class="btn btn-primary mt-3">Tambah Data Komik</a> -->
            <!-- judul halaman -->
            <!-- <h1 class="mt-2">Daftar Komik</h1> -->
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
                        <th scope="col">No</th>
                        <th scope="col">Nama Orang</th>
                        <th scope="col">Nomor Baca</th>
                        <th scope="col">Tanggal Baca</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($baca as $b) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $b['nama']; ?></td>
                            <td><?= $b['nmr_baca']; ?></td>
                            <td><?= $b['tgl_baca']; ?></td>
                            <td><?= $b['tgl_selesai']; ?></td>
                            <td>
                                <button type="button" class="btn-zoomed" data-bs-toggle="modal" data-bs-target="#detail">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(''); ?>