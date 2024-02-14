<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class register extends Model
{
    use HasFactory;
    public static function GetData($table)
    {
        return DB::table($table)->get();
    }

    public static function InsertData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    
}
