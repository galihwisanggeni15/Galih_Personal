@extends('layout.app2')
@section('title', 'Data Peminjaman')
@section('content')
    <div class="container-pinjam">
        <div class="card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Barang</th>
                            <th>Nama</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Tanggal Pinjaman</th>
                            <th>Tanggal Kembali</th>
                            <th>Foto Barang</th>
                            <th>Status</th>
                            @foreach ($data as $item)
                                @if ($item->id_status == '2')
                                    <th>Aksi</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barang }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->telephone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->jumlahpinjaman }}</td>
                                <td>{{ $item->tanggalpinjam }}</td>
                                <td>{{ $item->tanggalkembali }}</td>
                                <td><img src="{{ asset('upload/' . $item->foto) }}" alt="" width="50px"
                                        style="text-align: left; display:block;"></td>
                                <td>{{ $item->status }}</td>
                                @if ($item->id_status == '2')
                                    <td>
                                        <form action="/konfirmasi" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_pinjaman" value="{{ $item->id_pinjaman }}">
                                            <input type="hidden" name="aksi" value="pengembalian">
                                            <button value="terima" class="editbarang"><i class="bi bi-check"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
