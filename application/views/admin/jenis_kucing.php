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
                                    <th>Jenis Kucing</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $no=1;
                                foreach ($jenis as $row):
                                ?>
                                <tr>
                                    <td><?= $no++;?></td>
                                    <td><?= $row["jenis_kucing"];?></td>
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
                                                data-confirm-yes="window.location.href='<?= base_url("admin/jenis/delete/").$row["id"];?>'">
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
                        <label for="jenis_kucing" class="form-label">Jenis Kucing</label>
                        <input type="text" name="jenis_kucing" id="jenis_kucing" class="form-control"
                            value="<?= set_value("jenis_kucing");?>">
                        <?= form_error("jenis_kucing", '<small class="text-danger">', '</small>');?>
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
foreach ($jenis as $row):?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal<?= $row["id"];?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url("admin/jenis/edit");?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row["id"];?>">
                    <div class="form-group">
                        <label for="jenis_kucing1" class="form-label">Jenis Kucing</label>
                        <input type="text" name="jenis_kucing1" id="jenis_kucing1" class="form-control"
                            value="<?= $row["jenis_kucing"];?>">
                        <?= form_error("jenis_kucing1", '<small class="text-danger">', '</small>');?>
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