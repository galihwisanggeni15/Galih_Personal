@extends('layout.app')
@section('title', 'Data Barang')
@section('content')
    <div class="container-barang">
        <div class="card">
            <a href="/tambahbarang" class="tambahdatabtn"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
            <div class="container-table">
                <table border="1">
                    <thead>
                        <tr>
                            <th width= "50px">No</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi Barang</th>
                            <th>Foto Barang</th>
                            <th width="100px">Stok Barang</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barang }}</td>
                                <td style="text-align: left;">{{ $item->deskripsi }}</td>
                                <td><img src="../upload/{{ $item->foto }}" alt="" width="50px"></td>
                                <td>{{ $item->stok }}</td>
                                <td><a href="/editbarang/{{ $item->id_barang }}" class="editbarang"><i
                                            class="bi bi-pencil"></i></a> || <a href="/hapusbarang/{{ $item->id_barang }}"
                                        class="hapusbarang"><i class="bi bi-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
