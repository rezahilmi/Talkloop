<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('forum');
        }

        return back()->withErrors([
            'email' => 'The provided cdentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
            'bio' => 'required|string',
            'umur' => 'required|numeric',
            'alamat' => 'required|string',
        ]);
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'biodata' => $request->bio,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
        ]);

        $request->session()->regenerate();
        Auth::login($user);

        return redirect()->intended('forum');
    }

    public function showProfil()
    {
        return view('profil');
    }

    public function updateProfil(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'biodata' => 'required|string',
            'umur' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        $user = User::findOrFail($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->biodata = $request->biodata;
        $user->umur = $request->umur;
        $user->alamat = $request->alamat;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }

    public function forum()
    {
        return view('forum');
    }
}
