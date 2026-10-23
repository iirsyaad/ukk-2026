<?php

namespace App\Models;

use Sakuci\Database\Model;

class Kategori extends Model
{
    protected static ?string $table = 'kategori';
    protected string $primaryKey = 'id_kategori';
    protected array $fillable = ['nama_kategori', 'kode_kategori', 'keterangan','id_kategori'];

    public function alat()
    {
        return $this->hasMany(Alat::class, 'id_kategori', 'id_kategori');
    }
}
