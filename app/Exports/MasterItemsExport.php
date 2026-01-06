<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MasterItemsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 1;

    public function collection()
    {
        return MasterItem::with('category')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Nama Item',
            'Nama Supplier',
            'Harga',
            'Laba (%)',
            'Harga Jual',
        ];
    }

    public function map($item): array
    {
        $kategori = $item->category
            ->pluck('nama')
            ->implode(', ');

        $hargaJual = $item->harga_beli
            + ($item->harga_beli * $item->laba / 100);

        return [
            $this->no++,
            $kategori,
            $item->nama,
            $item->supplier,
            $item->harga_beli,
            $item->laba,
            $hargaJual,
        ];
    }
}
