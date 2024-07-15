<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga_ikan',
        'jumlah_ikan',
        'category',
    ];

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
