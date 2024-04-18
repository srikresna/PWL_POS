<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LevelModel;


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

        // $user = UserModel::create([
        //     'username' => 'manager11',
        //     'nama' => 'Manager11',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ]);

        // $user->username = 'manager12';
        // $user->save();

        // $user->wasChanged(); // cek apakah ada perubahan data, return true
        // $user->wasChanged('username'); // cek apakah ada perubahan data pada kolom username, return true
        // $user->wasChanged('nama'); // cek apakah ada perubahan data pada kolom nama, return false
        // dd($user->wasChanged(['nama', 'username'])); // cek apakah ada perubahan data pada kolom nama dan username, return true

        // $user = UserModel::with('level')->get(); // ambil semua data user dengan relasi level
        // // dd($user);
        // return view('user', ['data' => $user]);

        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(StorePostRequest $request): RedirectResponse
    {
        // UserModel::create([
        //     'username' => $request->username,
        //     'nama'=> $request->nama,
        //     'password' => Hash::make($request->password),
        //     'level_id' => $request->level_id
        // ]);

        $validated = $request->validated();

        $validated = $request->safe()->only([
            'username',
            'nama',
            'password',
            'level_id'
        ]);
        $validated = $request->safe()->except([
            'username',
            'nama',
            'password',
            'level_id'
        ]);

        UserModel::create($validated);

        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;

        $user->save();
        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }

    // Retrieve user data in json form for datatables 
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btninfo btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '"> ' . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object)[
            'title' => "Detail User"
        ];

        $activeMenu = 'user';

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,
            'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => "Edit User"
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,
            'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,'. $id .',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|string|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditermukan');
        }

        try {
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect('/user')->with('error', 'Data user gagal dihapus, karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

