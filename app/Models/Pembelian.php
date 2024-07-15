<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pembelian',
        'id_supplier',
        'total_transaksi',
        'id_admin',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pembelian) {
            $pembelian->id_pembelian = 'PB/' . now()->format('md') . '/' . static::generateUniqueNumber();
        });
    }

    private static function generateUniqueNumber()
    {
        $lastTransaction = static::whereDate('created_at', today())->latest()->first();

        if (!$lastTransaction) {
            return '01';
        }

        $lastNumber = intval(Str::afterLast($lastTransaction->id_pembelian, '/'));
        $currentNumber = $lastNumber + 1;
        return sprintf('%02d', $currentNumber);
    }

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
