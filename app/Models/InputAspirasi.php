<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Aspirasi;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'nis',
        'id_category',
        'lokasi',
        'ket',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'id_pelaporan');
        // hasOne = 1 data di tabel inputaspirasi punya 1 data di tabel aspirasi
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
