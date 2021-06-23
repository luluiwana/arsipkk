<body>
    <div class="authentication-theme auth-style_1">

        <div class="row">
            <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
                <div class="grid">
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-12 logo-section">
                                <a href="<?=base_url("")?>" class="logo">
                                    <img src="<?=base_url('assets/images/logo.png')?>" alt="logo" />
                                </a>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                                <?php if ($this->session->flashdata('login-failed')) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('login-failed'); echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'; }?>
                                    <form method="post" action="<?php echo base_url('auth/proses_login') ?>">
                                        <div class="form-group input-rounded">
                                            <input type="text" class="form-control" placeholder="Username"
                                                name="username" />
                                        </div>
                                        <div class="form-group input-rounded">
                                            <input type="password" class="form-control" placeholder="Password"
                                                name="password" />
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block"> Login </button>
                                    </form>
                                    <div class="signup-link">
                                        <p>Belum memiliki akun?</p>
                                        <a href="<?php echo base_url('auth/daftar') ?>">Daftar Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth_footer">
                <p class="text-muted text-center">© ArsipKita 2021</p>
            </div>
        </div>
        <!--page body ends -->
<!-- SCRIPT LOADING START FORM HERE /////////////-->
        <!-- plugins:js -->
        <script src="<?=base_url('assets/vendors/js/core.js')?>"></script>
        <script src="<?=base_url('assets/vendors/js/vendor.addons.js')?>"></script>
        <!-- endinject -->
        <!-- Vendor Js For This Page Ends-->
        <!-- Vendor Js For This Page Ends-->
        <!-- build:js -->
        <script src="<?=base_url('assets/js/template.js')?>"></script>
        <!-- endbuild -->
</body>


</html>