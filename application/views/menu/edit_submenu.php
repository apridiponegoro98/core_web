<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-12">
            <!-- kalau sukses -->
            <?= $this->session->flashdata('message'); ?>

            <?php foreach ($subMenu as $sm) : ?>

                <form method="post" action="<?php echo base_url() . 'menu/update' ?>">
                    <div class="form-group">
                        <input type="number" name="id" id="id" class="form-control" value="<?php echo $sm->id ?>">
                    </div>
                    <div class="form-group">
                        <label>Title </label>
                        <input type="text" name="title" class="form-control" value="<?php echo $sm->title ?>">
                    </div>

                    <div class="form-grup">
                        <label>Menu For </label>
                        <select name="menu_id" id="menu_id" menu_id class="form-control">
                            <?php
                            // var_dump($menu);
                            // die;
                            foreach ($menu  as $m) : ?>
                                <option value="<?= $m->id; ?>"><?= $m->menu; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        //     var_dump($sm['id']);
                        // echo "<br>";
                        // var_dump($m['menu']);
                        // echo "-------------------<br>";
                        // var_dump($sm->id);
                        // echo "<br>";
                        // var_dump($sm->SubMenu);
                        // die;
                        ?>
                    </div>
                    <!-- <div class=" form-group">
                        <label>Menu id </label>
                        <?php foreach ($menu as $m) : ?>
                            <input type="text" id="icon" name="menu_id" class="form-control" placeholder="SubMenu icon" value="<?php
                                                                                                                                echo $sm->menu_id ?> <?= $m->menu; ?>">
                        <?php endforeach; ?>
                    </div> -->
                    <div class=" form-group">
                        <label>URL </label>
                        <input type="text" id="url" name="url" class="form-control" placeholder="SubMenu Url" value="<?php echo $sm->url ?>">
                    </div>
                    <div class="form-group">
                        <label>ICON </label>
                        <input type="text" id="icon" name="icon" class="form-control" placeholder="SubMenu icon" value="<?php echo $sm->icon ?>">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?php echo $sm->is_active ?>" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>

                </form>

            <?php endforeach; ?>

        </div>