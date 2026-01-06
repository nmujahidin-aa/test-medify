<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MasterItem;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CategoryItemsController extends Controller
{

    protected $view;
    protected $category;
    protected $masterItem;

    public function __construct(){
        $this->view = 'category_items.';
        $this->category = new Category();
        $this->masterItem = new MasterItem();
    }

    public function index()
    {
        $category = $this->category::orderBy('nama')->get();

        $data['category'] = $category;
        return view($this->view.'index.index', $data);
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = $this->category::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('kode', 'nama')->orderBy('id')->get();

        $data['categoryItems'] = $data_search;
        return view($this->view.'index', $data);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = new $this->category();
        } else {
            $item = $this->category::find($id);
        }
        
        $data = [
            'method' => $method,
            'item' => $item,
        ];

        return view($this->view.'form.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $item = $method === 'edit' ? $this->category::find($id) : new $this->category();
        if($method === 'new'){
            $item->kode = str_pad($this->category::count('id') + 1, 5, '0', STR_PAD_LEFT);
        }

        $item->fill($validated);
        $item->save();

        return redirect()->route('category-items.index')->with('success', 'Category item saved successfully.');
    }

    public function singleView($kode)
    {
        $data['data'] = $this->category::where('kode', $kode)->with('masterItems')->firstOrFail();
        return view($this->view . 'single.index', $data);
    }

    public function delete($id)
    {
        $item = $this->category::findOrFail($id);
        $item->delete();
        return redirect()
            ->route('category-items.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function print($id)
    {
        $category = Category::with('masterItems')->findOrFail($id);

        $data = [
            'category' => $category,
            'items' => $category->masterItems,
            'printed_at' => now()->format('d-m-Y H:i:s'),
        ];

        $pdf = Pdf::loadView('category_items.single.print', $data)
                ->setPaper('A4', 'portrait');

        return $pdf->download(
            'kategori-'.$category->kode.'.pdf'
        );
    }
}