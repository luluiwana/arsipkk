<div class="container-fluid">
    <div class="card">
        <div class="card-header p-w bg-dark text-white sml">
            Profil Saya
        </div>
        <form action="<?=base_url()?>home/profil" method="post">
            <div class="card-body">
                <div class="text-danger font-weight-bold sml"><?php echo validation_errors();?>
                </div>
                <div class="form-group">
                    <label for="" class="small">Nama</label>
                    <input type="text" class="form-control sml" name="nama" value="<?=$profil->nama?>" id="" required>
                </div>
                <div class="form-group">
                    <label for="" class="small">Nomor Hp/Telepon</label>
                    <input type="text" class="form-control sml" name="telp" value="<?=$profil->telp?>" id="" required>
                </div>
                <div class="form-group">
                    <label for="" class="small">Alamat</label>
                    <textarea class="form-control sml" name="alamat" required><?=$profil->alamat?></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="small">Kata Sandi</label>
                    <input type="text" class="form-control sml" name="nama" value="********" id="" disabled>
                    <a href="<?=base_url()?>home/password" class="small">Ubah Kata Sandi</a>
                </div>

                <input type="submit" class="btn btn-warning sml text-dark px-4 mt-2" value="Simpan">
            </div>
        </form>
    </div>

</div>