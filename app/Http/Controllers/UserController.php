<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // // coba akses model UserModel
        // $user = UserModel::all(); // ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);

        // // tambah data user dengan Eloquent Model
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];

        // UserModel::insert($data); // tambahkan data ke tabel m_user

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];

        // UserModel::where('username', 'customer-1')->update($data); // update data ke tabel m_user

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data); // tambahkan data ke tabel m_user

        // coba akses model UserModel
        // $user = UserModel::all(); // ambil semua data dari tabel m_user
        // $user = UserModel::find(1); // ambil data user dengan user_id = 1
        // $user = UserModel::where('level_id', 1)->first(); // ambil data user dengan level_id = 1
        // $user = UserModel::firstWhere('level_id', 1); // ambil data user dengan level_id = 1
        // $user = UserModel::findOr(1, ['username', 'nama'], function() {
        //     abort(404);
        // });
        // $user = UserModel::findOr(20, ['username', 'nama'], function() {
        //     abort(404);
        // });
        // $user = UserModel::findOrFail(1); // ambil data user dengan user_id = 1, jika tidak ada data maka tampilkan error 404
        // $user = UserModel::where('username', 'manager9')->firstOrFail(); // ambil data user dengan username = manager9, jika tidak ada data maka tampilkan error 404
        // $user = UserModel::where('level_id', 2)->count();
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager'
        //     ],
        // ); // ambil data user dengan username = manager, jika tidak ada data maka tambahkan data baru
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save(); // simpan data user ke tabel m_user
        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Manager55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ]);

        // $user->username = 'manager56';
        
        // $user->isDirty(); // cek apakah ada perubahan data
        // $user->isDirty('username'); // cek apakah ada perubahan data pada kolom username, return true
        // $user->isDirty('nama'); // cek apakah ada perubahan data pada kolom nama, return false
        // $user->getDirty(['nama', 'username']); // ambil data perubahan pada kolom nama dan username, return true

        // $user->isClean(); // cek apakah tidak ada perubahan data, return false
        // $user->isClean('username'); // cek apakah tidak ada perubahan data pada kolom username, return false
        // $user->isClean('nama'); // cek apakah tidak ada perubahan data pada kolom nama, return true
        // $user->isClean(['nama', 'username']); // cek apakah tidak ada perubahan data pada kolom nama dan username, return false

        // $user->save(); // simpan data user ke tabel m_user 

        // $user->isDirty(); // cek apakah ada perubahan data, return false    
        // $user->isClean(); // cek apakah tidak ada perubahan data, return true
        // dd($user->getDirty()); // ambil data perubahan, return array kosong

        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ]);

        $user->username = 'manager12';
        $user->save();

        $user->wasChanged(); // cek apakah ada perubahan data, return true
        $user->wasChanged('username'); // cek apakah ada perubahan data pada kolom username, return true
        $user->wasChanged('nama'); // cek apakah ada perubahan data pada kolom nama, return false
        dd($user->wasChanged(['nama', 'username'])); // cek apakah ada perubahan data pada kolom nama dan username, return true

        return view('user', ['data' => $user]);
    }
}
