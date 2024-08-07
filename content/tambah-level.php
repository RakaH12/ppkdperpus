<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM level WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}
if (isset($_POST['simpan'])) {
    // jika param edit ada maka updet,selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    $nama_level = $_POST['nama_level'];
    $keterangan      = $_POST['keterangan'];


    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO level (nama_level, keterangan) VALUES ('$nama_level','$keterangan')");
        header("location:?pg=level&tambah=berhasil");
    } else {
        $update = mysqli_query($koneksi, "UPDATE level SET
        nama_level='$nama_level',
      keterangan = '$keterangan'
        WHERE id = '$id'
        ");
        header("location:?pg=level&edit=berhasil");
    }
    
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM level WHERE id = '$id';");
    header("location:?pg=level&hapus=berhasi");
}
?>
<div class="container MT-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data level</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="" class="from-label">Nama Level</label>
                            <input value="<?php echo ($rowEdit['nama_level'] ?? '') ?>" class="form-control" name="nama_level">
                        </div>
                        <div class="mb-3">
                            <label for="" class="from-label">keterangan</label>
                            <input value="<?php echo ($rowEdit['keterangan'] ?? '') ?> " class="form-control" name="keterangan">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" value="simpan">
                        </div>
                    </form>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>