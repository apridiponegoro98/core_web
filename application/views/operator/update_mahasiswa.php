<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?> </h4>
            <h7 class="m-20 font-italic text-black">PBL Fakultas Kesehatan Masyarakat </h7>
        </div>
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <!--kalau eror  -->
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>
            <!-- kalau sukses -->
            <?= $this->session->flashdata('message'); ?>

            <?php foreach ($user as $m) : ?>


                <form action="<?= base_url('operator/update') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $m->id ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama </label>
                        <input type="text" name="name" class="form-control" value="<?php echo $m->name ?>">
                    </div>
                    <div class="form-group">
                        <label>Email </label>
                        <input type="text" name="email" class="form-control" value="<?php echo $m->email ?>">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">Picture</div>
                        <div class="col-lg-2">
                            <?php if ($m->image != null) {
                            ?>
                                <img src="<?= base_url('assets/img/profile/') . $m->image ?>" class="img-thumbnail" alt="   ">

                            <?php
                            } else
                                $tes = $m->image;
                            ?>
                        </div>
                        <div class="col-sm-8">

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" value="<?php $tes ?>">
                                <label class="custom-file-label" for="customFile" value="<?php echo $m->image ?>"><?php echo $m->image ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>active </label>
                        <!-- <input type="text" name="keterangan" class="form-control" value="<?php echo $m->keterangan ?>"> -->
                        <select class="form-control" name="is_active" id="is_active" value="<?php echo $m->is_active ?>">
                            <option value="1">aktifkan</option>
                            <option value="0">non aktifkan</option>
                    </div>
                    <div>
                        <input type="hidden" name="date_created" class="form-control" value="<?php echo $m->date_created ?>">

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>


                </form>

            <?php endforeach; ?>

        </div>