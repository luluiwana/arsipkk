<div class="container-fluid">
    <div class="card">
        <div class="card-body p-2">
            <form action="<?=base_url()?>home/tambah__" method="post" enctype="multipart/form-data">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="small">Kategori</label>
                    <select name="kategori" id="" class="form-control" required>
                        <option value="">--Pilih Kategori--</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="keuangan">Keuangan</option>
                        <option value="kesehatan">Kesehatan</option>
                        <option value="kepemilikan">Kepemilikan</option>
                        <option value="datadiri">Data Diri</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="small">Nama Arsip</label>
                    <input type="text" name="nama_arsip" class="form-control " placeholder="Nama Arsip" required>
                </div>
                <div class="col-sm-6">
                    <label for="" class="small">Upload File</label>
                    <input type="file" name="file" class="form-control" placeholder="Last Name" required>
                </div>
                 <div class="col-sm-6">
                    <input type="submit" class="btn btn-warning text-dark sml mt-4 px-3" value="Simpan">
                </div>
                
            </form>
        </div>
    </div>

</div>