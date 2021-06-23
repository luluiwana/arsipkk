<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->

    <div class="card">
        <div class="card-body">
            <img src="<?=base_url()?>assets/img/user.png" alt="" srcset="" width="40px">
            <h5 class="pt-2 text-dark font-weight-bold">Hai <span style="color:#F0A21C"><?=
            $this->session->userdata('nama');
            ?></span></h5>
            <a href="<?=base_url()?>tambah" class="btn btn-dark text-white mt-1 sml"><i class="fas fa-plus mr-1"></i>Tambah Arsip</a>
           
        </div>
    </div>
     <div class="pt-4 small">Jenis arsip</div>
    <div class="row pl-2 mt-1">
        <div class="col-md-6 col-xl-3 col-xs-6">
            <a href="<?=base_url()?>pendidikan">
                <div class="card menu border-bottom-warning">
                    <div class="card-body">
                        <div><i class="text-dark fas fa-graduation-cap mb-3 mt-1" style=""></i></div>
                        <div class="text-dark font-weight-bold sml">Pendidikan</div>

                        <!-- <img src="https://www.pngarts.com/files/6/User-Avatar-in-Suit-PNG.png" alt="" srcset=""
                        width="40px" class="my-3"> -->
                        <div class="text-dark sml"><span class="h4 font-weight-bold"><?=$pendidikan?></span> Arsip</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3 col-xs-6">
            <a href="<?=base_url()?>keuangan">
                <div class="card menu border-bottom-warning">
                    <div class="card-body">
                        <div><i class="text-dark fas  fa-hand-holding-usd mb-3 mt-1" style=""></i></div>
                        <div class="text-dark font-weight-bold sml">Keuangan</div>

                        <!-- <img src="https://www.pngarts.com/files/6/User-Avatar-in-Suit-PNG.png" alt="" srcset=""
                        width="40px" class="my-3"> -->
                        <div class="text-dark sml"><span class="h4 font-weight-bold"><?=$keuangan?></span> Arsip</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3 col-xs-6">
            <a href="<?=base_url()?>kesehatan">
                <div class="card menu border-bottom-warning">
                    <div class="card-body">
                        <div><i class="text-dark fas fa-heartbeat mb-3 mt-1" style=""></i></div>
                        <div class="text-dark font-weight-bold sml">Kesehatan</div>

                        <!-- <img src="https://www.pngarts.com/files/6/User-Avatar-in-Suit-PNG.png" alt="" srcset=""
                        width="40px" class="my-3"> -->
                        <div class="text-dark sml"><span class="h4 font-weight-bold"><?=$kesehatan?></span> Arsip</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3 col-xs-6">
            <a href="<?=base_url()?>kepemilikan">
                <div class="card menu border-bottom-warning">
                    <div class="card-body">
                        <div><i class="text-dark fas fa-building mb-3 mt-1" style=""></i></div>
                        <div class="text-dark font-weight-bold sml">Kepemilikan</div>

                        <!-- <img src="https://www.pngarts.com/files/6/User-Avatar-in-Suit-PNG.png" alt="" srcset=""
                        width="40px" class="my-3"> -->
                        <div class="text-dark sml"><span class="h4 font-weight-bold"><?=$kepemilikan?></span> Arsip</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3 col-xs-6">
            <a href="<?=base_url()?>datadiri">
                <div class="card menu border-bottom-warning">
                    <div class="card-body">
                        <div><i class="text-dark fas fa-id-badge mb-3 mt-1" style=""></i></div>
                        <div class="text-dark font-weight-bold sml">Data Diri</div>

                        <!-- <img src="https://www.pngarts.com/files/6/User-Avatar-in-Suit-PNG.png" alt="" srcset=""
                        width="40px" class="my-3"> -->
                        <div class="text-dark sml"><span class="h4 font-weight-bold"><?=$datadiri?></span> Arsip</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
   
</div>
<!-- /.container-fluid -->