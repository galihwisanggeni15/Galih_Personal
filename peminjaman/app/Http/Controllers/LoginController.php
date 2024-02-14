<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function registrasihome()
    {
        return view('login');
    }
    public function loginhome()
    {
        return view('login');
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $existingUser = DB::table('user')->where('username', $validatedData['username'])
            ->orWhere('telephone', $validatedData['telephone'])
            ->orWhere('email', $validatedData['email'])
            ->first();
        if ($existingUser) {
            // Display a JavaScript alert and stay on the same page
            return redirect()->back()->withErrors(['error' => ''])
                ->withInput()
                ->with('sudahada', true);
        }
        if (strlen($validatedData['password']) < 6) {
            return redirect()->back()->withErrors(['error' => ''])
                ->withInput()
                ->with('showp', true);
        }
        DB::table('user')->insert([
            'nama' => $validatedData['nama'],
            'username' => $validatedData['username'],
            'email' => $validatedData['username'],
            'telephone' => $validatedData['telephone'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'user'
        ]);
        // Redirect to a success page or perform any other necessary actions
        return redirect()->route('registrasihome')->with('loginAlert', true);
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = DB::table('user')
            ->where('username', $request['username'])
            ->first(); // Menggunakan first() karena ingin mendapatkan satu baris data saja

        if ($user) {
            $role = $user->role;
            if ($role == 'admin') {
                session(['username' => $user->username]);
                session(['id_user' => $user->id_user]);
                return redirect('admin/index');
            } else {
                session(['username' => $user->username]);
                session(['id_user' => $user->id_user]);
                return redirect('user/index');
            }
        } else {
            return redirect()->back()->withErrors(['error' => ''])
                ->withInput()
                ->with('loginsalah', true);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('loginhome');
    }
}
