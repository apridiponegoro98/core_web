<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->


    <div class="row">
        <a href="" class="btn btn-primary mb-2 mc-5 mx-4 my-7" data-toggle="modal" data-target="#newMenuModal">Add Mahasiswa</a>
        <div class="col-lg-10">
            <form action="<?= base_url('operator/detail_opr') ?>" method="POST">
                <!--kalau eror  -->
                <div class="input-group">
                    <!-- <input type="radio" id="stringcari" name="stringcari" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2"> -->
                    <select class=" btn btn-primary dropdown-toggle small" name="pilih" id="pilih">pilih
                        <option value="semua">semua</option>
                        <option value="nama">nama</option>
                        <option value="email">email</option>
                        <option value="is_active">active</option>
                    </select>
                    <input type="text" id="stringcari" name="stringcari" class="form-control bg-light border-7 small" placeholder="Search for all..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="cari" id="btn-cari">
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
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><?php echo  $title ?></h4>
            <h6>Data Mahasiswa</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">


                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                        <tfoot>
                            <tr>
                                <!-- <?php $i = 1 ?> -->
                                <?php foreach ($data_pbl as $m) :
                                    $i = ++$start;
                                    // $passwors_hash = password_hash($m['password'], PASSWORD_DEFAULT);
                                ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['id'] ?></td>
                                <td><?= $m['name'] ?></td>
                                <td><?= $m['email'] ?></td>
                                <td><?= $m['image'] ?></td>
                                <td><?php if ($m['is_active'] == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Non Active";
                                    }
                                    ?></td>
                                <td><?= $m['date_created'] ?></td>

                                <!-- <td><?= $m['keterangan'] ?></td>
                                <td><?= $m['file'] ?></td> -->
                                <td>
                                    <?php echo anchor('operator/update_mahasiswa/' . $m['id'], '<div class="btn btn-primary btn-sm">
    <li class="fa fa-edit"></li>
    </div>') ?>
                                </td>
                                <td>

                                    <?php echo anchor('operator/delete_mahasiswa/' . $m['id'], '<div class="btn btn-danger btn-sm">
    <li class="fa fa-trash"></li>
    </div>') ?>

                                </td>
                                <td>

                                    <!-- <?php echo anchor(
                                                'operator/view_mhs/' . $m['id'],
                                                '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
<li class="fa fa-eye"></li>
</div>'
                                            ) ?> -->

                                </td>

                                <!-- <div class="btn btn-danger" btn-sm data-toggle="modal" data-target="#newMenuModal1" value="<?= $m['id_pbl']; ?>">

                                    <li class="fa fa-trash"></li>
                                </div> -->
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        </tr>
                        </tfoot>
                    </table>
                    <?php echo $this->pagination->create_links(); ?>
                </div>


            </div>
        </div>
        <!-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end"> -->
        <!-- </ul>
            </nav> -->
    </div>

</div>
<!-- /.container-fluid -->


<!-- /.container-fluid -->


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
            <form action="<?= base_url('operator/add_mahasiswa') ?>" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control" placeholder="name ">
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" name="email" class="form-control" placeholder="email">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">Picture</div>
                        <div class="col-lg-2">
                            <!-- <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" alt=""> -->
                        </div>
                        <div class="col-sm-8">

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="is_active" id="is_active" value="<?php echo $m->is_active ?>">
                            <option value="1">Activate</option>
                            <option value="0">non Activate</option>
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="date" name="date" class="form-control" placeholder="date_created">
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
</script>