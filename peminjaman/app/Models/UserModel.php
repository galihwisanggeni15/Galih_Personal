<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
    use HasFactory;
    public static function GetData($table)
    {
        return DB::table($table)->get();
    }
    public static function GetDataIdUser($table)
    {
        return DB::table($table)->where('id_user', session('id_user'))->first();
    }
    public static function GetDataIdBarang($table, $id)
    {
        return DB::table($table)->where('id_barang', $id)->value('stok');
    }

    public static function CreateData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    public static function joinData()
    {
        // Menjalankan query dan mengambil data
        $data = DB::table('pinjaman')
            ->join('user', 'user.id_user', '=', 'pinjaman.id_user')
            ->join('status', 'status.id_status', '=', 'pinjaman.id_status')
            ->join('barang', 'barang.id_barang', '=', 'pinjaman.id_barang')
            ->where('user.id_user', session('id_user'))
            ->get();

        return $data; // Mengembalikan hasil query
    }
}
