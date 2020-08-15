                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-10">
                            <!--kalau eror  -->
                            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

                            <!-- kalau sukses -->
                            <?= $this->session->flashdata('message'); ?>
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="row">No</th>
                                        <th scope="row">Name</th>
                                        <th scope="row">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $m['menu'] ?></td>
                                            <td>
                                                <?php echo anchor('menu/editMenu/' . $m['id'], '<div class="btn btn-primary btn-sm">
						<li class="fa fa-edit"></li>
                    </div>') ?>

                                                <div class="btn btn-danger" btn-sm data-toggle="modal" data-target="#newMenuModal1">
                                                    <li class="fa fa-trash"></li>
                                                </div>
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
                            <form action="<?= base_url('menu/tambahMenu') ?>" method="POST">

                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" id="menu" name="menu" class="form-control" placeholder="Menu Name">
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
                                <a class="btn btn-primary" href="<?= base_url('menu/hapusMenu/' . $m['id']) ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Toggler (Sidebar) -->