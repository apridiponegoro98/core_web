<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?> </h4>
            <h7 class="m-20 font-italic text-black">PBL Fakultas Kesehatan Masyarakat </h7>
        </div>
    </div>
    <div class="row">


        <div class="card-columns shadow mb-4">

            <?php
            foreach ($data_pbl as $m) :
                $i = ++$start;
                $data['i'] = $i;
                // $jumlah[] = $i;
                // // var_dump($jumlah[]);
            ?>

                <div class="card bg-primary">

                    <div class="card" style="width:400px">
                        <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
                        <div class="card-body py-10 px-20">
                            <h8 class="card-title "><?php echo "No User " . $i ?></h8>
                            <h4 class="card-header"><?php echo substr($m['nama_kelompok'], 0, 15) . "...."; ?></h4>
                            <h6 class="card-title"><?= $m['desa'] ?></h6>
                            <h7 class="card-text"><?= $m['tahun'] ?></h7>
                            <h5 class="card-text text-weight-bold"><?= $m['keterangan'] ?></h5>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Preview PBL</button>
                            <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <!-- <div><?php echo $m['file']; ?></div><br> -->
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Preview PBL</h4>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <embed src="<?= base_url('assets/data_pbl/') ?><?= $m['file'] ?>" frameborder="0" width="100%" height="400px"> -->
                                            <div class="embed-responsive embed-responsive-21by9">
                                                <iframe class="embed-responsive-item" src="<?= base_url('assets/data_pbl/') ?><?= $m['file'] ?>"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            endforeach;

            ?>



        </div>
    </div>
    <nav aria-label="Page navigation">
        <?php echo $this->pagination->create_links(); ?>
    </nav>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>