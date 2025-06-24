<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugProgressStep extends Model
{
    protected $fillable = [
        'product_id',
        'step_number',
        'sub_step_index',
        'sub_step_label',
        'department',
        'checked_at',
    ];

    public function drug()
    {
        return $this->belongsTo(Product::class);
    }
}
