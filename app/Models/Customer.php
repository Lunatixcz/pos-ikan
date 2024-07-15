<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_konsumen',
        'jenis_kelamin',
        'alamat',
        'email',
        'total_transaksi',
    ];
}
