<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= form_error('kritiksaran', '<div class="alert 
            alert-danger" role="alert">', '</div>'); ?>

    <?= $this->session->flashdata('message'); ?>

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#kritikModalBaru">Klik Dan Masukkan Kritik/Saran</a>


    <!-- Modal -->
    <div class="modal fade" id="kritikModalBaru" tabindex="-1" role="dialog" aria-labelledby="kritikModalBaruLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kritikModalBaruLabel">Buat Kritik/Saran Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/kritiksaran'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" aria-label="With textarea" placeholder="Masukkan Kritik & Saran disini.." id="kritiksaran" name="kritiksaran"></textarea>
                            <?= form_error('kritiksaran', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->