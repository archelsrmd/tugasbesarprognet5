<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Help;
use App\Models\JenisAduan;

class Aduan extends Model
{
    use HasFactory;
    protected $table = 't_help_aduan';
    protected $primaryKey = "id";
    protected $fillable = [
        'pengadu_id',
        'jenis_aduan_id',
        'nomor',
        'tanggal',
        'aduan',
        'aduan_foto',
        'status_close'
        
    ];
    public function jenisaduan()
    {
        return $this->belongsTo(JenisAduan::class, 'jenis_aduan_id','id');
    }

    public function pengadu()
    {
        return $this->belongsTo(Help::class, 'pengadu_id','id');
    }
}

