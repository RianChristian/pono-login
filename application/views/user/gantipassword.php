<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('user/gantipassword'); ?>" method="post">
                <div class="form-group">
                    <strong><label for="password_saat_ini">Password Saat Ini</label></strong>
                    <input type="password" class="form-control" id="password_saat_ini" name="password_saat_ini" placeholder="Masukkan Password Saat ini...">
                    <?= form_error('password_saat_ini', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <strong><label for="password_baru1">Password Baru</label></strong>
                    <input type="password" class="form-control" id="password_baru1" name="password_baru1" placeholder="Masukkan Password Baru...">
                    <?= form_error('password_baru1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <strong><label for="password_baru2">Konfirmasi Password Baru</label></strong>
                    <input type="password" class="form-control" id="password_baru2" name="password_baru2" placeholder="Masukkan Konfirmasi Password Baru...">
                    <?= form_error('password_baru2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->