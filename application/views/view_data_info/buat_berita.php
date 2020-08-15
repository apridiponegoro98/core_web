<div class="row">



    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="chartjs-size-monitor">

                        <div class="chartjs-size-monitor-expand">
                            <form action="<?php echo base_url() . 'data_informasi/simpan_tulisan' ?>" method="post" enctype="multipart/form-data">
                                <div class="input-group">
                                    <!-- <input type="radio" id="stringcari" name="stringcari" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2"> -->

                                    <input type="text" id="stringcari" name="judul" class="form-control bg-light border-7 small" placeholder="Judul atau artikel ......" aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="cari" id="btn-cari">
                                            Publish<i class="fas fa-pencil fa-sm"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="ckeditor">
                                    <textarea id="ckeditor" name="isi" cols="40" required></textarea>
                                </div>

                        </div>
                        <div class="chartjs-size-monitor-shrink">

                        </div>
                    </div>
                    <canvas id="myAreaChart" style="display: block; height: 320px; width: 611px;" width="916" height="480" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pengaturan Lainnya</h6>
            </div>
            <!-- Card Body -->

            <div class="card-body">
                <div class="form-group">
                    <h5>Kategori Berita</h5>
                    <select class="form-control select2" name="pilih" style="width: 100%;" required>
                        <option value="" name="pilih">-Pilih-</option>
                        <?php
                        $no = 0;
                        foreach ($data as $m) :
                            $no++;
                            $kategori_id = $m['kategori_id'];
                            $kategori_nama = $m['kategori_nama'];

                        ?>
                            <option value="<?php echo $kategori_id; ?>"><?php echo $kategori_nama; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <h5>Gambar Berita</h5>
                    <div class="col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/bootstrap.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
            height: '400px'
        });
    });
</script>