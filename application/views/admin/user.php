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
                    <h4>Data <?= $title;?></h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $no=1;
                                    foreach ($user as $row):
                                    ?>
                                <tr>
                                    <td><?= $no++;?></td>
                                    <td><img src="<?= base_url("assets/image/user/").$row["foto"];?>" width="100px"
                                            alt=""></td>
                                    <td><?= $row["nama"];?></td>
                                    <td><?= $row["username"];?></td>
                                    <td class="d-flex">
                                        <div class="mr-1">
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal<?= $row["id"];?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger"
                                                data-confirm="Hapus Data|Apakah Anda Yakin Ingin Menghapus Data Ini ?"
                                                data-confirm-yes="window.location.href='<?= base_url("admin/user/delete/").$row["id"];?>'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= set_value("nama");?>">
                        <?= form_error("nama", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="<?= set_value("username");?>">
                        <?= form_error("username", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" id="password" class="form-control"
                            value="<?= set_value("password");?>">
                        <?= form_error("password", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($user as $row):?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal<?= $row["id"];?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url("admin/user/edit");?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row["id"];?>">
                    <div class="form-group">
                        <label for="nama1" class="form-label">Nama</label>
                        <input type="text" name="nama1" id="nama1" class="form-control" value="<?= $row["nama"];?>">
                        <?= form_error("nama1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="username1" class="form-label">Username</label>
                        <input type="text" name="username1" id="username1" class="form-control"
                            value="<?= $row["username"];?>">
                        <?= form_error("username1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="password1" class="form-label">Password</label>
                        <input type="text" name="password1" id="password1" class="form-control"
                            placeholder="Isi Jika Ingin Ganti Password">
                        <?= form_error("password1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="foto1" class="form-label">Foto</label>
                        <input type="file" name="foto1" id="foto1" class="form-control">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>