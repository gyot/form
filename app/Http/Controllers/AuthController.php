<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\m_ref_users;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Buat tampilan login
    }

    public function lamanMasuk(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard'); // Redirect setelah login sukses
        // }

        // return back()->withErrors([
        //     'username' => 'Username atau password salah!',
        // ]);

         // Cek user berdasarkan email
         $user = m_ref_users::where('username', $request->username)->first();

         if (!$user) {
             return back()->withErrors(['username' => 'Email tidak ditemukan!']);
         }
 
         // Cek password menggunakan MD5
         if ($user->password === md5($request->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
         }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/laman-masuk');
    }
}
