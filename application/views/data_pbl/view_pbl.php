<div class="container-fluid">

    <!-- Page Heading -->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?></h4>
        </div>
        <div class="card py-3">
            <!-- <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?></h4> -->
            <a href="<?= base_url('pembimbing_lapangan/detail_pbl') ?>" class="btn btn-primary mb-2 mc-5 mx-10 my-7">Back to List PBL</a>
        </div>
        <div class="card py-3">
            <!-- <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?></h4> -->
            <a href="#" class="btn btn-secondary mb-0 mc-5 mx-5 my-7">Data PBL Anda </a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">


                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="row">NO</th>
                                <!-- <th scope="row">id</th> -->
                                <th scope="row" class="th-sm">NAMA KELOMPOK </th>
                                <th scope="row" class="th-sm">JUDUL PBL</th>
                                <th scope="row" class="th-sm">DESA</th>
                                <th scope="row" class="th-sm">KECAMATAN</th>
                                <th scope="row" class="th-sm">KABUPATEN</th>
                                <th scope="row" class="th-sm">TAHUN</th>
                                <th scope="row" class="th-sm">KETERANGAN</th>
                                <th scope="row" class="th-sm">FILE</th>
                                <th scope="row" class="th-sm">PREVIEW</th>
                                <th scope="row" class="th-sm"></th>
                                <th scope="row" class="th-sm">ACTION</th>
                                <th scope="row" class="th-sm"></th>
                            </tr>
                        </thead>
                        <!-- <tfoot> -->
                        <tr>
                            <?php $i = 1 ?>
                            <?php foreach ($data_pbl as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <!-- <td><?= $m['id_pbl'] ?></td> -->
                            <td> <?php echo substr($m['nama_kelompok'], 0, 1050) . "...."; ?></td>
                            <td> <?php echo substr($m['judul_pbl'], 0, 70) . "...."; ?></td>
                            <td><?= $m['desa'] ?></td>
                            <td><?= $m['kecamatan'] ?></td>
                            <td><?= $m['kabupaten'] ?></td>
                            <td><?= $m['tahun'] ?></td>
                            <td><?= $m['keterangan'] ?></td>
                            <td> <?php echo substr($m['file'], 0, 20) . "...."; ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View PBL</button>
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <div><?php echo $m['file']; ?></div><br>
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Preview Data PBL Yang Anda Temukan</h4>
                                            </div>
                                            <div class="modal-body">

                                                <!-- <embed src="<?= base_url('assets/data_pbl/') ?><?= $m['file'] ?>" frameborder="0" width="100%" height="400px"> -->
                                                <div class="embed-responsive embed-responsive-21by9"> -->
                                                    <iframe class="embed-responsive-item" src="<?= base_url('assets/data_pbl/') ?><?= $m['file'] ?>"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>

                                <?php echo anchor(
                                    'pembimbing_lapangan/download/' . $m['id_pbl'],
                                    '<div class="btn btn-info btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
                            <li class="fa fa-save"></li>
                            </div>'
                                ) ?>


                            </td>
                            <td>
                                <?php echo anchor('pembimbing_lapangan/update_pbl/' . $m['id_pbl'], '<div class="btn btn-primary btn-sm">
    <li class="fa fa-edit"></li>
</div>') ?>
                            </td>
                            <td>

                                <?php echo anchor('pembimbing_lapangan/delete_pbl/' . $m['id_pbl'], '<div class="btn btn-danger btn-sm" btn-sm data-toggle="modal" data-target="#newMenuModal1?">
    <li class="fa fa-trash"></li>
    </div>') ?>
                            </td>
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
    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>