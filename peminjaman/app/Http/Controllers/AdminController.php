<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function adminindex()
    {
        return view('admin.index');
    }
    public function adminbarang()
    {
        $data = AdminModel::GetData('barang');
        return view('admin.barang', compact('data'));
    }
    public function admindata()
    {
        // Memanggil fungsi joinData() dari model
        $data = AdminModel::joinData();
        return view('admin.data', compact('data')); // Mengirimkan data ke view
    }

    public function adminuser()
    {
        $data = AdminModel::GetDataIdUser('user');
        return view('admin.user', compact('data'));
    }

    public function tambahbarang()
    {
        return view('admin/tambah');
    }
    public function tambahbarangsubmit(Request $request)
    {
        $request->validate([
            'barang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required',
        ]);

        $uploadPath = public_path('upload');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        $image = $request->file('foto');
        $imageName = $image->hashName();
        $image->move($uploadPath, $imageName);
        // Save barang details to the database
        DB::table('barang')->insert([
            'barang' => $request->barang,
            'deskripsi' => $request->deskripsi,
            'foto' => $imageName,
            'stok' => $request->stok,
        ]);

        // Redirect or perform any other action after saving
        return redirect('admin/barang');
    }
    public function hapusbarangsubmit(string $id)
    {
        // Retrieve the product data, including the image filename
        $barang = AdminModel::GetDataIdBarang('barang', $id);

        if (!$barang) {
            // barang not found
            return redirect()->back()->withErrors(['error' => 'barang not found']);
        }

        // Delete the record from the database
        // Delete the record from the database
        $delete = DB::table('barang')->where('id_barang', $id)->delete();

        if ($delete) {
            // If the barang has an associated image, delete the image file
            if ($barang->foto) {
                $imagePath = public_path('upload/' . $barang->foto);

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to delete barang']);
        }
    }
    public function editbarang(string $id)
    {
        $barang = AdminModel::GetDataIdBarang('barang', $id);
        return view('admin.editbarang', compact('barang'));
    }
    public function editbarangsubmit(Request $request, $id)
    {
        $request->validate([
            'barang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required',
        ]);
        $barang = AdminModel::GetDataIdBarang('barang', $id);
        // Check if a file has been uploaded
        if ($request->hasFile('foto')) {
            // Handle image upload
            $uploadPath = public_path('upload');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            // Delete the old image if it exists
            if ($barang->foto) {
                $oldImagePath = $uploadPath . '/' . $barang->foto;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('foto');
            $imageName = $image->hashName();
            $image->move($uploadPath, $imageName);

            // Update product details with the new image path
            DB::table('barang')->where('id_barang', $id)->update([
                'barang' => $request->barang,
                'deskripsi' => $request->deskripsi,
                'foto' => $imageName, // Save the image path to the database
                'stok' => $request->stok
            ]);
        } else {
            // Update product details without changing the image
            DB::table('barang')->where('id_barang', $id)->update([
                'barang' => $request->barang,
                'deskripsi' => $request->deskripsi,
                'stok' => $request->stok,
            ]);
        }
        return redirect()->route('adminbarang');
    }
    public function edituseradminsubmit(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'telephone' => 'required',
        ]);

        // Mengambil data pengguna dari database
        $user = AdminModel::GetDataIdUser('user');

        if (
            $request->nama != $user->nama ||
            $request->username != $user->username ||
            $request->email != $user->email ||
            $request->telephone != $user->telephone
        ) {
            // Mengupdate data pengguna jika ada perubahan
            AdminModel::UpdateDataIdUser('user', [
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'telephone' => $request->telephone,
            ]);

            // Redirect atau lakukan tindakan lain setelah berhasil memperbarui
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            // Jika data tetap sama, Anda bisa melakukan redirect tanpa melakukan pembaruan
            return redirect()->back()->with('info', 'No changes were made');
        }
    }
    public function konfirmasi(Request $request)
    {
        $request->validate([
            'id_pinjaman' => 'required',
            'aksi' => 'required',
        ]);

        $id_pinjam = $request->id_pinjaman;
        $pinjaman = AdminModel::GetDataIdPinjaman('pinjaman', $id_pinjam); // Memperbaiki pemanggilan fungsi
        $id_barang = $pinjaman->id_barang;
        $barang = AdminModel::GetDataIdBarang('barang', $id_barang); // Memperbaiki pemanggilan fungsi
        $tanggal_sekarang = date('Y-m-d');


        if ($pinjaman && $pinjaman->id_status == 1 && $request->input('aksi') == 'terima') {
            $total = $barang->stok - $pinjaman->jumlahpinjaman;
            AdminModel::UpdateDataIdUser('pinjaman', [
                'id_status' => '2'
            ]);
            AdminModel::UpdateDataIdBarang('barang', ['stok' => $total], $id_barang);


            // Redirect atau lakukan tindakan lain setelah berhasil memperbarui
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
        if ($pinjaman && $pinjaman->id_status == 1 && $request->input('aksi') == 'tolak') {
            AdminModel::UpdateDataIdUser('pinjaman', [
                'id_status' => '4'
            ]);

            // Redirect atau lakukan tindakan lain setelah berhasil memperbarui
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
        if ($pinjaman && $pinjaman->id_status == 5 && $request->input('aksi') == 'konfirmasipengembalian') {
            $totall = $barang->stok + $pinjaman->jumlahpinjaman;
            AdminModel::UpdateDataIdUser('pinjaman', [
                'id_status' => '3'
            ]);
            AdminModel::UpdateDataIdBarang('barang', ['stok' => $totall], $id_barang);

            // Redirect atau lakukan tindakan lain setelah berhasil memperbarui
            return redirect()->back()->with('success', 'Profile updated successfully');
        }

        // Jika status adalah 2 dan tombol kembalikan ditekan atau melewati tanggal
        if ($pinjaman && (
            ($pinjaman->id_status == 2 && $request->input('aksi') == 'pengembalian') ||
            ($pinjaman->tanggalpinjam < $tanggal_sekarang && $pinjaman->id_status == 1)
        )) {
            AdminModel::UpdateDataIdUser('pinjaman', [
                'id_status' => '5'
            ]);
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
    }
}
