<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pegawai</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="bold"><?= $button ?> Data Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= $action; ?>" method="post">
                                <div class="form-group">
                                    <label for="varchar">Nama Pegawai</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan Pegawai..." id="nama" value="<?= $nama; ?>" />
                                    <?= form_error('nama') ?>
                                </div>

                                <?php if ($button === "Edit") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Jabatan</label>
                                        <select class="form-control" name="jab_id" id="jab_id">
                                            <option value="0">Pilih Jabatan</option>
                                            <option value="1" <?= $jab_id == 1 ? "selected" : "" ?>>Manager</option>
                                            <option value="2" <?= $jab_id == 2 ? "selected" : "" ?>>Office Boy</option>
                                            <option value="3" <?= $jab_id == 3 ? "selected" : "" ?>>Web Developer</option>
                                        </select>
                                        <?php if ($jab_id == "0") : ?>
                                            <?= form_error('jab_id') ?>
                                        <?php endif; ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label for="varchar">Jabatan</label>
                                        <select class="form-control" name="jab_id" id="jab_id">
                                            <option value="0">Pilih Jabatan</option>
                                            <option value="1">Manager</option>
                                            <option value="2">Office Boy</option>
                                            <option value="3">Web Developer</option>
                                        </select>
                                        <?php if ($jab_id == 0) : ?>
                                            <?= form_error('jab_id') ?>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="varchar">Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Masukan Alamat..." id="alamat"><?= $alamat; ?></textarea>
                                    <?= form_error('alamat') ?>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Gaji</label>
                                    <input type="number" class="form-control" name="gaji" placeholder="Masukan gaji..." id="gaji" value="<?= $gaji; ?>" />
                                    <?= form_error('gaji') ?>
                                </div>

                                <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>" />
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-<?= $button == "Tambah" ? "plus" : "pencil-alt" ?>">
                                        </i> <?= $button ?>
                                    </button>
                                    <a href="<?= site_url('master/Pegawai') ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>