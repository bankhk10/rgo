<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'registration_number',
        'registration_date',
        'expiry_date',
        'progress',
        'description',
        'company',
        'status',
        'is_active',
        'is_deleted', // Although softDeletes handles this, sometimes good to have in fillable if you manually toggle
        'image',
        'document',
        'remarks',
        'new_or_old',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'registration_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'new_or_old' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password', // Example: if you had sensitive data you wanted to hide
    ];
}
