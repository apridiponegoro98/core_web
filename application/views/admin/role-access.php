<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-10">
            <!--kalau eror  -->
            <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?> -->

            <!-- kalau sukses -->
            <?= $this->session->flashdata('message'); ?>

            <h5> Role : <?= $role['role'] ?></h5>

            <div class="table-responsive-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="row">No</th>
                            <th scope="row">Menu</th>
                            <th scope="row">Access</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= 'Tampilan ' . $m['menu'] ?></td>
                                <td>
                                    <div class="form-check">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- modal top up -->