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
                                    <th>Jenis</th>
                                    <th>Umur</th>
                                    <th>Jabatan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $no=1;
                                    foreach ($staff as $row):
                                    ?>
                                <tr>
                                    <td><?= $no++;?></td>
                                    <td><img src="<?= base_url("assets/image/staff/").$row["foto"];?>" width="100px"
                                            alt=""></td>
                                    <td><?= $row["nama"];?></td>
                                    <td><?= $row["tempat"];?>, <?= Tglindo($row["tanggal_lahir"]);?></td>
                                    <td><?= $row["pangkat"];?></td>
                                    <td><?= $row["jabatan"];?></td>
                                    <td class="d-flex">
                                        <div class="mr-1">
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal<?= $row["id_staff"];?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger"
                                                data-confirm="Hapus Data|Apakah Anda Yakin Ingin Menghapus Data Ini ?"
                                                data-confirm-yes="window.location.href='<?= base_url("admin/staff/delete/").$row["id_staff"];?>'">
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="<?= set_value("nama");?>">
                                <?= form_error("nama", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" name="nip" id="nip" class="form-control"
                                    value="<?= set_value("nip");?>">
                                <?= form_error("nip", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="tempat" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat" id="tempat" class="form-control"
                                    value="<?= set_value("tempat");?>">
                                <?= form_error("tempat", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    value="<?= set_value("tanggal_lahir");?>">
                                <?= form_error("tanggal_lahir", '<small class="text-danger">', '</small>');?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pangkat" class="form-label">Pangkat</label>
                                <input type="text" name="pangkat" id="pangkat" class="form-control"
                                    value="<?= set_value("pangkat");?>">
                                <?= form_error("pangkat", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                    value="<?= set_value("jabatan");?>">
                                <?= form_error("jabatan", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>
                        </div>
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
<?php
foreach ($staff as $row):?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal<?= $row["id_staff"];?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url("admin/staff/edit");?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row["id_staff"];?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama1" class="form-label">Nama</label>
                                <input type="text" name="nama1" id="nama1" class="form-control"
                                    value="<?= $row["nama"];?>">
                                <?= form_error("nama1", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="nip1" class="form-label">NIP</label>
                                <input type="number" name="nip1" id="nip1" class="form-control"
                                    value="<?= $row["nip"];?>">
                                <?= form_error("nip1", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="tempat1" class="form-label">Tempat</label>
                                <input type="text" name="tempat1" id="tempat1" class="form-control"
                                    value="<?= $row["tempat"];?>">
                                <?= form_error("tempat1", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir1" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir1" id="tanggal_lahir1" class="form-control"
                                    value="<?= $row["tanggal_lahir"];?>">
                                <?= form_error("tanggal_lahir1", '<small class="text-danger">', '</small>');?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pangkat1" class="form-label">Pangkat</label>
                                <input type="text" name="pangkat1" id="pangkat1" class="form-control"
                                    value="<?= $row["pangkat"];?>">
                                <?= form_error("pangkat1", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="jabatan1" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan1" id="jabatan1" class="form-control"
                                    value="<?= $row["jabatan"];?>">
                                <?= form_error("jabatan1", '<small class="text-danger">', '</small>');?>
                            </div>
                            <div class="form-group">
                                <label for="foto1" class="form-label">Foto</label>
                                <input type="file" name="foto1" id="foto1" class="form-control">
                            </div>
                        </div>
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