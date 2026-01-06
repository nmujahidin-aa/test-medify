<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterItem;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category_items';

    protected $guarded = [];

    public function masterItems()
    {
        return $this->belongsToMany(MasterItem::class, 'category_item_master_item', 'category_item_id', 'master_item_id');
    }
}
