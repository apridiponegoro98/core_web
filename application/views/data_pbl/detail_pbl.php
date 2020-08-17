<style>

</style>

<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <?php echo validation_errors(); ?>

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
                        <button class="btn btn-primary" type="submit" name="cari" value="cari" id="btn-cari" autofocus>
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">


                            <table id="dataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <!-- <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;"> -->
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 145px;">NO</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 145px;">NAMA KELOMPOK</th>
                                        <th class="sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" aria-sort="descending" style="width: 223px;">JUDUL PBL</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 103px;">DESA</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 43px;">KECAMATAN</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 95px;">KABUPATEN</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">TAHUN</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">KETERANGAN</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">FILE</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 85px;">ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
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
                                </tfoot>
                                <tbody>
                                    <?php $i = ++$start ?>
                                    <?php foreach ($data_pbl as $m) : ?>
                                        <tr>
                                            <tD scope="row"><?= $i; ?></tD>
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

                                            </td>
                                        </tr>
                                </tbody>
                            <?php endforeach; ?>

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
</script>