<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'master_items';

    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'harga_beli',
        'laba',
        'supplier',
        'kategori_id',
        'images',
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_item_master_item', 'master_item_id', 'category_item_id');
    }
}
