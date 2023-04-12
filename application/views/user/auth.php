<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-5">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card card-primary">
                <div class="card-header d-block text-center">
                    <div class="mx-auto">
                        <img src="<?= base_url("assets/image/tasik.png");?>" class="mb-3" width="60px">
                    </div>
                    <h5 class="text-uppercase">Selamat Datang di</h5>
                    <h5 class="text-uppercase">Kelurahan Ciakar</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                            <?= form_error("username", '<small class="text-danger">', '</small>');?>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <?= form_error("password", '<small class="text-danger">', '</small>');?>
                        </div>
                        <div class="g-recaptcha form-group" name="g-recaptcha" id="g-recaptcha"
                            data-sitekey="6LeUT88kAAAAAOKdJloZpmEhWC5MjuF5lFfU2Qvg"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>