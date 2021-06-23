<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <?php foreach($arsip as $row):?>
        <div class="col-xl-6 col-md-6 mb-2">
            <div class="card  ">
                <div class="card-body row">
                    <div class="w-20 mx-2 text-center">
                        <i class="fas fa-file-alt text-warning xxx-large"></i>
                    </div>
                    <div class="w-70">
                        <div class="text-dark small"><?=$row->nama_arsip?></div>
                        <?php if($row->ext=='.jpg' || $row->ext=='.jpeg' || $row->ext=='.png'):?>
                        <a class="small mr-2" href="<?=base_url()?>home/lihat/<?=$row->id_arsip?>">Lihat</a>
                        <?php endif;?>
                        <a class="small mr-2" href="<?=base_url()?>home/download/<?=$row->id_arsip?>">Download</a>
                        <a class="small" href="<?=base_url()?>home/edit/<?=$row->id_arsip?>">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<!-- /.container-fluid -->