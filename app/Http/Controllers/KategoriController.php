<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Contracts\View\View;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    // Show the form to create a new post
    public function create(): View
    {
        return view('kategori.create');
    }


    // Store a new post
    public function store(StorePostRequest $request): RedirectResponse
    {

        // To do so, assign a bail rule to the attribute: try adjusting it to the field on the m_kategori. What happened?
        // $validated = $request->validateWithBag('category', [
        //     'kategori_kode' => 'bail|required|unique:m_kategori|max:255', // 'bail' stops validation on the first failure
        //     'kategori_nama' => 'required',
        // ]);
        // ANSWER : The validation will stop on the first failure, so if the kategori_kode is not unique, the validation will stop and the error message will be displayed.
        // 5.	Write the difference in using validate with validateWithBag!
        // ANSWER : validateWithBag will store the error message in the session, so it can be displayed in the view. While validate will return the error message in the response.
        // The post is valid...

        $validated = $request->validated();
        
        $validated = $request->safe()->only([
            'kategori_kode',
            'kategori_nama'
        ]);
        $validated = $request->safe()->except([
            'kategori_kode',
            'kategori_nama'
        ]);


        // KategoriModel::create([
        //     'kategori_kode' => $validated['kategori_kode'],
        //     'kategori_nama' => $validated['kategori_nama']
        // ]);

        return redirect('/kategori');
    }

    // public function create()
    // {
    //     return view('kategori.create');
    // }

    // public function  store(Request $request)
    // {
    //     KategoriModel::create([
    //         'kategori_kode' => $request->kodeKategori,
    //         'kategori_nama' => $request->namaKategori
    //     ]);
    //     return redirect('/kategori');
    // }

    public function update($id)
    {
        $data = KategoriModel::find($id);
        return view('kategori.update', ['kategori' => $data]);
    }

    public function update_save(Request $request, $id)
    {
        $data = KategoriModel::find($id);
        $data->kategori_kode = $request->kodeKategori;
        $data->kategori_nama = $request->namaKategori;
        $data->save();

        return redirect('/kategori');
    }

    public function delete($id)
    {
        $data = KategoriModel::find($id);
        $data->delete();

        return redirect('/kategori');
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
