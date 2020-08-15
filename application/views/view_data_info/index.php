<style>

</style>

<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <?php echo validation_errors(); ?>

    <div class="row">

        <a href="<?= base_url('data_informasi/buat_berita') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">Tambah PBL</a>
        <div class="col-lg-10">
            <form action="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" method="POST">
                <!--kalau eror  -->
                <div class="input-group">
                    <!-- <input type="radio" id="stringcari" name="stringcari" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2"> -->
                    <select class=" btn btn-primary dropdown-toggle small" name="pilih" id="pilih">pilih
                        <option value="semua">semua</option>
                        <option value="nama_kelompok">nama</option>
                        <option value="judul">Judul</option>
                        <option value="desa">desa</option>
                        <option value="kecamatan">kecamatan</option>
                        <option value="kabupaten">kabupaten</option>
                        <option value="tahun">Tahun</option>
                        <option value="keterangan">keterangan</option>
                    </select>
                    <input type="text" id="stringcari" name="stringcari" class="form-control bg-light border-7 small" placeholder="Search for all..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="cari" id="btn-cari" autofocus>
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?> Fakultas Kesehatan Masyarakat</h4>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">


                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="row">NO</th>
                                <!-- <th scope="row">id</th> -->
                                <th scope="row" class="th-sm">Gambar </th>
                                <th scope="row" class="th-sm">JUDUL BERITA</th>
                                <th scope="row" class="th-sm">TANGGAL</th>
                                <th scope="row" class="th-sm">AUTHOR</th>
                                <th scope="row" class="th-sm">BACA</th>
                                <th scope="row" class="th-sm">KATEGORI</th>
                                <th scope="row"></th>
                                <th scope="row" class="th-sm">ACTION</th>
                                <th scope="row"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php $i = 1; ?>
                                <?php foreach ($data as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><img src="<?php echo base_url() . 'assets/images/' . $m['tulisan_gambar']; ?>" style="width:50px;"></td>
                                <!-- <td><?= $m['tulisan_gambar'] ?></td> -->
                                <td> <?php echo substr($m['tulisan_judul'], 0, 50) . "...."; ?></td>
                                <td> <?php echo substr($m['tulisan_isi'], 0, 20) . "...."; ?></td>
                                <!-- <td><?= $m['judul_pbl'] ?></td> -->
                                <td><?= $m['tulisan_tanggal'] ?></td>
                                <td><?= $m['tulisan_views'] ?></td>
                                <td><?= $m['tulisan_kategori_nama'] ?></td>
                                <td>

                                    <?php echo anchor(
                                        'pembimbing_lapangan/view_pbl/' . $m['tulisan_id'],
                                        '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
                                        <li class="fa fa-eye"></li>
                                        </div>'
                                    ) ?>

                                </td>

                                <td>
                                    <?php echo anchor('data_informasi/edit_tulisan/' . $m['tulisan_id'], '<div class="btn btn-primary btn-sm">
                                        <li class="fa fa-edit"></li>
                                        </div>') ?>
                                </td>
                                <td>

                                    <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $m['tulisan_id']; ?>">
                                        <div class="btn btn-danger btn-sm">
                                            <li class="fa fa-trash"></li>
                                        </div>
                                    </a>
                                </td>

                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        </tr>
                        </tfoot>
                    </table>
                    <nav aria-label="Page navigation">
                        <?php echo $this->pagination->create_links(); ?>
                    </nav>
                </div>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?php foreach ($data as $i) :
    $tulisan_id = $i['tulisan_id'];
    $tulisan_judul = $i['tulisan_judul'];
    $tulisan_gambar = $i['tulisan_gambar'];
?>
    <!--Modal Hapus Pengguna-->
    <div class="modal fade" id="ModalHapus<?php echo $tulisan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Berita</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url() . 'data_informasi/hapus_tulisan' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="kode" value="<?php echo $tulisan_id; ?>" />
                        <input type="hidden" value="<?php echo $tulisan_gambar; ?>" name="gambar">
                        <p>Apakah Anda yakin mau menghapus Posting <b><?php echo $tulisan_judul; ?></b> ?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Divider -->
<div class="modal fade" id="newMenuModal1" tabindex="-1" role="dialog" aria-labelledby="newMenuModal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModal1">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you are ready to end Data.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('pembimbing_lapangan/delete_pbl/' . $m['id_pbl']) ?>">Delete PBL</a>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar Toggler (Sidebar) -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0.4).slideUp(100, function() {
            $(this).remove();
        });
    }, 5000);


    var input = document.getElementById('stringcari');

    input.oninvalid = function(event) {
        event.target.setCustomValidity('Username should only contain lowercase letters. e.g. john');
    }
</script>