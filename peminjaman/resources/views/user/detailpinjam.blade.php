@extends('layout.app2')
@section('title', 'Detail Pinjaman')
@section('content')
    <div class="container-detail">
        <center>
            <h1>Detail Barang</h1>
        </center>
        <div class="card">
            <div class="kiri">
                <img src="../upload/{{ $data['barang']->foto }}" alt="" width="100%">
                <div class="desk">
                    {{ $data['barang']->deskripsi }}
                </div>
            </div>
            <div class="kanan">
                <form action="/tambahpeminjaman" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="barang">Nama Barang</label><br>
                        <input type="text" value="{{ $data['barang']->barang }}" id="nama" readonly>
                        <input type="hidden" name="id_barang" value="{{ $data['barang']->id_barang }}" id="nama"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Peminjam</label><br>
                        <input type="text" value="{{ $data['user']->nama }}" id="nama" readonly>
                        <input type="hidden" value="{{ $data['user']->id_user }}" name="id_user">
                        <input type="hidden" value="{{ $data['barang']->foto }}" name="foto">
                        <input type="hidden" value="1" name="status">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Nomor Telephone Peminjam</label><br>
                        <input type="number" value="{{ $data['user']->telephone }}" name="telephone" id="telephone"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Peminjam</label><br>
                        <input type="email" value="{{ $data['user']->email }}" name="email" id="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Rumah</label><br>
                        <input type="text" name="alamat" id="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Pinjam</label><br>
                        <input type="number" name="jumlah" id="jumlah" required oninput="updateHarga()">
                    </div>
                    <div class="form-group">
                        <label for="tanggalpinjam">Tanggal Pinjam</label><br>
                        <input type="date" name="tanggalpinjam" id="tanggalpinjam" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggalkembali">Tanggal Kembali</label><br>
                        <input type="date" name="tanggalkembali" id="tanggalkembali" required>
                    </div>
                    <button type="submit">Pinjam</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function updateHarga() {
            // Ambil nilai jumlah barang
            var jumlahBarang = document.getElementById('jumlah').value;

            // Ambil stok barang dari PHP
            var stokBarang = <?php echo $data['barang']->stok; ?>;

            // Jika jumlah barang melebihi stok, tampilkan alert dan reset nilai jumlah
            if (jumlahBarang > stokBarang) {
                alert("Jumlah barang melebihi stok yang tersedia!");
                document.getElementById('jumlah').value = stokBarang; // Reset nilai jumlah ke stok maksimum
            }
        }
    </script>
@endsection
