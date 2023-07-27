<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container {
            max-width: 900px;
            min-width: 200px;
        }
    </style>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container">
        <!-- CARD -->
        <div class="card">
        <div class="card-header bg-muted text-black text-center">
            Pendataan Mahasiswa
        </div>
        <div class="card-body">
            <!-- LOKASI TEKS PENCARIAN -->
            <!-- <form action="" method="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                </div>
            </form> -->

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Tambah Data Mahasiswa
            </button>
            <!-- btn-sm berguna agar buttonnya jadi lebih kecil-->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pendataan Mahasiswa</h5>
                    <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <!-- Jika gagal masukkan data -->
                <div class="alert alert-danger gagal" role="alert" style="display: none;"></div>
                <!-- Jika suskes masukkan data -->
                <div class="alert alert-success sukses" role="alert" style="display: none;"></div>

                <!-- INPUT DATA -->
                <input type="hidden" id="inputId">
                    <div class="mb-3 row">
                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputJurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select id="inputJurusan" class="form-select">
                                <option value="Informatika">Informatika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Manajemen Informasi">Manajemen Informasi</option>
                                <option value="Teknik Komputer">Teknik Komputer</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputNohp" class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNohp">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button> <!-- id tombolSimpan berfungsi agar diketahui oleh "mesin" bahwa ada aksi simpan yang dilakukan -->
                </div>
                </div>
            </div>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Nomor HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($dataMahasiswa as $k => $v){
                            $nomor = $nomor+1;
                    ?>
                    <tr>
                        <td><?php echo $nomor ?></td>
                        <td><?php echo $v['nama'] ?></td>
                        <td><?php echo $v['email'] ?></td>
                        <td><?php echo $v['jurusan'] ?></td>
                        <td><?php echo $v['nohp'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $v['id'] ?>)">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $v['id'] ?>)">Hapus</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            $linkPagination = $pager->links();
            $linkPagination = str_replace('<li class="active">', '<li class="page-item active">', $linkPagination);
            $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
            $linkPagination = str_replace("<a", "<a class='page-link'", $linkPagination);
            echo $linkPagination;
            ?>
        </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> <!-- Tampilan mahasiswa_view -->

    <script>
        // untuk hapus data
        function hapus($id){
            var result = confirm('Apakah anda yakin untuk menghapus data ini?');
            if (result){
                window.location="<?php echo site_url("mahasiswa/hapus") ?>/"+ $id;
            }
        }

        // untuk edit data
        function edit($id) {
            $.ajax({
                url: "<?php echo site_url("mahasiswa/edit") ?>/" + $id,
                type: "get",
                success: function(hasil) {
                    var $obj = $.parseJSON(hasil);
                    if ($obj.id != '') {
                        $('#inputId').val($obj.id);
                        $('#inputNama').val($obj.nama);
                        $('#inputEmail').val($obj.email);
                        $('#inputJurusan').val($obj.jurusan);
                        $('#inputNohp').val($obj.nohp);
                    }
                }

            });
        }

        // biar kalau ada data baru, pagenya lgsg keload
        function bersihkan(){
            $('#inputId').val('');
            $('#inputNama').val('');
            $('#inputEmail').val('');
            $('#inputNohp').val('');
        }
        $('.tombol-tutup').on('click', function(){
            if($('.sukses').is(":visible")){
                window.location.href = "<?php echo current_url()."?".$_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        })

        $('#tombolSimpan').on('click', function()/* # beguna buat manggil id yang ada di html, kalau manggil class pake . */{
            // alert('telah diklik');
            var $id = $('#inputId').val();
            var $nama = $('#inputNama').val();
            var $email = $('#inputEmail').val();
            var $jurusan = $('#inputJurusan').val();
            var $nohp = $('#inputNohp').val();

            $.ajax({
                url: "<?php echo site_url("mahasiswa/simpan") ?>", /* alamat url php apa yang akan diakses */
                type: "POST",
                data: {
                    id: $id,
                    nama: $nama,
                    email: $email,
                    jurusan: $jurusan,
                    nohp: $nohp,
                },
                success: function(hasil){
                    var $obj = $.parseJSON(hasil);
                    if ($obj.sukses == false){
                        $('.sukses').hide();
                        $('.gagal').show();
                        $('.gagal').html($obj.gagal);
                    } else {
                        $('.gagal').hide();
                        $('.sukses').show();
                        $('.sukses').html($obj.sukses);
                    }
                }
            });
            bersihkan();
        }) ;
    </script>
</body>

</html>