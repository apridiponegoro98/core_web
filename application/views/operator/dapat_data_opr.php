<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <div class="alert alert-warning" role="alert1">
        <strong>Click Action!</strong> Untuk Melihat data lengkap
    </div>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <div class="row">
        <!-- <button class="btn btn-primary" type="button" name="cari" id="btn-cari">
            <i class="fas fa-back fa-sm"></i>
        </button> -->
        <!-- <a href="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">Back to List PBL</a> -->
        <!-- <a href="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">View Proses Raita</a> -->
        <div class="col-lg-10">
            <form action="<?= base_url('mahasiswa/index') ?>" method="POST">

            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data PBL Yang Ditemukan</h4>
        </div>

        <a href="<?= base_url('operator/detail_opr') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">Back to List Mahasiswa</a>

        <div class="card-body">
            <button type="button" onclick="cekproses()" class="btn btn-danger mb-2 mc-10 mx-0 my-7">Cek Proses Algoritma Raita </button>
            <div class="table-responsive" style="display:none" id="tabel_hasil">
                <!-- <div class="table-responsive"> -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th scope="row" class="th-sm">No</th> -->
                                <th scope="row" class="th-sm">Data MHS</th>
                                <th scope="row" class="th-sm">Pattern/Teks Dicari</th>
                                <!-- <th scope="row" class="th-sm">Keterangan</th>
                                <th scope="row" class="th-sm">Index ke</th> -->
                                <th scope="row" class="th-sm">Running Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rekams as $rekam) :
                            ?>
                                <tr>
                                    <?php
                                    foreach ($rekam as $ind => $r) :
                                    ?>
                                        <td>
                                            <?php
                                            if ($ind == 0)
                                                echo substr($r, 0, 100) . ".....";
                                            else
                                                echo $r
                                            ?>
                                        </td>
                                    <?php
                                    endforeach;
                                    ?>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="row" class="th-sm">Running Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($Run as $lari) :
                            ?>

                                <tr>
                                    <td>
                                        <?php echo $lari . " ms" ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div> -->

                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th scope="row" class="th-sm">No</th> -->
                                <th scope="row" class="th-sm">Total Kata</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $kata) :
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $kata . " kata" ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="row" class="th-sm">Jumlah data keseluruhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($jum as $kata) :
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $kata . " huruf" ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>

            </div>
            <div class="table-responsive">

                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="row">NO</th>
                                <!-- <th scope="row">id</th> -->
                                <th scope="row" class="th-sm">NAMA MAHASISWA </th>
                                <th scope="row" class="th-sm">EMAIL</th>
                                <th scope="row" class="th-sm">ACTIVE</th>
                                <!-- <th scope="row" class="th-sm">TAHUN</th>
                                <th scope="row" class="th-sm">KETERANGAN</th> -->
                                <!-- <th scope="row" class="th-sm">FILE</th> -->
                                <!-- <th scope="row" class="th-sm"></th> -->
                                <th scope="row" class="th-sm">ACTION</th>
                                <!-- <th scope="row"></th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php $i = 1 ?>

                            <tr>
                                <?php foreach ($as as $m) :
                                    $data_atibutClean = implode("", $m);
                                    $tampil_kan =  stripos($data_atibutClean, $key);

                                ?>

                                    <?php
                                    if ($tampil_kan) {
                                        if (isset($_POST['pilih'])) {
                                            if ($_POST['pilih'] == "semua") {

                                    ?>

                                                <th scope="row"><?= $i; ?></th>
                                                <td><?php $m['name'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['name']);
                                                    echo $m['name'] ?>
                                                </td>
                                                <td><?php

                                                    $m['email'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['email']); ?>
                                                    <?= $m['email'] ?>
                                                </td>
                                                <td>
                                                    <?php $m['is_active'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['is_active']); ?>
                                                    <?= $m['is_active'] ?>
                                                </td>
                                            <?php
                                            } elseif ($_POST['pilih'] == "nama") {
                                            ?>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?php $m['name'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['name']);
                                                    echo $m['name'] ?>
                                                </td>
                                                <td><?php echo "email pengguna"; ?></td>
                                                <td><?php echo "cek action apakah dia aktif"; ?></td>
                                            <?php } elseif ($_POST['pilih'] == "email") {
                                            ?>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php $m['email'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['email']);
                                                    echo $m['email'] ?>
                                                </td>
                                                <td><?php echo "cek action apakah dia aktif"; ?></td>
                                            <?php
                                            } elseif ($_POST['pilih'] == "is_Active") {
                                            ?>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php echo "Judul PBL"; ?></td>
                                                <td>
                                                    <?php $m['is_Active'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['is_Active']); ?>
                                                    <?= $m['is_Active'] ?>
                                                </td>
                                        <?php
                                            }
                                        } ?>

                                        <td>

                                            <?php echo anchor(
                                                'mahasiswa/view_pbl_mhs/' . $m['id'],
                                                '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
                                                <li class="fa fa-eye"></li>
                                                </div>'
                                            ) ?>

                                            <!-- </td> -->
                                        </td>
                            </tr>
                        <?php
                                    } else {
                                    }
                                    $i++; ?>
                    <?php endforeach; ?>
                    </tr>
                        </tfoot>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>

            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $('body').on('keydown', '#stringcari', function(e) {
        console.log(this.value)
        if (e.which === 32 && e.target.selectionStart === 0) {
            return false
        }
    })

    function cekproses() {
        var nilai = document.getElementById("tabel_hasil").style.display;

        document.getElementById("tabel_hasil").style.display = (nilai == "block") ? "none" : "block";

        console.log(document.getElementById("tabel_hasil").style.display);

    }

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);

    window.setTimein(function() {
        $(".alert1").fadeTo(100, 0).slideUp(200, function() {
            $(this).remove();
        });
    }, 5000);
</script>