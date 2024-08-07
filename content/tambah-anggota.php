<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

if (isset($_POST['simpan'])) {
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    $nama_lengkap = $_POST['nama_lengkap'];
    $nisn = $_POST['nisn'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_tlp = $_POST['no_tlp'];
    $alamat =$_POST['alamat'];
    
    

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO anggota (nama_lengkap, nisn, jenis_kelamin, alamat, no_tlp ) VALUES ('$nama_lengkap', '$nisn', '$jenis_kelamin', '$alamat','$no_tlp')");
        header("location:?pg=anggota&tambah=berhasil");
    } else {
        $update = mysqli_query($koneksi, "UPDATE anggota SET nisn = '$nisn', nama_lengkap = '$nama_lengkap', no_tlp = '$no_tlp', jenis_kelamin = '$jenis_kelamin' WHERE id = '$id'");
        header("location:?pg=anggota&edit=berhasil");
    }

    
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM anggota WHERE id = '$id'");
    header("location:?pg=anggota&hapus=berhasil");
}

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Tambah anggota</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">nisn</label>
                            <input type="text" class="form-control" name="nisn" value="<?= $rowEdit['nisn'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">nama lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="<?= $rowEdit['nama_lengkap'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">jenis kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="">-- jenis kelamin--</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">no tlp</label>
                            <input type="text" class="form-control" name="no_tlp" value="<?= $rowEdit['no_tlp'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?= $rowEdit['alamat'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>