<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <?php
    if ($kategori=='semua') {
        $kategori='semua arsip';
    }
    else {
        $kategori='arsip '.$kategori;
    }
    ?>
            Hasil pencarian <b class="text-dark"><?=$kata?></b> dalam <b class="text-dark"><?=$kategori?></b>
        </div>
        <?php foreach($arsip as $row):?>
        <div class="col-xl-6 col-md-6 mb-2">
            <div class="card  ">
                <div class="card-body row">
                    <div class="w-20 mx-2 text-center">
                        <i class="fas fa-file-alt text-warning xxx-large"></i>
                    </div>
                    <div class="w-70">
                        <div class="text-dark small"><?=$row->nama_arsip?> <span
                                class="badge bg-warning ml-2"><?=$row->kategori?></span></div>
                        <?php if($row->ext=='.jpg' || $row->ext=='.jpeg' || $row->ext=='.png'):?>
                        <a class="small mr-2" href="<?=base_url()?>home/lihat/<?=$row->id_arsip?>">Lihat</a>
                        <?php endif;?>
                        <a class="small mr-2" href="<?=base_url()?>home/download/<?=$row->id_arsip?>">Download</a>
                        <a class="small mr-2" href="<?=base_url()?>home/edit/<?=$row->id_arsip?>">Edit</a>
                        <a download class="small" href="<?=base_url()?>home/hapus/<?=$row->id_arsip?>">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php if($count==0):?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="mb-5 text-dark font-weight-bold">Arsip tidak ditemukan</h5>
                    <img src="<?=base_url()?>assets/img/undraw_empty.svg" alt="" width="200px">
                    <div><a href="<?=base_url()?>" class="btn btn-warning sml mt-4 text-dark">Kembali ke Beranda</a>
                    </div>
                </div>

            </div>
        </div>
        <?php endif;?>
    </div>
</div>
<!-- /.container-fluid -->