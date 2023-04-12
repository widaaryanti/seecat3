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
                                    <th>RW</th>
                                    <th>Laki - laki</th>
                                    <th>Perempuan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $no=1;
                                foreach ($penduduk as $row):
                                ?>
                                <tr>
                                    <td><?= $no++;?></td>
                                    <td>
                                        <?php $penduduk2 = $this->db->get_where("rukun", ["id_rukun" => $row["rw_id"]])->row_array();?>
                                        <?= $penduduk2["kode_rukun"];?> - <?= $penduduk2["alamat"];?>
                                    </td>
                                    <td><?= $row["laki_laki"];?></td>
                                    <td><?= $row["perempuan"];?></td>
                                    <td class="d-flex">
                                        <div class="mr-1">
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal<?= $row["id_penduduk"];?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger"
                                                data-confirm="Hapus Data|Apakah Anda Yakin Ingin Menghapus Data Ini ?"
                                                data-confirm-yes="window.location.href='<?= base_url("admin/penduduk/delete/").$row["id_penduduk"];?>'">
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
                        <label for="rw_id" class="form-label">RW</label>
                        <select name="rw_id" id="rw_id" class="form-control">
                            <option value="">Pilih...</option>
                            <?php foreach ($tipe as $tp): ?>
                            <?php if(set_value("rw_id") == $tp["id_rukun"]):?>
                            <option value="<?= $tp["id_rukun"];?>" selected><?= $tp["kode_rukun"];?> -
                                <?= $tp["alamat"];?>
                            </option>
                            <?php else:?>
                            <option value="<?= $tp["id_rukun"];?>"><?= $tp["kode_rukun"];?> - <?= $tp["alamat"];?>
                            </option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <?= form_error("rw_id", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="laki_laki" class="form-label">Laki - laki</label>
                        <input type="text" name="laki_laki" id="laki_laki" class="form-control"
                            value="<?= set_value("laki_laki");?>">
                        <?= form_error("laki_laki", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="perempuan" class="form-label">Perempuan</label>
                        <input type="text" name="perempuan" id="perempuan" class="form-control"
                            value="<?= set_value("perempuan");?>">
                        <?= form_error("perempuan", '<small class="text-danger">', '</small>');?>
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
foreach ($penduduk as $row):?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal<?= $row["id_penduduk"];?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url("admin/penduduk/edit");?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row["id_penduduk"];?>">
                    <div class="form-group">
                        <label for="rw_id1" class="form-label">RW</label>
                        <select name="rw_id1" id="rw_id1" class="form-control">
                            <option value="">Pilih...</option>
                            <?php foreach ($tipe as $tp): ?>
                            <?php if($row["rw_id"] == $tp["id_rukun"]):?>
                            <option value="<?= $tp["id_rukun"];?>" selected><?= $tp["kode_rukun"];?> -
                                <?= $tp["alamat"];?>
                            </option>
                            <?php else:?>
                            <option value="<?= $tp["id_rukun"];?>"><?= $tp["kode_rukun"];?> - <?= $tp["alamat"];?>
                            </option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <?= form_error("rw_id1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="laki_laki1" class="form-label">Laki - laki</label>
                        <input type="text" name="laki_laki1" id="laki_laki1" class="form-control"
                            value="<?= $row["laki_laki"];?>">
                        <?= form_error("laki_laki1", '<small class="text-danger">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="perempuan1" class="form-label">Perempuan</label>
                        <input type="text" name="perempuan1" id="perempuan1" class="form-control"
                            value="<?= $row["perempuan"];?>">
                        <?= form_error("perempuan1", '<small class="text-danger">', '</small>');?>
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