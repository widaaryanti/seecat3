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
                    <a href="<?= base_url("admin/artikel/tambah");?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Foto</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Tanggal</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $no=1;
                                    foreach ($artikel as $row):
                                    ?>
                                <tr>
                                    <td><?= $no++;?></td>
                                    <td>
                                        <img src="<?= base_url("assets/image/blog/").$row["foto"];?>" width="200px"
                                            alt="">
                                    </td>
                                    <td><?= $row["judul"];?></td>
                                    <td>
                                        <?php $author = $this->db->get_where("user", ["id" => $row["author"]])->row_array();?>
                                        <?= $author["nama"];?>
                                    </td>
                                    <td><?= Tglindo($row["tanggal"]);?></td>
                                    <td class="d-flex">
                                        <div class="mr-1">
                                            <a href="<?= base_url("admin/artikel/edit/").$row["id_artikel"];?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger"
                                                data-confirm="Hapus Data|Apakah Anda Yakin Ingin Menghapus Data Ini ?"
                                                data-confirm-yes="window.location.href='<?= base_url("admin/artikel/delete/").$row["id_artikel"];?>'">
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