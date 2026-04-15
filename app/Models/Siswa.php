<?php

namespace App\Models;

use App\Models\InputAspirasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'nis';
    }

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}
