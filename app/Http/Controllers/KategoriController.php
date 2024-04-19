<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // public function index(KategoriDataTable $dataTable)
    // {
    //     return $dataTable->render('kategori.index');
    // }

    // // Show the form to create a new post
    // public function create(): View
    // {
    //     return view('kategori.create');
    // }


    // // Store a new post
    // public function store(StorePostRequest $request): RedirectResponse
    // {

    //     // To do so, assign a bail rule to the attribute: try adjusting it to the field on the m_kategori. What happened?
    //     // $validated = $request->validateWithBag('category', [
    //     //     'kategori_kode' => 'bail|required|unique:m_kategori|max:255', // 'bail' stops validation on the first failure
    //     //     'kategori_nama' => 'required',
    //     // ]);
    //     // ANSWER : The validation will stop on the first failure, so if the kategori_kode is not unique, the validation will stop and the error message will be displayed.
    //     // 5.	Write the difference in using validate with validateWithBag!
    //     // ANSWER : validateWithBag will store the error message in the session, so it can be displayed in the view. While validate will return the error message in the response.
    //     // The post is valid...

    //     $validated = $request->validated();
        
    //     $validated = $request->safe()->only([
    //         'kategori_kode',
    //         'kategori_nama'
    //     ]);
    //     $validated = $request->safe()->except([
    //         'kategori_kode',
    //         'kategori_nama'
    //     ]);

    //     KategoriModel::create($validated);

    //     return redirect('/kategori');
    // }

    // // public function create()
    // // {
    // //     return view('kategori.create');
    // // }

    // // public function  store(Request $request)
    // // {
    // //     KategoriModel::create([
    // //         'kategori_kode' => $request->kodeKategori,
    // //         'kategori_nama' => $request->namaKategori
    // //     ]);
    // //     return redirect('/kategori');
    // // }

    // public function update($id)
    // {
    //     $data = KategoriModel::find($id);
    //     return view('kategori.update', ['kategori' => $data]);
    // }

    // public function update_save(Request $request, $id)
    // {
    //     $data = KategoriModel::find($id);
    //     $data->kategori_kode = $request->kodeKategori;
    //     $data->kategori_nama = $request->namaKategori;
    //     $data->save();

    //     return redirect('/kategori');
    // }

    // public function delete($id)
    // {
    //     $data = KategoriModel::find($id);
    //     $data->delete();

    //     return redirect('/kategori');
    // }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';

        return view('category.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('action', function ($kategori) {
                $btn = '<a href="'.url('/category/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/category/' . $kategori->kategori_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/category/'.$kategori->kategori_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure to delete this data?\');">Delete</button></form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah Kategori']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('category.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required',
            'kategori_nama' => 'required'
        ]);

        KategoriModel::create($request->all());

        return redirect('/category')->with('status', 'Data kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';

        return view('category.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';

        return view('category.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required',
            'kategori_nama' => 'required'
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        
        ]);

        return redirect('/category')->with('status', 'Data kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);

        if (!$check) {
            return redirect('/category')->with('error', 'Data kategori tidak ditemukan!');
        }

        try {
            $check->delete();
            return redirect('/category')->with('status', 'Data kategori berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/category')->with('error', 'Data kategori gagal dihapus!');
        }
    }
}
    // {
    //     // $data = [
    //     //     'kategori_kode' => 'SNK',
    //     //     'kategori_nama' => 'Snack/Makanan Ringan',
    //     //     'created_at' => now()
    //     // ];
    //     // DB::table('m_kategori')->insert($data);
    //     // return 'Insert data baru berhasil';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
    //     // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
    //     // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

    //     $data = DB::table('m_kategori')->get();
    //     return view('kategori', ['data' => $data]);
    // }
