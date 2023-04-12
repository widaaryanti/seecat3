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
                                    <th>Nama Bangunan</th>
                                    <th>Alamat</th>
                                    <th>Tipe</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $no=1;
                                foreach ($bangunan as $row):
                                ?>
                                <tr>
                                    <td><?= $no++;?></td>
                                    <td><?= $row["nama_bangunan"];?></td>
                                    <td><?= $row["alamat"];?></td>
                                    <td><?= $row["tipe"];?></td>
                                    <td class="d-flex">
                                        <div class="mr-1">
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal<?= $row["id_bangunan"];?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger"
                                                data-confirm="Hapus Data|Apakah Anda Yakin Ingin Menghapus Data Ini ?"
                                                data-confirm-yes="window.location.href='<?= base_url("admin/bangunan/delete/").$row["id_bangunan"];?>'">
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
            <form method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namabangunan" class="form-label">Nama Bangunan</label>
                        <input type="text" name="namabangunan" id="namabangunan" class="form-control"
                            value="<?= set_value("namabangunan");?>">
                        <?= form_error("namabangunan", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"><?= set_value("alamat");?></textarea>
                        <?= form_error("alamat", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="tipe" class="form-label">Tipe</label>
                        <select name="tipe" id="tipe" class="form-control">
                            <option value="">Pilih...</option>
                            <?php foreach ($tipe as $tp): ?>
                            <?php if(set_value("tipe") == $tp):?>
                            <option value="<?= $tp;?>" selected><?= $tp;?>
                            </option>
                            <?php else:?>
                            <option value="<?= $tp;?>"><?= $tp;?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <?= form_error("tipe", '<small class="text-danger">', '</small>');?>
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
foreach ($bangunan as $row):?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal<?= $row["id_bangunan"];?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url("admin/bangunan/edit");?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row["id_bangunan"];?>">
                    <div class="form-group">
                        <label for="namabangunan1" class="form-label">Nama
                            Bangunan</label>
                        <input type="text" name="namabangunan1" id="namabangunan1" class="form-control"
                            value="<?= $row["nama_bangunan"];?>">
                        <?= form_error("namabangunan1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="alamat1" class="form-label">Alamat</label>
                        <textarea name="alamat1" id="alamat1" class="form-control"><?= $row["alamat"];?></textarea>
                        <?= form_error("alamat1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="tipe1" class="form-label">Tipe</label>
                        <select name="tipe1" id="tipe1" class="form-control">
                            <?php foreach ($tipe as $tp): ?>
                            <?php if($row["tipe"] == $tp):?>
                            <option value="<?= $tp;?>" selected><?= $tp;?>
                            </option>
                            <?php else:?>
                            <option value="<?= $tp;?>"><?= $tp;?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
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