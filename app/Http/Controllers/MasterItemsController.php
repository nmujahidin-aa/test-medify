<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MasterItemsController extends Controller
{

    protected $view;
    protected $masterItem;
    protected $category;

    public function __construct(){
        $this->view = 'master_items.';
        $this->masterItem = new MasterItem();
        $this->category = new Category();
    }
    public function index()
    {
        $category = $this->category::orderBy('nama')->get();
        $items = $this->masterItem::with('category')->orderBy('id', 'desc')->limit(5)->get();

        $data = [
            'category' => $category,
            'items' => $items,
        ];

        return view($this->view . 'index.index', $data);
    }

    public function search(Request $request)
    {
        $query = $this->masterItem::query();
        if($request->filled('kode')){
            $query->where('kode', $request->kode);
        }
        if($request->filled('nama')){
            $query->where('nama', $request->nama);
        }
        if($request->filled('hargamin')){
            $query->where('harga_beli', '>=', $request->hargamin);
        }
        if($request->filled('hargamax')){
            $query->where('harga_beli', '<=', $request->hargamax);
        }
        if($request->filled('categori_id')){
            $query->whereHas('category', function($q) use ($request){
                $q->where('category_item_id', $request->categori_id);
            });
        }

        $data = $query->select('kode', 'nama', 'jenis', 'harga_beli', 'laba', 'supplier')->orderBy('id', 'desc')->get();

        return json_encode([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function formView($method, $id = 0)
    {
        $category = $this->category::orderBy('nama')->get();
        if ($method == 'new') {
            $item = new $this->masterItem();
        } else {
            $item = $this->masterItem::with('category')->findOrFail($id);
        }

        $data = [
            'category' => $category,
            'item' => $item,
            'method' => $method,
        ];
        return view($this->view .'form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = $this->masterItem::where('kode', $kode)->firstOrFail();
        return view($this->view . 'single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        $validated = $request->validate([
            'nama'        => 'required',
            'harga_beli'  => 'required|numeric',
            'laba'        => 'required|numeric',
            'supplier'    => 'required',
            'jenis'       => 'required',
            'kategori_id' => 'nullable|array',
            'images'      => 'nullable|image|max:2048',
        ]);

        $item = $method === 'edit'
            ? $this->masterItem::findOrFail($id)
            : new $this->masterItem();

        if ($method === 'new') {
            $item->kode = str_pad(
                $this->masterItem::max('id') + 1,
                5,
                '0',
                STR_PAD_LEFT
            );
        }

        $item->fill([
            'nama'       => $validated['nama'],
            'harga_beli' => $validated['harga_beli'],
            'laba'       => $validated['laba'],
            'supplier'   => $validated['supplier'],
            'jenis'      => $validated['jenis'],
        ]);

        if ($request->hasFile('images')) {
            if ($method === 'edit'
                && $item->images
                && Storage::disk('public')->exists($item->images)
            ) {
                Storage::disk('public')->delete($item->images);
            }

            $item->images = $request
                ->file('images')
                ->store('master_items', 'public');
        }

        $item->save();

        if (!empty($validated['kategori_id'])) {
            $item->category()->sync($validated['kategori_id']);
        }

        return redirect('master-items')
            ->with('success', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        $item = $this->masterItem::findOrFail($id);
        $item->delete();
        return redirect()
            ->route('master-items.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach($data as $item)
        {
            $kode = $item->id;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100,1000000);
            $item->laba = rand(10,99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi','Bukulapuk','TokoBagas','E Commurz','Blublu'];
        $random = rand(0,4);
        return $array[$random];
    }

    private function getRandomJenis()
    {
        $array = ['Obat','Alkes','Matkes','Umum','ATK'];
        $random = rand(0,4);
        return $array[$random];
    }
}
