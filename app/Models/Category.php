<?php

namespace App\Models;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'ket_category',
    ];

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'id_category', 'id_category');
    }

    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'id_category', 'id_category');
    }
}
