<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}
if (isset($_POST['simpan'])) {
    // jika param edit ada maka updet,selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    $nama_lengkap = $_POST['nama_lengkap'];
    $email        = $_POST['email'];
    $password = sha1($_POST['password']);
    $id_level        = $_POST['id_level'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, email, password, id_level) VALUES ('$nama_lengkap','$email','$password','$id_level')");
        header("location:?pg=user&tambah=berhasil");
    } else {
        $update = mysqli_query($koneksi, "UPDATE user SET
        nama_lengkap='$nama_lengkap',
        email = '$email',
        id_level = '$id_level',
        password = '$password'
        WHERE id = '$id'
        ");
        header("location:?pg=user&edit=berhasil");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id';");
    header("location:?pg=user&hapus=berhasi");
}

$level = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");
// KODE TRANKSAKSI

$queryKodeTrans = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$rowKodeTrans = mysqli_fetch_assoc($queryKodeTrans);
$no_urut = $rowKodeTrans['id_transaksi'];
$no_urut++;

$kode_transaksi = "PJ" . date("dmy") . sprintf("%03s", $no_urut);

$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");
$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data Peminjaman</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Kode Transaksi</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="kode_transaksi" value="<?= ($kode_transaksi ?? '') ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Nama Anggota</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_anggota" id="" class="form-control">
                                    <option value="">Pilih Anggota</option>
                                    <?php while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)) : ?>
                                        <option value="<?php echo $rowAnggota['id'] ?>"><?php echo $rowAnggota['nama_lengkap'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Tanggal Pinjam</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tgl_pinjam" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Tanggal Kembali</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tgl_kembali" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Petugas</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="" value="<?= ($_SESSION['NAMA_LENGKAP'] ?? '') ?>" readonly>
                                <input type="hidden" class="form-control" name="id_user" value="<?= ($_SESSION['ID_USER'] ?? '') ?>">
                            </div>
                        </div>

                        <!--Get Data Kategori Buku dan buku -->
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Kategori</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    <option value="">Pilih kategori</option>
                                    <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)) : ?>
                                        <option value="<?php echo $rowKategoti['id'] ?>"><?php echo $rowKategori['nama_kategori'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Nama Buku</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_buku" id="id_buku" class="form-control">
                                    <option value="">Pilih Buku</option>
                                    <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)) : ?>
                                        <option value="<?php echo $rowBuku['id'] ?>"><?php echo $rowBuku['judul'] ?></option>
                                    <?php endwhile ?>
                                </select>

                    </form>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</div>