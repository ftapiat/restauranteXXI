<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $number
 * @property boolean $is_taken
 */
class Table extends Model
{
    use HasFactory;

    protected $casts = [
        'is_taken' => 'boolean',
    ];
}
