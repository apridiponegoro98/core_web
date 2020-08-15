<style>

</style>

<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <a href="" class="btn btn-primary mb-2 mc-5 mx-4 my-7" data-toggle="modal" data-target="#newMenuModal">Tambah PBL</a>
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

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Data PBL Fakultas Kesehatan Masyarakat</h1> -->
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3"> -->
        <!-- <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?> Fakultas Kesehatan Masyarakat</h4> -->


        <!-- </div> -->
        <div class="card-body">

            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">


                    <!-- <table id="dtVerticalScrollExample" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <!-- <table id="example" class="table table-striped table-bordered" style="width:100%"> -->
                        <thead>
                            <tr>
                                <th scope="row">NO</th>
                                <!-- <th scope="row">id</th> -->
                                <th scope="row" class="th-sm">NAMA KELOMPOK </th>
                                <th scope="row" class="th-sm">JUDUL PBL</th>
                                <th scope="row" class="th-sm">DESA</th>
                                <th scope="row" class="th-sm">KECAMATAN</th>
                                <th scope="row" class="th-sm">KABUPATEN</th>
                                <th scope="row" class="th-sm">TAHUN</th>
                                <th scope="row" class="th-sm">KETERANGAN</th>
                                <th scope="row" class="th-sm">FILE</th>
                                <th scope="row" class="th-sm"></th>
                                <th scope="row" class="th-sm">ACTION</th>
                                <th scope="row"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php $i = ++$start ?>
                                <?php foreach ($data_pbl as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <!-- <td><?= $m['id_pbl'] ?></td> -->
                                <td> <?php echo substr($m['nama_kelompok'], 0, 50) . "...."; ?></td>
                                <td> <?php echo substr($m['judul_pbl'], 0, 20) . "...."; ?></td>
                                <!-- <td><?= $m['judul_pbl'] ?></td> -->
                                <td><?= $m['desa'] ?></td>
                                <td><?= $m['kecamatan'] ?></td>
                                <td><?= $m['kabupaten'] ?></td>
                                <td><?= $m['tahun'] ?></td>
                                <td><?= $m['keterangan'] ?></td>
                                <td> <?php echo substr($m['file'], 0, 10) . "...."; ?></td>


                                <td>

                                    <?php echo anchor(
                                        'pembimbing_lapangan/view_pbl/' . $m['id_pbl'],
                                        '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
                            <li class="fa fa-eye"></li>
                            </div>'
                                    ) ?>

                                </td>
                                <td>
                                    <?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm">
    <li class="fa fa-edit"></li>
</div>') ?>
                                </td>
                                <td>

                                    <?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
    <li class="fa fa-trash"></li>
    </div>') ?>
                                </td>

                                <!-- <div class="btn btn-danger" btn-sm data-toggle="modal" data-target="#newMenuModal1" value="<?= $m['id_pbl']; ?>">

                                    <li class="fa fa-trash"></li>
                                </div> -->
                                </td>
                            </tr>
                            <!-- <?php $i++; ?> -->
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


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah PBL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pembimbing_lapangan/add_pbl') ?>" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="comment">Nama Kelompok</label>
                        <textarea class="form-control" rows="10" id="nama_kelompok" name="nama_kelompok" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$" title="alphanumeric 6 to 12 chars"></textarea>
                        <!-- <input type="text" id="nama_kelompok" name="nama_kelompok" class="form-control" placeholder="nama_kelompok"> -->
                    </div>
                    <div class="form-group">
                        <input type="text" id="judul_pbl" name="judul_pbl" class="form-control" placeholder="judul_pbl">
                    </div>
                    <div class="form-group">
                        <input type="text" id="desa" name="desa" class="form-control" placeholder="desa">
                    </div>
                    <div class="form-group">
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="kecamatan">
                    </div>
                    <div class="form-group">
                        <input type="text" id="kabupaten" name="kabupaten" class="form-control" placeholder="kabupaten">
                    </div>
                    <div class="form-group">
                        <input type="date" id="tahun" name="tahun" class="form-control" placeholder="tahun">
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="keterangan">
                    </div> -->
                    <div class="form-group">
                        <label>keterangan </label>
                        <!-- <input type="text" name="keterangan" class="form-control" value="<?php echo $m->keterangan ?>"> -->
                        <select class="form-control" name="keterangan" id="keterangan">
                            <option value="LAPORAN PBL 1">LAPORAN PBL 1</option>
                            <option value="LAPORAN PBL 2">LAPORAN PBL 2</option>
                            <option value="LAPORAN PBL 3">LAPORAN PBL 3</option>
                    </div>
                    <div class="form-group">
                        <input type="file" id="berkas" name="berkas" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

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



    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>