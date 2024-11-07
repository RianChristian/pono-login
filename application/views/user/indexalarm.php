<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <center>
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    </center>

    <center>
        <section class="container">
            <div class="time-display">
                <img class="timer" src="<?= base_url('assets/img/profile/'); ?>alarm.jpg">
                <div id="clock"></div>
            </div>
            <br>
            <h5>Atur Jam Minum Obat Anda!</h5><label><br>

                <!-- Atur Pengingat -->
                <?= form_error('history', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                <?= $this->session->flashdata('message'); ?>

                <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#pengingatModalBaru">Atur Pengingat</a>

                <!-- Modal -->
                <div class="modal fade" id="pengingatModalBaru" tabindex="-1" role="dialog" aria-labelledby="pengingatModalBaruLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pengingatModalBaruLabel">Tambah Pengingat Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('user/indexalarm'); ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Masukkan Nama Obat">
                                        <?= form_error('nama_obat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="jenis_obat" name="jenis_obat" placeholder="Masukkan Jenis Obat">
                                        <?= form_error('jenis_obat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="aturan" name="aturan" placeholder="Masukkan Aturan">
                                        <?= form_error('aturan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan"></textarea>
                                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="status" name="status" checked>
                                            <label class="form-check-label" for="status">
                                                Aktif?
                                            </label>
                                        </div>
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

                <!-- end of atur pengingat -->

                <form class="setAlarm">
                    <label class="alarm-heading">

                        <div class="set-alarm-field btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="number" name="a_hour" id="a_hour" placeholder="Jm" max="23" min="00">
                            </label>
                            <label class="btn btn-secondary">
                                <input type="number" name="a_min" id="a_min" placeholder="Mnt" max="59" min="00">
                            </label>
                            <label class="btn btn-secondary">
                                <input type="number" name="a_sec" id="a_sec" placeholder="Dtk" max="59" min="00">
                            </label>
                        </div>
                        <br>
                        <br>
                        <div class="controls">
                            <button type="submit" name="Submit" class="set-alarm btn btn-primary">Atur Alarm</button>
                            <button type="reset" onclick="clearAlarm()" class="clear-alarm btn btn-primary">Hentikan Alarm</button>
                        </div>
                </form>
        </section>
    </center>
    <hr style="margin-top: 20px">

    <center>
        <section>
            <br>
            <div>
                <h4 class="alarm-heading" style="margin-top: -20px;">Alarm yang Akan Datang!</h4>
                <br><br>
            </div>
            <div id="myList">
            </div>
        </section>
    </center>
    <hr>
    <hr>
    <br>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->