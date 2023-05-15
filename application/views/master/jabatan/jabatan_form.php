<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jabatan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="bold"><?= $button ?> Data Jabatan</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= $action; ?>" method="post">
                                <div class="form-group">
                                    <label for="varchar">Nama Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" placeholder="Masukan Jabatan..." id="jabatan" value="<?= $jabatan; ?>" />
                                    <?= form_error('jabatan') ?>
                                </div>

                                <input type="hidden" name="id_jab" value="<?= $id_jab; ?>" />
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-<?= $button == "Tambah" ? "plus" : "pencil-alt" ?>">
                                        </i> <?= $button ?>
                                    </button>
                                    <a href="<?= site_url('master/Jabatan') ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>