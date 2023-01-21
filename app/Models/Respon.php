<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    use HasFactory;
    protected $table = 't_help_aduan_respon';
    protected $primaryKey = "id";

    protected $fillable = [
        'aduan_id',
        'pengadu_id'
    ];
}
