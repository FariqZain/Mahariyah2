
<section class="content">
    <div class="card card-primary">
        <div class="card-body">
            <center>
                <h4>Data Tim</h4>
            </center>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Lihat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$no = 1;
$upload_dir = './dist/down/';
$sql = $koneksi->query("SELECT * FROM tim");

while ($data = $sql->fetch_assoc()) {
    ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>



                                    <td>
                                    <img src="<?php echo $data['gambar']; ?>" alt="Foto Tim" style="max-width: 200px; margin-top: 10px;">
                                    </td>

                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a type="button" class="btn btn-primary" href="<?php echo $base_url ?>?page=v_tim">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>

                                    <a class="btn btn-google-plus" href="?page=edit_tim&kode=<?php echo $data['id']; ?>">Ubah</a>
                                    <a class="btn btn-google-plus" href="?page=delet_tim&kode=<?php echo $data['id']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')">Hapus</a>

                                    </td>
                                </tr>

                            <?php
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card card-primary">
    <div class="card-header">
        <h3>Form Tambah Konten Tim</h3>
    </div>
        <div class="card-body">

        <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id">
        <div class="form-group">
            <label for="nama">nama:</label>
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="form-group">
        <label for="gambar">Foto:</label>
        <input class="form-control"type="file" id="gambar" name="gambar"onchange="updateFileName(this)">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" cols="50"></textarea>
        </div>

        <div class="form-group">
            <label for="sosmed_ig">Instagram:</label>
            <input type="text" class="form-control" id="sosmed_ig" name="sosmed_ig">
        </div>
        <div class="form-group">
            <label for="sosmed_fb">Facebook:</label>
            <input type="text" class="form-control" id="sosmed_fb" name="sosmed_fb">
        </div>
        <div class="form-group">
            <label for="sosmed_wa">WhatsApp:</label>
            <input type="text" class="form-control" id="sosmed_wa" name="sosmed_wa" placeholder="Nomor WA +62xxxxx ">
        </div>
        <div class="form-group">
            <label for="sosmed_ln">LinkedIn:</label>
            <input type="text" class="form-control" id="sosmed_ln" name="sosmed_ln">
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="Simpan" value="Simpan">Simpan</button>
        </div>
    </form>
        </div>
    </div>
</section>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<?php

if (isset($_POST['Simpan'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $sosmed_ig = $_POST['sosmed_ig'];
    $sosmed_wa = $_POST['sosmed_wa'];
    $sosmed_fb = $_POST['sosmed_fb'];
    $sosmed_ln = $_POST['sosmed_ln'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $upload_dir = './dist/down/';
    $file_path = $upload_dir . $gambar;

    // Pindahkan file yang di-upload ke direktori yang ditentukan
    if (move_uploaded_file($gambar_tmp, $file_path)) {
        // Query SQL untuk menyimpan data
        $sql_simpan = "INSERT INTO tim (nama, deskripsi, gambar, sosmed_ig, sosmed_wa, sosmed_fb, sosmed_ln) VALUES (
            '$nama',
            '$deskripsi',
            '$file_path',
            '$sosmed_ig',
            '$sosmed_wa',
            '$sosmed_fb',
            '$sosmed_ln'
        )";

        // Eksekusi query
        $query_simpan = mysqli_query($koneksi, $sql_simpan);

        // Cek apakah query berhasil dijalankan
        if ($query_simpan) {
            echo "<script>
                Swal.fire({
                    title: 'Tambah Data Berhasil',
                    text: '',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value){
                        window.location = '$base_url?page=tim'; // Perhatikan variabel $base_url
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Tambah Data Gagal',
                    text: '',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value){
                        window.location = '$base_url?page=tim'; // Perhatikan variabel $base_url
                    }
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan saat mengupload gambar',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value){
                    window.location = '$base_url?page=tim'; // Perhatikan variabel $base_url
                }
            });
        </script>";
    }
    // Tutup koneksi
    mysqli_close($koneksi);
}
?>

<script>
    function updateFileName(input) {
        var gambar = input.files[0].name;
        document.getElementById('gambar').value = gambar;
    }
</script>
