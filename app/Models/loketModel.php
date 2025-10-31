<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loketModel extends Model
{
    use HasFactory;

    protected $table = 'lokets';
    protected $fillable = ['nama', 'sedang_dipakai', 'petugas'];
}
