@extends('layout.app2')
@section('title', 'Beranda')
@section('content')
    <div class="container-index">
        <center>
            <h1>Barang Siap Dipinjam</h1>
        </center>
        <div class="container-barang">
            @foreach ($data as $item)
            <div class="card">
                <img src="../upload/{{$item->foto}}"
                    width="230px" height="200px" alt="">
                <div class="text">
                    <table>
                        <tbody>
                            <tr>
                                <th style="text-align: left;">Nama Barang</th>
                                <th>:</th>
                                <td>{{$item->barang}}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Stok Barang</th>
                                <th>:</th>
                                <td>{{$item->stok}}</td>
                            </tr>
                        </tbody>
                    </table><br>
                    <a href="/detailpinjaman/{{$item->id_barang}}">Pinjam Barang</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
