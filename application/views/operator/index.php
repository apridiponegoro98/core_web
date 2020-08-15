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
    <div class="card-columns shadow mb-4">
        <?php foreach ($data_pbl as $m) : ?>
            <div class="card bg-primary" style="width:10rem">
                <div class=" card" style="width:10rem ">
                    <h9 class="card-header"><?= '<b>' . ++$start . '</b>' ?></h9>
                    <img class="card-img-top" src="<?= base_url('assets/img/profile/') ?><?= $m['image'] ?>" frameborder="0" width="20" alt="Card image">
                    <div class="card-body py-1 px-1">
                        <!-- <h2 class="card-header"></h2> -->
                        <h9 class="card-title"><?php echo substr($m['name'], 0, 10) . "...."; ?></h9>
                        <br>
                        <h9 class="card-title"><?php echo substr($m['email'], 0, 10) . "...."; ?></h9>
                        <br>
                        <h9 class="card-text">
                            <?php
                            if ($m['is_active'] == 1) {
                                echo "<b>User Aktif</b>";
                            } else {
                                echo "<b>User Dinonaktifkan</b>";
                            }
                            ?>
                        </h9>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">See Profile</button>
                        <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- <div><?php echo $m['file']; ?></div><br> -->
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">See Profile</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <embed src="<?= base_url('assets/data_pbl/') ?><?= $m['file'] ?>" frameborder="0" width="100%" height="400px"> -->
                                        <div class="embed-responsive embed-responsive-21by9">
                                            <iframe class="embed-responsive-item"></iframe>
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
        <?php endforeach; ?>
    </div>
    <nav aria-label="Page navigation">
        <?php echo $this->pagination->create_links(); ?>
    </nav>




</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0.4).slideUp(100, function() {
            $(this).remove();
        });
    }, 5000);
</script>