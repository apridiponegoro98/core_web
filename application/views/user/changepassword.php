<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>
    <div class="col lg-4">
        <div class="row">
            <div class="col-lg-10">
                <?= $this->session->flashdata('message'); ?>
                <form action="<?= base_url('user/changepassword'); ?>" method="POST">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="current_password">
                        <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="current_password">New Password</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="new password">
                        <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="current_password">Repeat Password</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="new password">
                        <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">change password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->