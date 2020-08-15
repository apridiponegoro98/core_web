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

            <?php foreach ($menu as $m) : ?>

                <form method="post" action="<?php echo base_url() . 'menu/updateMenu' ?>">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $m->id ?>">
                    </div>
                    <div class="form-group">
                        <label>Menu </label>
                        <input type="text" name="menu" class="form-control" value="<?php echo $m->menu ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>

                </form>

            <?php endforeach; ?>

        </div>