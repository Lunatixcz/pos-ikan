<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pembelian',
        'id_ikan',
        'quantity',
        'price',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'id_ikan');
    }
}
