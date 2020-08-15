<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col lg-4">
        <div class="col-lg-10"></div>
        <?= form_open_multipart('user/edit'); ?>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?= $user['email'] ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $user['name'] ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">Picture</div>
            <div class="col-lg-2">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" alt="">
            </div>
            <div class="col-sm-8">

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
        </div>



        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>

        <!-- /.container-fluid -->
    </div>
    <!-- table responsive -->

</div>
</form>
</div>
</div>
</div>