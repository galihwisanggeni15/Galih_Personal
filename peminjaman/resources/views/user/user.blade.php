@extends('layout.app2')
@section('title', 'Data User')
@section('content')
    <div class="container-tambah">
        <div class="card">
            <div class="container-form">
                <center>
                    <h1>User</h1>
                </center>
                <form action="/edituseradminsubmit" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap :</label><br>
                        <input type="text" value="{{ $data->nama }}" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="username">username Lengkap :</label><br>
                        <input type="text" value="{{ $data->username }}" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="email">email Lengkap :</label><br>
                        <input type="email" value="{{ $data->email }}" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="telephone">telephone Lengkap :</label><br>
                        <input type="number" value="{{ $data->telephone }}" name="telephone" id="telephone">
                    </div>
                    <center><button type="submit" name="simpan">Simpan</button></center>
                </form>
            </div>
        </div>
    </div>
@endsection
