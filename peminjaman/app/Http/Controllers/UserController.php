<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userindex()
    {
        $data = AdminModel::GetData('barang');
        return view('user.index', compact('data'));
    }
    public function userpinjaman()
    {
        $data = UserModel::joinData();
        return view('user.pinjaman', compact('data'));
    }
    public function useruser()
    {
        $data = AdminModel::GetDataIdUser('user');
        return view('user.user', compact('data'));
    }
    public function detailpinjaman(string $id)
    {
        $data['barang'] = AdminModel::GetData('barang')->where('id_barang', $id)->first();
        $data['user'] = AdminModel::GetDataIdUser('user');
        return view('user.detailpinjam', compact('data'));
    }
    public function tambahpeminjaman(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'id_user' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'jumlah' => 'required',
            'tanggalpinjam' => 'required',
            'tanggalkembali' => 'required',
            'foto' => 'required',
            'status' => 'required',
        ]);

        $jumlah_pinjaman = $request->jumlah; // Simpan jumlah pinjaman dari request

        // Mendapatkan stok barang dari ID barang yang diminta
        $stok_barang = UserModel::GetDataIdBarang('barang', $request->id_barang);

        // Memeriksa apakah stok mencukupi
        if ($jumlah_pinjaman > $stok_barang) {
            return redirect()->back()->with('error', 'Maaf, stok tidak cukup.');
        }

        // Jika stok mencukupi dan status pinjaman adalah 1
        if ($request->status == 1) {
            // Menyimpan data pinjaman ke dalam tabel pinjaman tanpa mengurangi stok
            DB::table('pinjaman')->insert([
                'id_barang' => $request->id_barang,
                'id_user' => $request->id_user,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'jumlahpinjaman' => $jumlah_pinjaman,
                'tanggalpinjam' => $request->tanggalpinjam,
                'tanggalkembali' => $request->tanggalkembali,
                'foto' => $request->foto,
                'id_status' => $request->status,
            ]);
        } else {
            // Jika status bukan 1 (sudah dikonfirmasi), maka kurangi stok barang
            // Mengurangi stok barang setelah memeriksa ketersediaannya
            $total_stok = $stok_barang - $jumlah_pinjaman;

            // Menyimpan data pinjaman ke dalam tabel pinjaman
            DB::table('pinjaman')->insert([
                'id_barang' => $request->id_barang,
                'id_user' => $request->id_user,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'jumlahpinjaman' => $jumlah_pinjaman,
                'tanggalpinjam' => $request->tanggalpinjam,
                'tanggalkembali' => $request->tanggalkembali,
                'foto' => $request->foto,
                'id_status' => $request->status,
            ]);

            // Mengupdate stok barang setelah berhasil menambahkan pinjaman
            DB::table('barang')->where('id_barang', $request->id_barang)->update(['stok' => $total_stok]);
        }

        return redirect()->route('userpinjaman');
    }

}
