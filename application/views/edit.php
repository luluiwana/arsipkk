<div class="container-fluid">
    <div class="card">
        <div class="card-body p-2">
            <form action="<?=base_url()?>home/edit__" method="post" enctype="multipart/form-data">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="small">Kategori</label>
                    <select name="kategori" id="" class="form-control"  required>
                    <?php $k = $arsip->kategori; $s='selected';?>
                        <option value="">--Pilih Kategori--</option>
                        <option value="pendidikan" <?php if($k=='pendidikan'){echo $s; }?> >Pendidikan</option>
                        <option value="keuangan" <?php if($k=='keuangan'){echo $s; }?>>Keuangan</option>
                        <option value="kesehatan" <?php if($k=='kesehatan'){echo $s; }?>>Kesehatan</option>
                        <option value="kepemilikan" <?php if($k=='kepemilikan'){echo $s; }?>>Kepemilikan</option>
                        <option value="datadiri" <?php if($k=='datadiri'){echo $s; }?>>Data Diri</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="small">Nama Arsip</label>
                    <input type="text" name="nama_arsip" value="<?=$arsip->nama_arsip?>" class="form-control " placeholder="Nama Arsip" required>
                </div>
                <div class="col-sm-6">
                    <label for="" class="small">Upload File</label>
                    <input type="file" name="file" class="form-control" placeholder="Last Name">
                </div>
                <input type="hidden" name="id" value="<?=$arsip->id_arsip?>">
                 <div class="col-sm-6">
                    <input type="submit" class="btn btn-warning text-dark sml mt-4 px-3" value="Simpan">
                </div>
                
            </form>
        </div>
    </div>

</div>