@extends('layout.app')
@section('title', 'Data Peminjaman')
@section('content')
    <div class="container-barang">
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
                                @if ($item->id_status == '1' || $item->id_status == '5')
                                    <th scope="col" width="100px">Aksi</th>
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

                                @if ($item->id_status == '1')
                                    <td class="tess">
                                        <form action="/konfirmasi" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_pinjaman" value="{{ $item->id_pinjaman }}">
                                            <input type="hidden" name="aksi" value="terima">
                                            <button value="terima" class="editbarang"><i class="bi bi-check"></i></button>
                                        </form>
                                        <form action="/konfirmasi" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_pinjaman" value="{{ $item->id_pinjaman }}">
                                            <input type="hidden" name="aksi" value="tolak">
                                            <button class="hapusbarang"><i class="bi bi-x"></i></button>
                                        </form>
                                    </td>
                                @elseif($item->id_status == '5')
                                    <td class="tess">
                                        <form action="/konfirmasi" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_pinjaman" value="{{ $item->id_pinjaman }}">
                                            <input type="hidden" name="aksi" value="konfirmasipengembalian">
                                            <button value="terima" class="editbarang"><i class="bi bi-check"></i></button>
                                        </form>
                                    </td>
                                @else
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
