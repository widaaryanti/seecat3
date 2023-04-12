<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title;?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><?= $title;?></div>
            </div>
        </div>
        <?= $this->session->flashdata('pesan'); ?>
        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Tambah <?= $title;?></h4>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="author" value="<?= $session["id"];?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control"
                                        value="<?= set_value("judul");?>">
                                    <?= form_error("judul", '<small class="text-danger">', '</small>');?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                        value="<?= set_value("tanggal");?>">
                                    <?= form_error("tanggal", '<small class="text-danger">', '</small>');?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="artikel" class="form-label">Artikel</label>
                                    <textarea name="artikel" id="artikel"
                                        class="summernote"><?= set_value("artikel");?></textarea>
                                    <?= form_error("artikel", '<small class="text-danger">', '</small>');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>