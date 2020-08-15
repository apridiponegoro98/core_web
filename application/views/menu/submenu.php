<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <!--kalau eror  -->
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>
            <!-- kalau sukses -->
            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>

            <div class="table-responsive-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="row">No</th>
                            <th scope="row">Title</th>
                            <th scope="row">Menu</th>
                            <th scope="row">Url</th>
                            <th scope="row">Icon</th>
                            <th scope="row">Active</th>
                            <th scope="row">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($subMenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sm['title'] ?></td>
                                <td><?= $sm['menu'] ?></td>
                                <td><?= $sm['url'] ?></td>
                                <td><?= $sm['icon'] ?></td>
                                <td><?= $sm['is_active'] ?></td>

                                <!-- <td><?php echo $sm->id ?></td>
                                <td><?php echo $sm->menu_id ?></td>
                                <td><?php echo $sm->title ?></td>
                                <td><?php echo $sm->menu ?></td>
                                <td><?php echo $sm->url ?></td>
                                <td><?php echo $sm->icon ?></td>
                                <td><?php echo $sm->is_active ?></td> -->

                                <td>

                                    <?php echo anchor('menu/editSubmenu/' . $sm['id'], '<div class="btn btn-primary btn-sm">
						<li class="fa fa-edit"></li>
                        </div>') ?>

                                <td>
                                    <?php echo anchor('menu/hapusSubmenu/' . $sm['id'], '<div class="btn btn-danger btn-sm">
						<li class="fa fa-trash"></li>
                        </div>') ?>
                                </td>

                                <!-- <div class="btn btn-danger" btn-sm data-toggle="modal" data-target="#newMenuModal1">
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
<!-- table responsive -->



</div>
<!-- End of Main Content -->

<!-- modal top up -->


<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModal">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu') ?>" method="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="title" name="title" class="form-control" placeholder="SubMenu Title">
                    </div>
                    <div class="form-grup">
                        <select name="menu_id" id="menu_id" menu_id class="form-control">
                            <option value="">Select menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group">
                        <input type="text" id="url" name="url" class="form-control" placeholder="SubMenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" id="icon" name="icon" class="form-control" placeholder="SubMenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
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
                <h5 class="modal-title" id="newMenuModal1">Ready to Delete Sub Menu?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you are ready to end Data.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('menu/hapusSubmenu/' . $sm['id']) ?>">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar Toggler (Sidebar) -->