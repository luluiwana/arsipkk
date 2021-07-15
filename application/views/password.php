<div class="container-fluid">
    <div class="card">
        <div class="card-header p-w bg-dark text-white sml">
            Profil Saya
        </div>
        <form action="<?=base_url()?>home/password" method="post">
            <div class="card-body">
                <div class="text-danger font-weight-bold sml"><?php echo validation_errors();?>
                </div>
                <div class="form-group">
                    <label for="" class="small">Masukkan Kata Sandi</label>
                    <input type="password" class="form-control sml" name="old_password" value="" id="" required>
                </div>
                 <div class="form-group">
                    <label for="" class="small">Buat Kata Sandi Baru</label>
                    <input type="password" class="form-control sml" name="new_password" value="" id="" required>
                </div>
                 <div class="form-group">
                    <label for="" class="small">Masukkan Lagi Kata Sandi Baru</label>
                    <input type="password" class="form-control sml" name="passconf" value="" id="" required>
                </div>
               

                <input type="submit" class="btn btn-warning sml text-dark px-4 mt-2" value="Ubah Password">
            </div>
        </form>
    </div>

</div>