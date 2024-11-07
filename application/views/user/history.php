<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Jenis Obat</th>
                        <th scope="col">Aturan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($history as $h) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $h['nama_obat']; ?></td>
                            <td><?= $h['jenis_obat']; ?></td>
                            <td><?= $h['aturan']; ?></td>
                            <td><?= $h['keterangan']; ?></td>
                            <td><?= $h['status']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->