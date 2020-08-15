<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('operator/index') ?>" class="btn btn-primary mb-2 mc-5 mx-10 my-7">Back to List Mahasiswa</a>

    <div class="row">
        <div class="col-lg-10">
            <!--kalau eror  -->
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <!-- kalau sukses -->
            <?= $this->session->flashdata('message'); ?>
            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a> -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="row">NO</th>
                        <!-- <th scope="row">id</th> -->
                        <th scope="row" class="th-sm">ID </th>
                        <th scope="row" class="th-sm">NAMA </th>
                        <th scope="row" class="th-sm">EMAIL</th>
                        <th scope="row" class="th-sm">IMAGE</th>
                        <th scope="row" class="th-sm">Active</th>
                        <th scope="row" class="th-sm">DATE CRETAE</th>
                        <!-- <th scope="row" class="th-sm">PASSWORD</th> -->
                        <!-- <th scope="row" class="th-sm">KETERANGAN</th> -->
                        <!-- <th scope="row" class="th-sm">FILE</th> -->
                        <th scope="row" class="th-sm"></th>
                        <th scope="row" class="th-sm">ACTION</th>
                        <th scope="row"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data_pbl as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['id'] ?></td>
                            <td><?= $m['name'] ?></td>
                            <td><?= $m['email'] ?></td>
                            <td><?= $m['image'] ?></td>
                            <td><?= $m['is_active'] ?></td>
                            <td><?= $m['date_created'] ?></td>


                            <td>
                                <?php echo anchor('pembimbing_lapangan/download/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm">
<li class="fa fa-download"></li>
</div>') ?>
                            </td>
                            <!-- <td>


                        <!-- </td> -->

                            <!-- <div class="btn btn-danger" btn-sm data-toggle="modal" data-target="#newMenuModal1" value="<?= $m['id_pbl']; ?>">

                                <li class="fa fa-trash"></li>
                            </div> -->
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pembimbing_lapangan/add_pbl') ?>" method="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="nama_kelompok" name="nama_kelompok" class="form-control" placeholder="nama_kelompok ">
                    </div>
                    <div class="form-group">
                        <input type="text" id="judul_pbl" name="judul_pbl" class="form-control" placeholder="judul_pbl">
                    </div>
                    <div class="form-group">
                        <input type="text" id="desa" name="desa" class="form-control" placeholder="desa">
                    </div>
                    <div class="form-group">
                        <input type="date" id="tahun" name="tahun" class="form-control" placeholder="tahun">
                    </div>

                    <div class="form-group">
                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="keterangan">
                    </div>
                    <div class="form-group">
                        <input type="file" id="file" name="file" class="form-control" placeholder="file">
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
    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>