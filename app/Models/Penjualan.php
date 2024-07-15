<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penjualan',
        'id_customer',
        'total_penjualan',
        'id_admin',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($penjualan) {
            $penjualan->id_penjualan = 'PJ/' . now()->format('md') . '/' . static::generateUniqueNumber();
        });
    }

    private static function generateUniqueNumber()
    {
        $lastTransaction = static::whereDate('created_at', today())->latest()->first();

        if (!$lastTransaction) {
            return '01';
        }

        $lastNumber = intval(Str::afterLast($lastTransaction->id_penjualan, '/'));
        $currentNumber = $lastNumber + 1;
        return sprintf('%02d', $currentNumber);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }
}
