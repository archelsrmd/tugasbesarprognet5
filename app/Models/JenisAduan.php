<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAduan extends Model
{
    use HasFactory;
    protected $table = 'm_jenis_aduan';
    protected $primarykey = 'id';
    protected $fillable = [
        'jenis_aduan'
    ];
    
    public function aduan()
    {
        return $this->hasMany(Aduan::class);
    }
}
