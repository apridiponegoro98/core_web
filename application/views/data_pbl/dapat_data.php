<div class="container-fluid">

    <?= $this->session->flashdata('message');
    // $show = stripos();
    ?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <!-- <button class="btn btn-primary" type="button" name="cari" id="btn-cari">
            <i class="fas fa-back fa-sm"></i>
        </button> -->
        <!-- <a href="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">Back to List PBL</a> -->
        <!-- <a href="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">View Proses Raita</a> -->
        <div class="col-lg-10">
            <form action="<?= base_url('pembimbing_lapangan/detail_pbl.php') ?>" method="POST">

            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data PBL Yang Ditemukan</h4>
        </div>
        <a href="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" class="btn btn-primary mb-2 mc-5 mx-4 my-7">Back to List PBL</a>

        <div class="card-body">
            <button type="button" onclick="cekproses()" class="btn btn-danger mb-2 mc-10 mx-0 my-7">Cek Proses Algoritma Raita </button>
            <div class="table-responsive" style="display:none" id="tabel_hasil">
                <!-- <div class="table-responsive"> -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th scope="row" class="th-sm">No</th> -->
                                <th scope="row" class="th-sm">Data PBL</th>
                                <th scope="row" class="th-sm">Pattern/Teks Dicari</th>
                                <!-- <th scope="row" class="th-sm">Keterangan</th> -->
                                <!-- <th scope="row" class="th-sm">Index ke</th> -->
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
                                            if ($ind == 0) {

                                                // $m['kabupaten'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['kabupaten']);
                                                // $m['kabupaten'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['kabupaten']);
                                                // echo substr($r , 0, 100) . ".....";
                                                // echo substr($r , 0, 100) . ".....";
                                                $r = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $r);
                                                echo $r;
                                            } else {
                                                echo $r;
                                            }
                                            // echo $m['kabupaten']
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
                                        <?php
                                        // echo $lari . " ms" ;
                                        $lari = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $lari);
                                        echo $lari . "ms";

                                        ?>
                                </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div> -->
                <!-- 
                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                
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
                </div> -->

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
                                <!-- <th scope="row">NO</th> -->
                                <th scope="row">id</th>
                                <th scope="row" class="th-sm">NAMA KELOMPOK </th>
                                <th scope="row" class="th-sm">JUDUL PBL</th>
                                <th scope="row" class="th-sm">DESA</th>
                                <th scope="row" class="th-sm">KECAMATAN</th>
                                <th scope="row" class="th-sm">KABUPATEN</th>
                                <th scope="row" class="th-sm">TAHUN</th>
                                <th scope="row" class="th-sm">KETERANGAN</th>
                                <!-- <th scope="row" class="th-sm">FILE</th> -->
                                <th scope="row" class="th-sm"></th>
                                <th scope="row" class="th-sm">ACTION</th>
                                <th scope="row"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php $i = 1?>
                            <tr>
                                <?php foreach ($as as $m) :
                                    $new_title = $as;
                                    $data_atibutClean = implode("", $m);
                                    $tampil_kan =  stripos($data_atibutClean, $key);
                                ?>
                                    <?php if (isset($_POST['pilih'])) {
                                        if ($tampil_kan) {
                                            if ($_POST['pilih'] == "semua") {
                                                $this->matches = true;                ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php $m['nama_kelompok'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['nama_kelompok']);
                                                    echo $m['nama_kelompok'] . "<span style='background-color:blue'/>" ?>
                                                </td>
                                                <td><?php $m['judul_pbl'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['judul_pbl']); ?>
                                                    <?= $m['judul_pbl'] ?>
                                                </td>
                                                <td>
                                                    <?php $m['desa'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['desa']); ?>
                                                    <?= $m['desa'] ?>
                                                </td>
                                                <td>
                                                    <?php $m['kecamatan'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['kecamatan']); ?>
                                                    <?= $m['kecamatan'] ?>
                                                </td>
                                                <td>
                                                    <?php $m['kabupaten'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['kabupaten']); ?>
                                                    <?= $m['kabupaten'] ?>
                                                </td>
                                                <td>
                                                    <?php $m['tahun'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['tahun']); ?>
                                                    <?= $m['tahun'] ?>
                                                </td>
                                                <td>
                                                    <?php $m['keterangan'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['keterangan']); ?>
                                                    <?= $m['keterangan'] ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                                // $this->STEP[] = "<b>Dapat</>";
                                                // $this->STEP[] = "Pada index =" . $k;
                                                // $this->STEP[] = number_format((float) microtime(true) -  (float) $this->start, 10) . "ms";
                                            } else if ($_POST['pilih'] == "nama_kelompok") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $i; ?></th>
                                                <td><?php $m['nama_kelompok'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['nama_kelompok']);
                                                    echo $m['nama_kelompok'] . "<span style='background-color:blue'/>" ?>
                                                </td>
                                                <td><?php echo "Judul pbl"; ?></td>
                                                <td><?php echo "Desa/kelurahaan"; ?></td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "nama_kelompok") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok (Lihat Selengkapnya Action)"; ?></td>
                                                <td><?php $m['judul_pbl'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['judul_pbl']);
                                                    echo $m['judul_pbl'] . "<span style='background-color:blue'/>" ?>
                                                </td>
                                                <td><?php echo "Desa/kelurahaan"; ?></td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "judul") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok (Lihat Selengkapnya Action)"; ?></td>
                                                <td><?php $m['judul_pbl'] = str_ireplace($key, "<span style='background-color:yellow'>" . strtoupper($key)  . "</span>", $m['judul_pbl']);
                                                    echo $m['judul_pbl'] . "<span style='background-color:blue'/>" ?>
                                                </td>
                                                <td><?php echo "Desa/kelurahaan"; ?></td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "desa") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php echo "Judul PBL"; ?></td>
                                                <td>
                                                    <?php $m['desa'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['desa']); ?>
                                                    <?= $m['desa'] ?>
                                                </td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "kecamatan") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php echo "Judul PBL"; ?></td>
                                                <td><?php echo "Desa"; ?></td>
                                                <td>
                                                    <?php $m['kecamatan'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['kecamatan']); ?>
                                                    <?= $m['kecamatan'] ?>
                                                </td>
                                                <td><?php echo "Kabupaten"; ?></td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "kabupaten") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php echo "Judul PBL"; ?></td>
                                                <td><?php echo "Desa"; ?></td>
                                                <td><?php echo "Kecamatan "; ?></td>
                                                <td>
                                                    <?php $m['kabupaten'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['kabupaten']); ?>
                                                    <?= $m['kabupaten'] ?>
                                                </td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "tahun") {
                                                echo "";
                                            ?>

                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php echo "Judul PBL"; ?></td>
                                                <td><?php echo "Desa/ Kelurahan"; ?></td>
                                                <td>
                                                    <?php $m['tahun'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['tahun']); ?>
                                                    <?= $m['tahun'] ?>
                                                </td>
                                                <td><?php echo "Keterangan (PBLL I,II atau III)"; ?></td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                            <?php
                                            } else if ($_POST['pilih'] == "keterangan") {
                                                echo "";
                                            ?>
                                                <th scope="row"><?= $m['id_pbl']; ?></th>
                                                <td><?php echo "Nama Kelompok PBL"; ?></td>
                                                <td><?php echo "Judul PBL"; ?></td>
                                                <td><?php echo "Desa/ Kelurahan"; ?></td>
                                                <td><?php echo "Tahun PBL"; ?></td>
                                                <td>
                                                    <?php $m['keterangan'] = str_ireplace($key, "<span style='background-color:yellow'>" . $key . "</span>", $m['keterangan']); ?>
                                                    <?= $m['keterangan'] ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/view_pbl/' . $m['id_pbl'], '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-eye"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm"><li class="fa fa-edit"></li></div>') ?>
                                                </td>
                                                <td><?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?"><li class="fa fa-trash"></li></div>') ?>
                                                </td>
                                    <?php
                                            } else {
                                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ternyata Data "' . $_POST['stringcari'] . '"' . ' </div>');
                                                // redirect('pembimbing_lapangan/detail_pbl');
                                            }
                                        } else {
                                        }
                                    } else {
                                        redirect('pembimbing_lapangan/detail_pbl');
                                    }
                                    ?>
                            </tr>
                            <?php $i++; ?>
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
</script>