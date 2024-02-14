@extends('layout.app')
@section('title', 'Tambah Data Barang')
@section('content')
    <div class="container-tambah">
        <div class="card">
            <div class="container-form">
                <center>
                    <h1>Tambah Data Barang</h1>
                </center>
                <form action="/tambahbarangsubmit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="barang">Nama Barang :</label><br>
                        <input type="text" name="barang" id="barang">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Barang :</label><br>
                        <textarea type="text" name="deskripsi" id="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Barang :</label><br>
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok Barang :</label><br>
                        <input type="number" name="stok" id="stok">
                    </div>
                    <center><button type="submit" name="simpan">Simpan</button></center>
                </form>
            </div>
        </div>
    </div>
@endsection
