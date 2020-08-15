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

            <?php foreach ($data_pbl as $m) : ?>

                <form method="post" action="<?php echo base_url() . 'pembimbing_lapangan/update' ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id_pbl" id="id" class="form-control" value="<?php echo $m->id_pbl ?>">
                    </div>

                    <div class="form-group">
                        <label for="comment">Nama Kelompok</label>
                        <textarea pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$" title="alphanumeric 6 to 12 chars" class="form-control" rows="5" id="nama_kelompok" name="nama_kelompok"><?php echo $m->nama_kelompok ?></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label>Nama kelompok </label>
                        <input type="text" name="nama_kelompok" class="form-control" value="<?php echo $m->nama_kelompok ?>">
                    </div> -->
                    <div class="form-group">
                        <label>Judul pbl </label>
                        <input type="text" name="judul_pbl" class="form-control" value="<?php echo $m->judul_pbl ?>">
                    </div>
                    <div class="form-group">
                        <label>Desa </label>
                        <input type="text" name="desa" class="form-control" value="<?php echo $m->desa ?>">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan </label>
                        <input type="text" name="kecamatan" class="form-control" value="<?php echo $m->kecamatan ?>">
                    </div>
                    <div class="form-group">
                        <label>Kabupaten </label>
                        <input type="text" name="kabupaten" class="form-control" value="<?php echo $m->kabupaten ?>">
                    </div>
                    <div class="form-group">
                        <label>Tahun </label>
                        <input type="text" name="tahun" class="form-control" value="<?php echo $m->tahun ?>">
                    </div>
                    <div class="form-group">
                        <label>keterangan </label>
                        <!-- <input type="text" name="keterangan" class="form-control" value="<?php echo $m->keterangan ?>"> -->
                        <select class="form-control" name="keterangan" id="keterangan" value="<?php echo $m->keterangan ?>">
                            <option value="LAPORAN PBL 1">LAPORAN PBL 1</option>
                            <option value="LAPORAN PBL 2">LAPORAN PBL 2</option>
                    </div>
                    <div class="form-group">
                        <label>file </label>
                        <!-- <input type="file" name="file" class="form-control" value="<?php echo $m->file ?>"> -->
                    </div>
                    <div class="form-group">
                        <label value="<?php echo $m->file; ?>">file </label>
                        <input type="file" name="file" id="file" class="form-control" value="<?php echo $m->file ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>

                </form>

            <?php endforeach; ?>

        </div>