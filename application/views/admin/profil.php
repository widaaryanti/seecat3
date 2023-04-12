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
            <div class="row">
                <div class="col-lg-4 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data <?= $title;?></h4>
                        </div>
                        <div class="card-body">
                            <img alt="image" src="<?= base_url(); ?>assets/image/user/<?= $session["foto"];?>"
                                class="rounded-3 mb-3" width="150px" />
                            <h5><?= $session["nama"];?></h5>
                            <div><?= $session["username"];?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit <?= $title;?></h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url("admin/profil/edit");?>"
                                enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $session["id"];?>">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?= $session["nama"];?>">
                                    <?= form_error("nama", '<small class="text-danger">', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username1" class="form-control"
                                        value="<?= $session["username"];?>" readonly>
                                    <?= form_error("username", '<small class="text-danger">', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" name="password" id="password" class="form-control"
                                        placeholder="Isi Jika Ingin Ganti Password">
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>